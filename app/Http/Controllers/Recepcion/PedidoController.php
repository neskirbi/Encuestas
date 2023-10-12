<?php

namespace App\Http\Controllers\Recepcion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Obra;
use App\Models\Residente;
use App\Models\Remision;
use App\Models\Vehiculo;
use App\Models\DetallePedido;
use App\Models\Codigo;
use Illuminate\Support\Facades\DB;
use Auth;
use Redirect;

class PedidoController extends Controller
{

   

    public function index()
    {

        $pedidos = DB::table('obras')            
        ->join('pedidos', 'pedidos.id_obra', '=', 'obras.id')
        ->select('pedidos.id','pedidos.obra','pedidos.subtotal', 
        DB::RAW("(SELECT razonsocial from generadores where id=obras.id_generador) as razonsocial"),
        'pedidos.id_obra', 'pedidos.referencia','pedidos.folio',
        'pedidos.total','pedidos.created_at','pedidos.confirmacion',
        'pedidos.created_at','pedidos.fechaentrega',db::raw(" '' as detalle " ),
        DB::raw("(select concat(obras.calle,' ',obras.numeroext,' ',obras.numeroint,' Col.',obras.colonia,' CP.',obras.cp,' ',obras.municipio,' ',obras.entidad) from obras where id=pedidos.id_obra)  as obra_domicilio"))
        ->where('pedidos.id_planta',GetIdPlanta())->where('confirmacion',2)
        ->orderby('created_at','desc')    
        ->paginate(10);

        for($i=0;count($pedidos) > $i ; $i++){
            $pedidos[$i]->detalle=DetallePedido::select('detallepedidos.id','detallepedidos.id_producto','detallepedidos.id_transporte','detallepedidos.producto','detallepedidos.precio','detallepedidos.cantidad','detallepedidos.unidades',
            DB::raw("concat('/images/productos/',detallepedidos.id_producto,detallepedidos.id_transporte,'0.jpg') as portada"))
            ->where('id_pedido',$pedidos[$i]->id)->get();
        }


        
        //$pedidos=Pedido::where('id_planta',Auth::guard('vendedores')->user()->id_planta)->orderby('created_at','desc')->paginate(10);
        
        return view('recepcion.pedidos.pedidos',['pedidos'=>$pedidos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        
        $productos = DetallePedido::select('detallepedidos.id','detallepedidos.id_producto',
        'detallepedidos.id_transporte','detallepedidos.producto','detallepedidos.descripcion','detallepedidos.precio',
        'detallepedidos.cantidad','detallepedidos.unidades','detallepedidos.carrito',db::raw(" '' as remisiones " ),
        DB::raw("detallepedidos.cantidad - (SELECT if(count(id)=0,0,sum(pedidos)) from remisiones where id_detallepedido = detallepedidos.id) as restantes"),
        DB::raw("(SELECT count(id) from remisiones where id_detallepedido = detallepedidos.id) as orden"),
        DB::raw('(SELECT foto from productofotos where orden=0 and (id_producto=detallepedidos.id_producto or id_producto=detallepedidos.id_transporte)) as portada'))
        ->where('id_pedido',$id)->get();


        for($i=0;count($productos) > $i ; $i++){
            $productos[$i]->remisiones=Remision::where('id_detallepedido',$productos[$i]->id)->orderby('orden','asc')->get();
        }
        
        
        $transportes=array();
        $pedido = DB::table('pedidos')  
        ->where('pedidos.id',$id)
        ->first();

        $obra=Obra::find($pedido->id_obra);
        $vehiculos=Vehiculo::where('id_planta',GetIdPlanta())->get();


        return view('recepcion.pedidos.pedido',['obra'=>$obra,'pedido'=>$pedido,'productos'=>$productos,'transportes'=>$transportes,'vehiculos'=>$vehiculos]);
    }

      
   


    

    function LlegadaPlanta($id){
        $remision=Remision::find($id);
        $remision->planta_entrada=GetDateTimeNow();
        $remision->save();
        return Redirect::back()->with('success','Llegada a la planta..');
    }

    function BuscarCodigo(Request $request){
        $codigo=Codigo::where('codigo',$request->codigo)->whereraw('date(created_at) = date(now())')->first();
        if(!$codigo){
            return Redirect::back()->with('error','No se encuentra el pedido');
        }
        return redirect('pedidosd/'.$codigo->id_pedido)->with('success','Pedido encontrado');
    }


    function GenerarCodigoRecoleccion($id){
        $remision=Remision::where('id',$id)->where('confirmacion',1)->first();

        
        
        


        CrearRuta('images/qr/codigoqr/');
        $qrimage= ('images/qr/codigoqr/'. $remision->id.'.png');
        \QRCode::text($id)->setOutfile($qrimage)->png(); 


        //return $codigo;
        return view('generales.pedidos.codigo',['qr'=>$qrimage,'codigo'=>$remision->id]);

        
        
    }

    function RemisionWeb($id){
        $remision=Remision::find($id);
        return view('recepcion.pedidos.remision',['remision'=>$remision]);
    }


    function AceptarViajeWeb(Request $viaje,$id){
        //return $viaje;

        if(isset($viaje->id_chofer)){
            $chofer=Chofer::find($viaje->id_chofer);
        }else{
            $chofer = (object) array('nombres' => $viaje->nombres,'apellidos' => $viaje->apellidos);
        }
        $remision=Remision::where('id_chofer',$viaje->id_chofer)->where('confirmacion','=',3)->first();
        if($remision){
            $respuesta[]=array('status'=>false,'msn'=>'No puedes hacer un viaje hasta que termines tu otro viaje.');
            //Es para controlar que no tengan viajes sin entregar pero como salen csm XD
            //return $respuesta;
        }
        $remision=Remision::where('id',$viaje->id)->first();
        $pedido=DetallePedido::where('id',$remision->id_detallepedido)->first();
        if($remision->confirmacion==1){
            Orden1Cliente($viaje->id);
            $remision->id_chofer=isset($viaje->id_chofer) ? $viaje->id_chofer : '';
            $remision->firmachofer=$viaje->firma;
            
            $remision->chofer=$chofer->nombres.' '.$chofer->apellidos;
            $remision->confirmacion=2;
            $remision->save();

            
            return redirect(url('pedidosd').'/'.$pedido->id_pedido)->with("success","Pedido Entregado.");
        }else{
            
            return redirect(url('pedidosd').'/'.$pedido->id_pedido)->with("warning","Pedido en viaje");
        }
        
      
    }


}
