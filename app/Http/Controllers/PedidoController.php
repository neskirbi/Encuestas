<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductoObra;
use App\Models\Codigo;
use App\Models\Carrito;
use App\Models\Configuracion;
use App\Models\DetallePedido;
use App\Models\Pedido;
use App\Models\Obra;
use App\Models\Remision;
use App\Models\Generador;
use App\Models\Planta;
use Redirect;


class PedidoController extends Controller
{

   

    
    function index(){    
        
        $id_usuario = Auth::guard('clientes')->check()==false ? Auth::guard('residentes')->user()->id : Auth::guard('clientes')->user()->id;
        //$cart = DetallePedido::where('id_usuario',$id_usuario)->get()->where('carrito',1)->count();
       
        $pedidos = DB::table('clientes')            
            ->join('generadores', 'generadores.id_cliente', '=', 'clientes.id')
            ->join('obras', 'obras.id_generador', '=', 'generadores.id')
            ->join('pedidos', 'pedidos.id_obra', '=', 'obras.id')
            ->select('pedidos.id','pedidos.obra','pedidos.subtotal', 'pedidos.id_obra', 'pedidos.referencia',
            'pedidos.total','pedidos.created_at','pedidos.confirmacion',DB::raw("(select id from pagos where referencia=pedidos.referencia) as id_pago"),
            DB::raw("(select status from pagos where referencia=pedidos.referencia) as status"),
            'pedidos.created_at','pedidos.fechaentrega',db::raw(" '' as detalle " ))
            ->where('clientes.id',$id_usuario)
            ->orWhere('pedidos.id_usuario',$id_usuario)
            ->orderby('created_at','desc')    
            ->paginate(10);

        for($i=0;count($pedidos) > $i ; $i++){
            $pedidos[$i]->detalle=DetallePedido::select('detallepedidos.id','detallepedidos.id_producto',
            'detallepedidos.id_transporte','detallepedidos.producto','detallepedidos.precio','detallepedidos.cantidad','detallepedidos.unidades',
            DB::raw("concat('/images/productos/',detallepedidos.id_producto,detallepedidos.id_transporte,'0.jpg') as portada"))
            ->where('id_pedido',$pedidos[$i]->id)->get();
        }

        
        
        if(Auth::guard('residentes')->check()){
            $productos=Pedido::where('id_usuario',$id_usuario)->orderby('created_at','desc')->paginate(10);
        }
        
        return view('generales.pedidos.pedidos',['pedidos'=>$pedidos]);
    }

    function store(Request $request){
        
        
        $id_obra='';
        $subtotalp=0;
        $subtotalt=0;

        /**
         * Prepara los registros  de el carrito para actualizar y generar el pedido
         */
        $arraydetallepedido=array();
        foreach($request->id as $i=>$id){
            $detallepedido=DetallePedido::where('id',$id)->where('carrito',1)->first();
            if($detallepedido){
                
                $detallepedido->cantidad=$request->cantidad[$i];
                $detallepedido->carrito=0;

                if($detallepedido->id_producto!=''){ 
                    $arraydetallepedido[0][]=$detallepedido;
                    $subtotalp+=$request->cantidad[$i]*$detallepedido->precio;
                }

                if($detallepedido->id_transporte!=''){ 
                    $arraydetallepedido[1][]=$detallepedido;
                    $subtotalt+=$request->cantidad[$i]*$detallepedido->precio;
                }


               
                $id_obra=$detallepedido->id_obra;
            }
            
            
        }
       
        //return $arraydetallepedido;

        //No avanza si los registros ya no estan en el carrito
        if(!isset($arraydetallepedido[0]) && !isset($arraydetallepedido[1])){
            return redirect('carrito')->with('error', 'Carrito vacio.');
        }


        if(isset($arraydetallepedido[0])){
            if($this->GenerdarPedido($request,$arraydetallepedido[0],$id_obra,$subtotalp)){
                //return redirect('pedidos')->with('success', 'Registro guardado.');
            }else{
                return redirect('pedidos')->with('error', 'Error al guardar.');  
            }
        }

        if(isset($arraydetallepedido[1])){
            if($this->GenerdarPedido($request,$arraydetallepedido[1],$id_obra,$subtotalt)){
                //return redirect('pedidos')->with('success', 'Registro guardado.');
            }else{
                return redirect('pedidos')->with('error', 'Error al guardar.');  
            }
        }
        return redirect('pedidos')->with('success', 'Registro guardado.');
        

        
        
    }

    function GenerdarPedido($request,$arraydetallepedido,$id_obra,$subtotal){
        $id_usuario = Auth::guard('clientes')->check()==false ? Auth::guard('residentes')->user()->id : Auth::guard('clientes')->user()->id;

        $obra=Obra::find($id_obra);
        $configuraciones=Configuracion::where('id_planta',$obra->id_planta)->first();
        $total=$subtotal+($subtotal*($configuraciones->iva/100));
      
        /*
        if(!PuedeGastar($id_obra,$total)){
            return Redirect::back()->with('error', 'No puede generar pedido por falta de saldo.');
        }
        */


        $pedido=new Pedido();
        $id_pedido=GetUuid();
        $pedido->id=$id_pedido; 
        $pedido->folio=Pedido::where('id_planta',$obra->id_planta)->count()+1; 

        $pedido->id_planta=$obra->id_planta;
        $pedido->id_obra=$id_obra;
        $pedido->id_usuario=$id_usuario;
        $pedido->obra=$obra->obra;
        $pedido->direccion=$obra->calle.' '.$obra->numeroext.' '.$obra->numeroint.','.$obra->colonia.','.$obra->municipo.','.$obra->entidad.','.$obra->cp;
        $pedido->latitud=$obra->latitud;
        $pedido->longitud=$obra->longitud;
        $pedido->telefono=$obra->telefono;
        $pedido->correo=$obra->correo;
        
        $pedido->fechaentrega=$request->fechaentrega;
        $pedido->instrucciones=isset($request->instruccionesp) ? $request->instruccionesp : $request->instruccionest;
        $pedido->subtotal= $subtotal;
        $pedido->iva = $obra->ivaobra;
        $pedido->total=$total;
        $pedido->referencia= GetReferencia($obra->id_planta);
       
        if($pedido->save()){
            foreach($arraydetallepedido as $detalle){                
                $detalle->id_pedido=$id_pedido;
                if(!$detalle->save()){
                    return redirect('carrito')->with('error', 'Error al guardar.');
                }
            }
            Notificar('Nuevo Pedido','Nuevo Pedido.','','Se ha generado un nuevo pedido de '.$obra->obra.' para la confirmación.',['ventas@csmx.mx'],'<a href="https://reci-track.mx" class="btn btn-default  btn-outline-secondary">Ir a Recitrack</a>');
            return true;
        }else{
            return false;
        }
    }

    public function show($id)
    {

        $productos = DetallePedido::select('detallepedidos.id','detallepedidos.id_producto',
        'detallepedidos.id_transporte','detallepedidos.producto','detallepedidos.descripcion','detallepedidos.precio',
        'detallepedidos.cantidad','detallepedidos.unidades','detallepedidos.carrito',db::raw(" '' as remisiones " ),
        DB::raw("detallepedidos.cantidad - (SELECT if(count(id)=0,0,sum(pedidos)) from remisiones where id_detallepedido = detallepedidos.id) as restantes"),
        DB::raw("(SELECT count(id) from remisiones where id_detallepedido = detallepedidos.id) as orden"),
        DB::raw("concat('/images/productos/',detallepedidos.id_producto,detallepedidos.id_transporte,'0.jpg') as portada"))
        ->where('id_pedido',$id)->get();   
            
        for($i=0;count($productos) > $i ; $i++){
            $productos[$i]->remisiones=Remision::where('id_detallepedido',$productos[$i]->id)->orderby('orden','asc')->get();
        }
        
        $transportes= array();
        $pedido = DB::table('pedidos')  
        ->where('pedidos.id',$id)
        ->first();

        $obra=Obra::find($pedido->id_obra);


        return view('generales.pedidos.pedido',['obra'=>$obra,'pedido'=>$pedido,'productos'=>$productos,'transportes'=>$transportes]);
    }

    function Catalogo(){
        $id_usuario = Auth::guard('clientes')->check()==false ? Auth::guard('residentes')->user()->id : Auth::guard('clientes')->user()->id;
        
            
        if(Auth::guard('clientes')->check()){
            $obras = DB::table('clientes')            
            ->join('generadores', 'generadores.id_cliente', '=', 'clientes.id')
            ->join('obras', 'obras.id_generador', '=', 'generadores.id')
            ->select('obras.id','obras.obra')
            ->where('clientes.id',$id_usuario)            
            ->where('obras.verificado',1)     
            ->get();
        }  
        if(Auth::guard('residentes')->check()){
            $obras = DB::table('residentes')
            ->join('residentesobras','residentesobras.id_residente', '=', 'residentes.id')
            ->join('obras', 'obras.id', '=', 'residentesobras.id_obra')
            ->select('obras.id','obras.obra')
            ->where('residentes.id',$id_usuario)            
            ->where('obras.verificado',1)     
            ->get();
        }

        return view('generales.pedidos.catalogo',['obras'=>$obras]);
    }


    function Logistica(){
        $id_usuario = Auth::guard('clientes')->check()==false ? Auth::guard('residentes')->user()->id : Auth::guard('clientes')->user()->id;
        
            
        if(Auth::guard('clientes')->check()){
            $obras = DB::table('clientes')            
            ->join('generadores', 'generadores.id_cliente', '=', 'clientes.id')
            ->join('obras', 'obras.id_generador', '=', 'generadores.id')
            ->select('obras.id','obras.obra')
            ->where('clientes.id',$id_usuario)            
            ->where('obras.verificado',1)     
            ->get();
        }  
        if(Auth::guard('residentes')->check()){
            $obras = DB::table('residentes')
            ->join('residentesobras','residentesobras.id_residente', '=', 'residentes.id')
            ->join('obras', 'obras.id', '=', 'residentesobras.id_obra')
            ->select('obras.id','obras.obra')
            ->where('residentes.id',$id_usuario)            
            ->where('obras.verificado',1)     
            ->get();
        }

        return view('generales.logistica.catalogo',['obras'=>$obras]);
    }

    function Carrito(){
        
        $id_usuario = GetIdCliente();
        

        $productos = DetallePedido::select('detallepedidos.id','detallepedidos.id_producto',
        'detallepedidos.id_transporte','detallepedidos.producto','detallepedidos.precio','detallepedidos.cantidad',
        'detallepedidos.unidades',
        DB::raw("concat('/images/productos/',detallepedidos.id_producto,detallepedidos.id_transporte,'0.jpg') as portada"))
        ->where('carrito',1)
        ->where('id_transporte','=','')
        ->where('id_usuario',$id_usuario)
        ->get();

        $logistica = DetallePedido::select('detallepedidos.id','detallepedidos.id_producto',
        'detallepedidos.id_transporte','detallepedidos.producto','detallepedidos.precio','detallepedidos.cantidad',
        'detallepedidos.unidades',
        DB::raw("concat('/images/productos/',detallepedidos.id_producto,detallepedidos.id_transporte,'0.jpg') as portada"))
        ->where('carrito',1)
        ->where('id_producto','=','')
        ->where('id_usuario',$id_usuario)
        ->get();
        

        if(count($productos)==0 && count($logistica)==0){
            return Redirect::back()->with('error', 'Carrito vacio.');
        }
            
        $transportes=array();

        $pedido = DB::table('detallepedidos')
        ->join('obras','obras.id','=','detallepedidos.id_obra')
        ->select('obras.id_planta','obras.id as id_obra')
        ->where('carrito',1)
        ->where('id_usuario',$id_usuario)
        ->first();

        /**
         * Pone un iva en 0 por si no hay nada en el carrito
         */
        $configuraciones=json_decode('{"iva":0}');
        if($pedido){
            $configuraciones=Configuracion::where('id_planta',$pedido->id_planta)->first();
        }
        $obra=Obra::find($pedido->id_obra);
        
        

       
        return view('generales.pedidos.carrito',['obra'=>$obra,
        'productos'=>$productos,
        'logistica'=>$logistica,
        'transportes'=>$transportes,
        'iva'=>$configuraciones->iva]);
    }

    function QuitardelCarrito($id){
        $producto=DetallePedido::find($id);
        if(strlen($producto->id_pedido)==32){            
            return Redirect::back()->with('error', 'Error, No se pueden quitar productos de un pedido confirmado o rechazado.');
        }
        if($producto->delete()){
            return Redirect::back()->with('success', 'Se quitó del carrito.');
        }else{
            return Redirect::back()->with('error', 'Error. No puede quitar del carrito.');
        }
    }

    function Cotizacion($id){
        $datos=Generador::join('obras','obras.id_generador','=','generadores.id')
        ->select('generadores.razonsocial','generadores.nombresrepre','generadores.apellidosrepre','generadores.rfc','generadores.nombresfisica','generadores.apellidosfisica','generadores.rfc',
        db::raw("concat(generadores.calle,' ',generadores.numeroext,' ',generadores.numeroint,', ',generadores.colonia,', CP.',generadores.cp,', ',generadores.municipio,', ',generadores.entidad,' ') as domicilio"),
        'obras.obra','obras.id_planta',
        db::raw("(select folio from pedidos where id='".$id."') as folio"),
        db::raw("(select created_at from pedidos where id='".$id."') as fecha_cotizacion"),
        db::raw("concat(obras.calle,' ',obras.numeroext,' ',obras.numeroint,', ',obras.colonia,', CP.',obras.cp,', ',obras.municipio,', ',obras.entidad,' ') as domicilioobra"))
        ->whereraw("obras.id =(select id_obra from pedidos where id='".$id."') ")
        ->first();
        $planta=Planta::join('configuraciones','configuraciones.id_planta','=','plantas.id')->where('plantas.id',$datos->id_planta)->first();

        $productos=Pedido::join('detallepedidos','detallepedidos.id_pedido','=','pedidos.id')
        ->select('pedidos.fechaentrega','detallepedidos.unidades','detallepedidos.descripcion',
        'pedidos.subtotal',db::raw('(pedidos.subtotal*pedidos.iva/100) as iva'),'pedidos.total',
        db::raw("(SELECT sku FROM productosobras as p where p.id_producto=detallepedidos.id_producto and p.id_obra=detallepedidos.id_obra) as skup"),
        db::raw("(SELECT sku FROM transporteobras as t where t.id_transporte=detallepedidos.id_transporte and t.id_obra=detallepedidos.id_obra) as skut"),
        'detallepedidos.producto','detallepedidos.cantidad','detallepedidos.precio',
        db::raw('(detallepedidos.precio*detallepedidos.cantidad) as importe'))
        ->where('pedidos.id',$id)->get();
        return view('formatos.clientes.cotizacion',['datos'=>$datos,'productos'=>$productos,'planta'=>$planta]);
    }

    function Cargarcomprobante(Request $request){
        //return $request;

        
        if($request->comprobante->extension()!='jpg'){
            return Redirect::back()->with('error', 'Solo acepta imagenes .png');
        }

        $comprobante = $request->pidcom.'.jpg';
        
        if(!GuardarArchivos($request->comprobante,'/documentos/clientes/pagos/comprobantes',$comprobante)){
            return Redirect::back()->with('error', 'Error al guardar declaratoria.');
        }
        return Redirect::back()->with('success', 'Comprobante cargado.');
    }


    
}
