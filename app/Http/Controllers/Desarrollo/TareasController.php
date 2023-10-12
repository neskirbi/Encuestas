<?php

namespace App\Http\Controllers\Desarrollo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CategoriaMaterial;
use App\Models\Material;
use App\Models\Asociado;
use App\Models\Director;
use App\Models\Administrador;
use App\Models\Vendedor;
use App\Models\Recepcion;
use App\Models\Finanza;
use App\Models\Dosificador;
use App\Models\Cliente;
use App\Models\Residente;
use App\Models\Cita;
use App\Models\Obra;
use App\Models\Planta;
use App\Models\Pedido;
use App\Models\Transportista;
use App\Models\MaterialObra;
use App\Models\Chofer;
use App\Models\PagoChofer;
use App\Models\Solicitud;
use App\Models\Configuracion;

class TareasController extends Controller
{
    

    function Fotos(){
      $citas = Cita::select('id')->get();
      foreach($citas as $cita){
        $fotos = Cita::where('id',$cita->id)->select('id','foto0','foto1')->get();
        foreach($fotos as $foto){
          $this->Archivo($foto->id,$foto->foto0,'foto0');
          $this->Archivo($foto->id,$foto->foto1,'foto1');
        }
      }
      
      return 'ok';

     
    }

    function Archivo($id,$base64,$carpeta){
        if(strlen(trim($base64))<10)
        return ''; 
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
        return ($ruta.$nombre);
        }else{
        return '';
        }
    }


    function Pass123(){
      if(!str_contains($_SERVER['HTTP_HOST'],'localhost')){
        redirect('home');
      }
      Director::where('mail','!=','')
      ->update(['pass' => password_hash(123,PASSWORD_DEFAULT)]);
      
      Administrador::where('mail','!=','')
      ->update(['pass' => password_hash(123,PASSWORD_DEFAULT)]);

      Vendedor::where('mail','!=','')
      ->update(['pass' => password_hash(123,PASSWORD_DEFAULT)]);

      Recepcion::where('mail','!=','')
      ->update(['pass' => password_hash(123,PASSWORD_DEFAULT)]);

      Finanza::where('mail','!=','')
      ->update(['pass' => password_hash(123,PASSWORD_DEFAULT)]);

      Cliente::where('mail','!=','')
      ->update(['pass' => password_hash(123,PASSWORD_DEFAULT)]);
      
      Residente::where('mail','!=','')
      ->update(['pass' => password_hash(123,PASSWORD_DEFAULT)]);

      Transportista::where('mail','!=','')
      ->update(['pass' => password_hash(123,PASSWORD_DEFAULT)]);

      Asociado::where('mail','!=','')
      ->update(['pass' => (123)]);
      
      Dosificador::where('mail','!=','')
      ->update(['pass' => password_hash(123,PASSWORD_DEFAULT)]);

      return redirect('home')->with('warning','Se resetearon las contraseñas.');
    }

    function Contratos(){
      $obras=Obra::select('id')->get();
      foreach($obras as $obra){
        if(file_exists('documentos/clientes/contratos/'.$obra->id.'.pdf')){
          Obra::where('id',$obra->id)
          ->update(['contrato' => 1]);
        }
        
      }return'ok';
    }


    function Limite($id_obra){
      return (TieneLimite2($id_obra));
    }

    function ArreglaMateriales(){
      $categorias=CategoriaMaterial::all();
      foreach($categorias as $cat){
        Material::where('id_categoriamaterial',$cat->id)
          ->update(['categoria' => $cat->categoriamaterial]);
      }

      return 'Ok';
      
    }


    function FoliosPedidos(){
      $plantas=Planta::all();
      $text='';
      foreach($plantas as $planta){
        $pedidos=Pedido::where('id_planta',$planta->id)->orderby('created_at','asc')->get();
        $folio=1;
        foreach($pedidos as $pedido){
          Pedido::where('id',$pedido->id)
            ->update(['folio' => $folio]);
          $folio++;
        }
        $text.='<br>'.$planta->planta .'    '.Pedido::where('id_planta',$planta->id)->count();
      }
      
      return $text;
    }


    function StatusObrasUpdate(){
      $obras=Obra::all();

      foreach($obras as $obr){
        
        $actual=DB::table('obras')
        ->select('obras.obra',
        DB::raw('(SELECT SUM(cantidad) FROM citas WHERE id_obra = obras.id and confirmacion=1) as entregado'),
        DB::raw("(((SELECT if(isnull(SUM(cantidad)),0,SUM(cantidad)) FROM citas WHERE id_obra = obras.id and confirmacion=1)/(SELECT sum(cantidad) from materialesobra where id_obra=obras.id )*100)-(100-(if(datediff(obras.fechafin,now())<0,0,datediff(obras.fechafin,now()))/datediff(obras.fechafin,obras.fechainicio)*100))) as status"))
        ->where('id',$obr->id)->first();

        Obra::where('id',$obr->id)
          ->update(['entregado' => $actual->entregado == null ? 0 : $actual->entregado ,'status' => $actual->status==null || $actual->status>100  ? 100 : (round($actual->status*100)/100)]);
      }

      return 'ok';

    }


    function IdPlanta(){
      $obras=Obra::select('obras.id','obras.id_planta')->get();
      foreach($obras as $obra){

        Cita::whereRaw("id_obra='".$obra->id."'")
        ->where('id_planta','=','')
        ->update([
            'id_planta' => $obra->id_planta
        ]);

      }

      return 'ok';

    }

    function CorrigePrecios($id){
      $citas = Cita::select('id','material','id_materialobra','precio',
      DB::RAW("(select precio from materialesobra where id_obra='".$id."' and( id=citas.id_materialobra or material=citas.material) limit 0,1) as preciomaterial"))
      ->where('id_obra',$id)->get();

      $obra=Obra::select('descuento')->where('id',$id)->first();
      

      $nulos=array();
      foreach($citas as $i=>$cita){

        if(isset($citas[$i]->preciomaterial)){
          $precio=$citas[$i]->preciomaterial-($citas[$i]->preciomaterial*($obra->descuento/100));
          $precio=round($precio*100)/100;

          if($citas[$i]->precio != $precio){
            //return $precio;
            $c=Cita::find($cita->id);
            $c->precio=$precio;
            $c->save();
          }else{
            $nulos[]= $precio=$citas[$i]->preciomaterial;
            unset($citas[$i]);
          }
        }else{
          unset($citas[$i]);
        }
        
      }

      return $citas;
    }


    function GenerarSolicitudes(){


      $choferes = Chofer::all();

      foreach($choferes as $chofer){
        if(($chofer->cuenta) == ''){
          continue;
          //return RespuestaAndroid(0,'No se puede solicitar pagos, primero registre su cuenta CLABE.',array());
        }

        
        $pagos=PagoChofer::select('id','cantidad','precio','id_planta')
        ->where('id_chofer',$chofer->id)
        ->get();
        
        
        
        if(!count($pagos)){
          continue;
            //return RespuestaAndroid(1,'',$pagos);
        }
        
        $id_pagosa=array();
        $total=0;
        $id_planta='';
        foreach($pagos as $pago){
            $id_pagosa[]=$pago->id;
            $total += $pago->precio * $pago->cantidad;
            $id_planta=$pago->id_planta;
            unset($pago->precio);
            unset($pago->cantidad);
        }
        $id_pagos=implode(',',$id_pagosa);

        $solicitud=new Solicitud();

        $solicitud->id = GetUuid();        
        $solicitud->id_planta = $id_planta;
        $solicitud->id_chofer = $chofer->id;
        $solicitud->id_pagos = $id_pagos;
        $solicitud->status = 2;
        $solicitud->monto = $total;

        $solicitud->save();

        DB::table('pagoschof')
            ->wherein('id', $id_pagosa)
            ->update(['status' => 1
        ]); 

      }
        
        
        return RespuestaAndroid(1,'',$pagos);
    }


    function CorrigueInfoCitas($id_obra){

      $generador = DB::table('generadores')
        ->join('obras', 'obras.id_generador', '=', 'generadores.id')
        ->select('generadores.razonsocial','generadores.calle','generadores.numeroext','generadores.colonia','generadores.municipio','generadores.cp')
        ->where('obras.id',$id_obra)        
        ->first();


      Cita::where('id_obra', $id_obra)
      ->update([
          'razonsocial' => $generador->razonsocial,
          'calleynumerofis' => $generador->calle." ".$generador->numeroext,
          'coloniafis' => $generador->colonia,
          'municipiofis' => $generador->municipio,
          'cpfis' => $generador->cp,
      ]);

      
      return 'OK';


    }

    function CorrigeFolios(){

      $citas = Cita::where('folio',0)->where('confirmacion',1)->get();

      foreach($citas as $cita){
        $configuracion=Configuracion::where('id_planta','=',$cita->id_planta)->first();
        $configuracion->folio=$configuracion->folio+1;

        Cita::where('id', $cita->id)
        ->update([
            'folio' => $configuracion->folio
        ]);
        $configuracion->save();
      }

      return count($citas);

      
      

    }
}