<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Director;
use App\Models\Administrador;
use App\Models\Vendedor;
use App\Models\Recepcion;
use App\Models\Finanza;
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
use App\Models\Obra;
use App\Models\Carrito;
use App\Models\DetallePedido;
use App\Models\Transportista;
use App\Models\FotoTemp;
use App\Models\Relacion;

class ApiController extends Controller
{
    public function CargarFoto(Request $request){
        //return $request;
        
        if($request->index==0){
            /*$cita=Cita::where('id',$request->id)
            ->update([
                'foto'.$request->foto => $request->parte
            ]);*/

            $foto=new FotoTemp();
            $foto->id = GetUuid();
            $foto->id_cita = $request->id;
            $foto->foto = $request->parte;
            $foto->carpeta = 'foto'.$request->foto;
            $foto->save();
            return $request;
            
        }else if($request->index>0){
         
            $comienso=FotoTemp::where('id_cita',$request->id)
            ->where('carpeta','foto'.$request->foto)->first();
           
            FotoTemp::where('id_cita',$request->id)
            ->where('carpeta','foto'.$request->foto)
            ->update([
                'foto' => $comienso->foto.$request->parte
            ]);
          
           
            return $request;
        }else if($request->index<0){
            
            $foto=FotoTemp::where('id_cita',$request->id)
            ->where('carpeta','foto'.$request->foto)->first();

            if($foto){
                $id=$foto->id_cita;
                $base64=$foto->foto.$request->parte;
                $carpeta=$foto->carpeta;
            }else{
                $id=$request->id;
                $base64=$request->parte;
                $carpeta='foto'.$request->foto;
            }
            
            
            $path="images/citas/".$carpeta;
            $ruta=public_path('/'.$path);
            if(!is_dir($ruta))
                mkdir($ruta, 0777,true);
            if(str_contains($base64,'image/jpeg')){
                $base64=str_replace('data:image/jpeg;base64,','',$base64);
                $nombre= '/'.$id.'.jpg';
            }else if(str_contains($base64,'image/png')){
                $base64=str_replace('data:image/png;base64,','',$base64);
                $nombre= '/'.$id.'.png';
            }
              

            $file = fopen( $ruta.$nombre, 'wb' ); 
            
            if(fwrite( $file, base64_decode($base64) )){
                fclose( $file );
                if($foto)
                    FotoTemp::find($foto->id)->delete(); 
                return $request;//return $ruta.$nombre;
            }else{
                return 'error';
            }
        }
    
     
        
      
    }

    function BorrarFoto(Request $request){
        if(file_exists(public_path('images/citas/foto'.$request->foto.'/'.$request->id.'.png')))
        unlink(public_path('images/citas/foto'.$request->foto.'/'.$request->id.'.png'));
        if(file_exists(public_path('images/citas/foto'.$request->foto.'/'.$request->id.'.jpg')))
        unlink(public_path('images/citas/foto'.$request->foto.'/'.$request->id.'.jpg')); 
        return $request;       
    }

    function SaldoNegativo(Request $request){ 
        $obra=DB::table('obras')
        ->join('citas','citas.id_obra','obras.id')
        ->select('obras.id','citas.iva','citas.cantidad','citas.precio')->where('citas.id',$request->id)->first();
        //return $obra->id.' '.$request->monto;
        $nuevomonto=(($request->monto)+($request->monto*$obra->iva/100));
        $montoanterior=(($obra->cantidad*$obra->precio)+($obra->cantidad*$obra->precio*$obra->iva/100));
        //return $montoanterior.' '.$nuevomonto;
        $monto = $nuevomonto-$montoanterior;
        if($monto>0){
            return intval(PuedeGastar($obra->id,$monto));       
        }else{
            return 1;
        }
        //return PuedeGaster($id_obra,$monto);
    }


    function CambiaFecha(Request $request){
       $cita=Cita::find($request->id);
       $cita->fechacita=$request->fecha;
       if($cita->save()){
           return 1;
       }else{
           return 0;
       }
    }


    function ReportePagos(Request $request){
        /*$pagos= DB::table('pagos')
        ->join('clientes','clientes.id','=','pagos.id_cliente')
        ->where('id_planta','=',$request->id_planta)
        ->whereraw('month(pagos.created_at)='.$request->month)
        ->whereraw('year(pagos.created_at)='.$request->year)
        ->where('pagos.status','=',2)
        ->select('clientes.nombres','clientes.apellidos','pagos.monto','pagos.referencia','pagos.descripcion','pagos.created_at')
        ->orderby('pagos.created_at','asc')
        ->get();*/


        $pagos=DB::table('pagos')
        ->join('obras','obras.id','=','pagos.id_obra')
        ->where('pagos.id_planta','=',$request->id_planta)
        ->whereraw('month(pagos.created_at)='.$request->month)
        ->whereraw('year(pagos.created_at)='.$request->year)
        ->where('pagos.status','=',2)
        ->select(DB::raw("(select razonsocial from generadores where id = obras.id_generador) as generador"),
        'obras.obra','pagos.monto','pagos.referencia','pagos.descripcion',
        'pagos.created_at')
        ->orderby('pagos.created_at','asc')
        ->get();

        for($i=0;$i<count($pagos);$i++){            
            $pagos[$i]->created_at=FechaFormateada($pagos[$i]->created_at);
            $pagos[$i]->monto=number_format($pagos[$i]->monto,2);
        }
        return $pagos;

    }

    function ReporteCitas(Request $request){
        
        $citas= DB::table('citas')
        ->join('obras','obras.id','=','citas.id_obra')
        ->select('obras.obra','citas.id','citas.folio','citas.iva',
        'citas.matricula','citas.razonsocial','citas.material',
        'citas.cantidad','citas.unidades','citas.precio','citas.fechacita')
        ->where('id_obra','like','%'.$request->obra == null ? '' : $request->obra.'%')
        ->where('fechacita','>=',$request->ini)
        ->where('fechacita','<=',$request->fin)
        ->where('obras.id_planta','=',$request->id_planta)
        ->where('confirmacion','=',1)
        ->orderby('folio','asc')
        ->get();
        for($i=0;$i<count($citas);$i++){            
            $citas[$i]->fechacita=FechaFormateada($citas[$i]->fechacita);

            if(file_exists(public_path('images/citas/foto0/'.$citas[$i]->id.'.png'))){
                $citas[$i]->foto0=asset('images/citas/foto0/'.$citas[$i]->id.'.png');
            }else if(file_exists(public_path('images/citas/foto0/'.$citas[$i]->id.'.jpg'))){
                $citas[$i]->foto0=asset('images/citas/foto0/'.$citas[$i]->id.'.jpg');
            }

            if(file_exists(public_path('images/citas/foto1/'.$citas[$i]->id.'.png'))){
                $citas[$i]->foto1=asset('images/citas/foto1/'.$citas[$i]->id.'.png');
            }else if(file_exists(public_path('images/citas/foto1/'.$citas[$i]->id.'.jpg'))){
                $citas[$i]->foto1=asset('images/citas/foto1/'.$citas[$i]->id.'.jpg');
            }
        }
        return $citas;

    }

    function ReporteTransportePre(Request $request){
        $pedidos= DB::table('obras')
        ->join('pedidos','pedidos.id_obra','=','obras.id')
        ->select(DB::raw("(Select razonsocial from generadores where id=obras.id_generador) as generador"),
        DB::raw("(Select group_concat(concat(descripcion,' $',format(precio,2)) separator'<br>') as detalle from detallepedidos where id_pedido=pedidos.id) as detalle"),
            'obras.obra','pedidos.subtotal','pedidos.iva','pedidos.total','pedidos.created_at','pedidos.updated_at')
        ->where('obras.id','like','%'.($request->obra == null ? '' : $request->obra).'%')
        ->where('pedidos.created_at','>=',$request->ini)
        ->where('pedidos.updated_at','<=',$request->fin)
        ->where('obras.id_planta','=',$request->id_planta)
        ->where('pedidos.confirmacion','=',2)
        ->orderby('pedidos.created_at','desc')
        ->get();
        for($i=0;$i<count($pedidos);$i++){            
            $pedidos[$i]->created_at=FechaFormateada($pedidos[$i]->created_at);

        }
        return $pedidos;

    }

    function ReporteStatusObrasPre(Request $request){
        $obras = DB::table('generadores')
        ->join('obras' ,'obras.id_generador','=','generadores.id')
        ->select('generadores.razonsocial','obras.obra','obras.fechainicio','obras.fechafin','obras.descuento','obras.superficie','obras.superunidades','obras.puedepospago',
        DB::raw("(select sum(mat.cantidad*mat.precio)+(sum(mat.cantidad*mat.precio)*(obras.ivaobra/100)) from materialesobra as mat where mat.id_obra=obras.id) as monto"),
        DB::raw("(select sum(mat.cantidad*mat.precio)+(sum(mat.cantidad*mat.precio)*(obras.ivaobra/100)) from materialesobra as mat where mat.id_obra=obras.id)-((select sum(mat.cantidad*mat.precio)+(sum(mat.cantidad*mat.precio)*(obras.ivaobra/100)) from materialesobra as mat where mat.id_obra=obras.id)*(obras.descuento/100)) as montototal"),
        DB::raw("(select sum(monto) from pagos where id_obra=obras.id and status=2) as pagos"),
        DB::raw("(select sum(cantidad) from citas where id_obra=obras.id and confirmacion=1) as entregado")
        )
        ->where('obras.id_planta','=',$request->id_planta)
        ->where('obras.verificado','=',1)
        ->get();
        return $obras;
    }

    function HabilitarDeshabilitar(Request $request){
        //return $request;
        $obra=Obra::find($request->id);
        $obra->deshabilitada=$request->option;
        $obra->save();
        return $request->option;

    }

    function ActivarPlanta(Request $request){
        if(boolval($request->checked)){
            $planta=Planta::find($request->id_planta);
            $relacion=new Relacion();
            $relacion->id=GetUuid();
            $relacion->id_administrador=$request->id_usuario;
            $relacion->id_planta=$request->id_planta;
            $relacion->planta=$planta->planta;
            $relacion->save();
            return 1;

        }else{
            $relacion=Relacion::where('id_administrador',$request->id_usuario)
            ->where('id_planta',$request->id_planta)->first();
            $relacion->delete();
            return 0;
        }

        
    }


    function EnviarCorreoRC(Request $request){
        $obra=Obra::join('generadores','generadores.id','=','obras.id_generador')
        ->select('obras.id','obras.obra','generadores.razonsocial','generadores.nombresrepre','generadores.apellidosrepre','obras.contacto',
        'obras.telefono','obras.celular','obras.correo','obras.tipoobra','obras.valorobra','obras.id_planta','obras.fechainicio')
        ->where('obras.id',$request->id)
        ->first();



        $planta=Planta::select('plantas.correosrc')->find($obra->id_planta);

        $correos=explode(",",$planta->correosrc);
        
        $body='
        <div class="row">
                  <div class="col-md-12" >

                    <p>Hola Buen día.</p>
                    <p>Se ha dado de alta un obra en ReciTrack que quiere cotización de Póliza de Responsabilidad Civil, a continuación los datos del Cliente y Proyecto.</p>
                  </div>
                </div>
                  
                <div class="row">
                  <div class="col-md-12">
                    Cliente: '.$obra->razonsocial.'
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    Representante Legal: '.$obra->nombresrepre.' '.$obra->apellidosrepre.'
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-12">
                    Contacto en Obra: '.$obra->contacto.'
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    Teléfono 1: '.$obra->telefono.'
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    Teléfono 2: '.$obra->celular.'
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    Correo: '.$obra->correo.'
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-12">
                    Tipo de Obra: '.CodificaTipoObra($obra->tipoobra).'
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    Valor de la Obra: $ '.number_format($obra->valorobra,2).'
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    Fecha de inicio: '.FechaFormateada($obra->fechainicio).'
                  </div>
                </div>
                
                ';


        Notificar('Poliza RC','Poliza RC',$obra->obra,$body,$correos,'');
        return 1;
    }
}
