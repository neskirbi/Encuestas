<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Director;
use App\Models\Administrador;
use App\Models\Vendedor;
use App\Models\Recepcion;
use App\Models\Finanza;
use App\Models\Dosificador;
use App\Models\Cliente;
use App\Models\Residente;
use App\Models\Generador;
use App\Models\Vehiculo;
use App\Models\Material;
use App\Models\CategoriaMaterial;
use App\Models\ProductoFoto;
use App\Models\ProductoObra;
use App\Models\Planta;
use App\Models\TransporteObra;
use App\Models\Carrito;
use App\Models\DetallePedido;
use App\Models\Transportista;
use Auth;

class ApisController extends Controller
{
    


    

    function GetHoras(Request $request){
        $horas=array();
        $obra=DB::table('obras')->where('id',$request->obra)->first();
        $cita_ocupadas=array();
        if($obra){
            $cita_horas = DB::table('citas')
            ->join('obras','obras.id','=','citas.id_obra')
            ->where('fechacita','like',date('Y-m-d',strtotime($request->fecha)).'%')
            ->where('obras.id_planta',$obra->id_planta)
            ->select('fechacita')
            ->get();
            foreach($cita_horas as $cita_hora){
                $cita_ocupadas[]=date('H:i:s',strtotime($cita_hora->fechacita));
            }
        }
        
        $diasinicio=array(
            '0'=>'domingoi',
            '1'=>'lunesi',
            '2'=>'martesi',
            '3'=>'miercolesi',
            '4'=>'juevesi',
            '5'=>'viernesi',
            '6'=>'sabadoi'
        );

        $diasfin=array(
            '0'=>'domingof',
            '1'=>'lunesf',
            '2'=>'martesf',
            '3'=>'miercolesf',
            '4'=>'juevesf',
            '5'=>'viernesf',
            '6'=>'sabadof'
        );

        $diai=$diasinicio[date('w',strtotime($request->fecha))];
        $diaf=$diasfin[date('w',strtotime($request->fecha))];

        $horainicio=Planta::where('id',$obra->id_planta)
        ->select($diai)
        ->first();

        $intervalo=Planta::where('id',$obra->id_planta)
        ->select('intervalo')
        ->first();

        $horafin=Planta::where('id',$obra->id_planta)
        ->select($diaf)
        ->first();
       $i=1;
        while(1){
            $hora=date('H:i:s',strtotime ( '+'.(($intervalo->intervalo)*$i).' minute' , strtotime ($horainicio->$diai) ));
             
            /**
             * Para empezar a comparar
             */
            $origin = date_create(strval($request->fecha.' '.$hora));
            $target = date_create(strval($request->fecha.' '.$horafin->$diaf));
            $interval = date_diff($origin, $target);
            //$interval->format('%H:%I');
            $diferiencia=(intval($interval->format('%H'))*60)+intval($interval->format('%I'))*(intval($interval->format('%R').'1'));
            if($diferiencia<0){
                //return$hora.' - '.$horafin->$diaf.' -- '.$diferiencia;
                break;
            }
            if(!in_array($hora, $cita_ocupadas)){                
                $horas[] = $hora ; 
            }
            $i++;
        }
        

        return $horas;

    }

    function GetMateriales(Request $request){
        $materiales=Material::where('categoria',$request->id_categoriamaterial)->where('id_planta',$request->id_planta)->get();
        return $materiales;
    }

    function GetCategoriasMaterial($id_planta){

        return DB::table('materiales')  
        ->select('materiales.categoria') 
        ->where('id_planta','=',$id_planta)     
        ->orderBy('categoria','asc')
        ->groupby('categoria')
        ->get();


        /*return DB::table('materiales')
        ->select('categoria')
        ->where('id_planta','=',$id_planta)
        ->orderby('categoria','asc')->distinct()->get();*/
    }


    function MaterialesObraTodos(Request $request){

        $materiales=DB::table('generadores')
        ->join('obras','obras.id_generador','=','generadores.id')
        ->join('materialesobra','materialesobra.id_obra','=','obras.id')
        ->where('obras.id',$request->id_obra)
        ->select('materialesobra.id','materialesobra.categoriamaterial','materialesobra.material','materialesobra.cantidad','materialesobra.unidades')
        ->orderby('materialesobra.categoriamaterial','asc','materialesobra.material','asc')
        ->get();

        return ($materiales);
    }

    function MaterialesObraDeclarados(Request $request){

         $materiales=DB::table('generadores')
        ->join('obras','obras.id_generador','=','generadores.id')
        ->join('materialesobra','materialesobra.id_obra','=','obras.id')
        ->where('obras.id',$request->id_obra)
        ->where('materialesobra.cantidad','>',0) 
        ->select('materialesobra.id','materialesobra.categoriamaterial','materialesobra.material','materialesobra.cantidad','materialesobra.unidades')
        ->orderby('materialesobra.categoriamaterial','asc','materialesobra.material','asc')
        ->get();

        return ($materiales);
    }



    function Matricula(Request $request){

        return DB::table('empresastransporte')->join('vehiculos','vehiculos.id_empresatransporte','=','empresastransporte.id')
        ->select('empresastransporte.ramir','vehiculos.id','vehiculos.matricula')
        ->where('matricula', 'like', '%'.$request->matricula.'%')
        ->get();
    }
    
    function Razon(Request $request){

        return DB::table('empresastransporte')
        ->where('razonsocial', 'like', '%'.$request->razon.'%')
        ->get();
    }


    function SubTipoObra(Request $request){

        return DB::table('subtipoobras')
        ->where('id_tipoobra', '=', $request->id_tipoobra)
        ->get();
    }



    /**
     * Seguarda la info que llega por la api
     */
    public function GuardarVeiculo(Request $request){
        $buscar=Vehiculo::all()
        ->where('matricula',$request->matricula)
        ->first();

        if(!$buscar){
            $vehiculo=new Vehiculo();
            $vehiculo->id = GetUuid();
            $vehiculo->id_empresatransporte = $request->razonsocial;
            $vehiculo->vehiculo = $request->vehiculo;
            $vehiculo->marca = $request->marca;
            $vehiculo->modelo = $request->modelo;
            $vehiculo->matricula = $request->matricula;
            $vehiculo->combustible = $request->combustible;
           
           
            $vehiculo->detalle = $request->detalle;
            



            if($vehiculo->save()){
                return ('Vehículo guardado.');
            }
            return ('Error al guardar.');
        }
        
        
        return ('Matrícula regsitrada antes.');
    }


    function Clientes(Request $request){
        return DB::table('clientes')
        ->where('nombres','like','%'.$request->nombre.'%')
        ->orwhere('apellidos','like','%'.$request->nombre.'%')
        ->select('id','nombres','apellidos')
        ->get();
    }


    function GetGeneradorDatos(Request $request){ 
        //Para Obras
        $generador = DB::table('generadores')
        ->join('obras','obras.id_generador','=','generadores.id')
        ->where('obras.id',$request->id)
        ->select('generadores.id_cliente',DB::raw("if(generadores.fisicaomoral='Moral',concat(generadores.nombresrepre,' ',generadores.apellidosrepre),concat(generadores.nombresfisica,' ',generadores.apellidosfisica)) as nombre"),
        DB::raw("concat(generadores.calle,', ',generadores.numeroext,', ',generadores.numeroint,', ',generadores.colonia) as direccion"),'generadores.cp','generadores.municipio','generadores.entidad')
        ->first();

        //Para Negocios
        if(!$generador){
            $generador = DB::table('generadores')
            ->join('negocios','negocios.id_generador','=','generadores.id')
            ->where('negocios.id',$request->id)
            ->select(DB::raw("if(generadores.fisicaomoral='Moral',concat(generadores.nombresrepre,' ',generadores.apellidosrepre),concat(generadores.nombresfisica,' ',generadores.apellidosfisica)) as nombre"),
            DB::raw("concat(generadores.calle,', ',generadores.numeroext,', ',generadores.numeroint,', ',generadores.colonia) as direccion"),'generadores.cp','generadores.municipio','generadores.entidad')
            ->first();
        }
       

        if($generador){
            return json_encode($generador);
        }else{
            return '[]';
        }
    }


    

    function ReportePagos(Request $request){
        $pagos= DB::table('pagos')
        ->join('clientes','clientes.id','=','pagos.id_cliente')
        ->where('id_planta','=',$request->id_planta)
        ->whereraw('month(pagos.created_at)='.$request->month)
        ->whereraw('year(pagos.created_at)='.$request->year)
        ->where('pagos.status','=',2)
        ->select('clientes.nombres','clientes.apellidos','pagos.monto','pagos.referencia','pagos.descripcion','pagos.created_at')
        ->orderby('pagos.created_at','asc')
        ->get();

        for($i=0;$i<count($pagos);$i++){            
            $pagos[$i]->created_at=FechaFormateada($pagos[$i]->created_at);
            $pagos[$i]->monto=number_format($pagos[$i]->monto,2);
        }
        return $pagos;

    }

    function DetalleEntregas(Request $request){
        $citas= DB::table('citas')
         ->join('obras','obras.id','=','citas.id_obra')
         ->where('id_obra','=',$request->id)
         ->where('confirmacion','=',1)
         ->select('citas.id','citas.folio',DB::raw("'Reciclaje' as tipo"),'citas.material','citas.cantidad','citas.unidades','citas.fechacita')
         ->orderby('folio','asc')
         ->get();
         for($i=0;$i<count($citas);$i++){            
             $citas[$i]->fechacita=FechaFormateada($citas[$i]->fechacita);
         }
         return $citas;
     }

    function CargarFotoProducto(Request $request){
        if($request->index==0){
             
            $foto=new ProductoFoto();
            $foto->id=GetUuid();
            $foto->id_producto=$request->id;
            $foto->foto=$request->foto;
            $foto->orden=$request->orden;
            $foto->save();
            $imagen=$request->foto;
        }else{
         
            $comienso=ProductoFoto::where('id_producto',$request->id)->where('orden',$request->orden)->first();  
            $imagen=$comienso->foto.$request->foto;
            $foto=ProductoFoto::where('id_producto',$request->id)->where('orden',$request->orden)
            ->update([
                'foto' => $imagen
            ]);
            
            
        }
        
        if($request->listo==1){
            
           


            $nombre = $request->id.$request->orden.'.jpg';
            return GuardarArchivosBase64($imagen,'/images/productos',$nombre);
            
        }
        
         return $request;
    }

    function BorrarProductoFoto(Request $request){
        $foto=ProductoFoto::where('id_producto',$request->id)->where('orden',$request->orden)->first();
        $foto=ProductoFoto::find($foto->id);
        if($foto->delete()){
            return $request;
        }else{
            return '0';
        }
    }

    function CatalogoObraProducto(Request $request){
        return DB::table('productosobras')
        ->where('id_obra',$request->id_obra)
        ->where('productosobras.precio','!=',0)
        ->select('id','categoria','producto','descripcion','precio','transporte','unidades',
        DB::raw("concat('".url('/images/productos/')."/',(select concat(id_producto,orden) from productofotos where id_producto=productosobras.id_producto and orden=0),'.jpg') as portada"))
        ->orderby('categoria','asc')
        ->orderby('producto','asc')
        ->get();
    }

    function CatalogoObraTransporte(Request $request){
        return DB::table('transporteobras')
        ->where('id_obra',$request->id_obra)
        ->where('transporteobras.precio','!=',0)
        ->select('id','transporte as producto','precio','descripcion',DB::raw('\'Transporte\' as categoria'),
        DB::raw("concat('".url('/images/productos/')."/',(select concat(id_producto,orden) from productofotos where id_producto=transporteobras.id_transporte and orden=0),'.jpg') as portada"))
        ->orderby('transporte','asc')
        ->get();
    }

    function AgregarCarrito(Request $request){
        //return $request;

        if($request->id_producto!=null){
            $producto = DB::table('productosobras')
            ->join('obras','obras.id','=','productosobras.id_obra')
            ->select('productosobras.id_producto','obras.id as id_obra','obras.id_planta',db::raw(" '' as id_transporte")
            ,'productosobras.categoria','productosobras.producto','productosobras.descripcion','precio','productosobras.unidades')
            ->where('productosobras.id',$request->id_producto)
            ->first();
            $disponible=0;            
            $unidades=$producto->unidades;
        }
        if($request->id_transporte!=null){
            $producto = DB::table('transporteobras')
            ->join('obras','obras.id','=','transporteobras.id_obra')
            ->select('transporteobras.id_transporte','obras.id as id_obra','obras.id_planta',db::raw(" '' as id_producto")
            ,DB::raw('\'Transporte\' as categoria'),'transporteobras.transporte as producto','transporteobras.descripcion','precio')
            ->where('transporteobras.id',$request->id_transporte)
            ->first();
            $disponible=1;
            $unidades='na';
        }   
        if(!isset($request->id_usuario)){
            $usuario=Cliente::join('generadores','generadores.id_cliente','clientes.id')
            ->join('obras','obras.id_generador','generadores.id')
            ->select('clientes.id')
            ->where('obras.id',$producto->id_obra)
            ->first();
        }

        if(DetallePedido::where('id_obra','<>',$producto->id_obra)->where('id_usuario',(isset($request->id_usuario) ? $request->id_usuario : $usuario->id))->where('carrito',1)->first()){
            return json_decode('{"error":"Error. No puede agregar productos de diferentes obras al carrito."}');
        }
        //return $request;
        
        $cantidad=$request->cantidad;
        $veces=1;
        if($request->id_transporte!=null){
            $veces=$request->cantidad;
            $cantidad=1;
        }


        $error=0;
        for($i=0;$i<$veces;$i++){
            $carrito = new DetallePedido();        
            $carrito->id=GetUuid();
            $carrito->id_pedido='';         
            $carrito->id_obra=$producto->id_obra;
            $carrito->id_usuario=isset($request->id_usuario) ? $request->id_usuario : $usuario->id;
            $carrito->id_transporte=$producto->id_transporte;
            $carrito->id_producto=$producto->id_producto;                    
            $carrito->categoria=$producto->categoria;                    
            $carrito->producto=$producto->producto;   
            $carrito->descripcion=$producto->descripcion;        
            $carrito->precio=$producto->precio;       
            $carrito->unidades=$unidades;
            $carrito->cantidad=$cantidad;         
            $carrito->disponible=$disponible;                 
            $carrito->transporte=$request->transporte == null ? '0' : $request->transporte ;

            if(!$carrito->save()){
                $error++;

            }
        }

        if($error==0){
            return json_decode('{"carrito":'.DetallePedido::where('id_usuario',$request->id_usuario)->where('carrito',1)->get()->count().',"success":"Se agregó el producto al carrito."}');

        }else{
            return json_decode('{"error":"Error al agregar al carrito."}');
        }

        
        
        
        
    }


    function CorreoExisteAdmin(Request $request){
        if(Director::where('mail',$request->mail)->first()){
            return 1;
        }

        if(Administrador::where('mail',$request->mail)->first()){
            return 1;
        }

        if(Vendedor::where('mail',$request->mail)->first()){
            return 1;
        }

        

        return 0;
    }

    function CorreoExiste(Request $request){

        if(Director::where('mail',$request->mail)->first()){
            return 1;
        }

        if(Administrador::where('mail',$request->mail)->first()){
            return 1;
        }

        if(Vendedor::where('mail',$request->mail)->first()){
            return 1;
        }

        if(Recepcion::where('mail',$request->mail)->first()){
            return 1;
        }

        if(Finanza::where('mail',$request->mail)->first()){
            return 1;
        }
        
        if(Cliente::where('mail',$request->mail)->first()){
            return 1;
        }

        if(Residente::where('mail',$request->mail)->first()){
            return 1;
        }

        if(Transportista::where('mail',$request->mail)->first()){
            return 1;
        }

        if(Dosificador::where('mail',$request->mail)->first()){
            return 1;
        }
        return 0;
    }

}
