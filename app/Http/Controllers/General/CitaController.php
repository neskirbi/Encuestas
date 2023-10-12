<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Cita;
use App\Models\MaterialObra;
use App\Models\Material;
use App\Models\Cliente;
use App\Models\Planta;
use App\Models\CondicionMaterial;
use App\Models\Configuracion;
use App\Models\Obra;
use App\Models\Administrador;
use Redirect;

class CitaController extends Controller
{
    public function boleta($id)
    {

        $nombreimagen=$id.'.png';
        $qrimage= ('images/qr/boleta/'.$nombreimagen);
        if(file_exists(public_path($qrimage)))
        {
            
        }else{
            
            \QRCode::text('reci-track.mx/boleta/'.$id)->setOutfile($qrimage)->png();
        } 


        $id_planta=DB::table('citas')
        ->join('obras','obras.id','=','citas.id_obra')
        ->select('obras.id_planta')->where('citas.id','=',$id)->first();
        
        $cita = DB::table('citas')
        ->where('id', $id)
        ->first();
        if(!$cita){
            return Redirect::back()->with('error', 'Error, cita no confirmada.');
        }

        if(file_exists(public_path('images/citas/foto0/'.$cita->id.'.png'))){
            $cita->foto0=asset('images/citas/foto0/'.$cita->id.'.png');
        }else if(file_exists(public_path('images/citas/foto0/'.$cita->id.'.jpg'))){
            $cita->foto0=asset('images/citas/foto0/'.$cita->id.'.jpg');
        }else{
            $cita->foto0="";
        }

        if(file_exists(public_path('images/citas/foto1/'.$cita->id.'.png'))){
            $cita->foto1=asset('images/citas/foto1/'.$cita->id.'.png');
        }else if(file_exists(public_path('images/citas/foto1/'.$cita->id.'.jpg'))){
            $cita->foto1=asset('images/citas/foto1/'.$cita->id.'.jpg');
        }else{
            $cita->foto1="";
        }


        $materialobra=MaterialObra::find($cita->id_materialobra);
        
        $cita->fechacita=str_replace("-","/",date('Y-m-d',strtotime($cita->fechacita)));
        $cita->qr=$nombreimagen;
        
        
        
        //return view('formatos.boleta', ['cita'=>$cita,'materialobra'=>$materialobra,'id_planta'=>$id_planta->id_planta]);
        $pdf = \PDF::loadView('formatos.boleta', ['cita'=>$cita,'materialobra'=>$materialobra,'id_planta'=>$id_planta->id_planta]);
    
        return $pdf->setPaper('A4', 'portrait')->download('Boleta '.$cita->folio.'.pdf');
    }




    public function boleta2($id)
    {

        $nombreimagen='rs.png';
        $qrimage= ('images/qr/boleta/'.$nombreimagen);
        if(file_exists(public_path($qrimage)))
        {
            
        }else{
            
            //\QRCode::format('png')->size(700)->color(255,0,0)->text('chichanga')->setOutfile($qrimage);
        } 
        \QRCode::text('chimichanga')->setOutfile($qrimage)->png();
        \QRCode::text('chimichanga')->setOutfile('images/qr/boleta/rs.svg')->svg();


        $id_planta=DB::table('citas')
        ->join('obras','obras.id','=','citas.id_obra')
        ->select('obras.id_planta')->where('citas.id','=',$id)->first();
        
        $cita = DB::table('citas')
        ->where('id', $id)
        ->first();
        if(!$cita){
            return Redirect::back()->with('error', 'Error, cita no confirmada.');
        }

        if(file_exists(public_path('images/citas/foto0/'.$cita->id.'.png'))){
            $cita->foto0=asset('images/citas/foto0/'.$cita->id.'.png');
        }else if(file_exists(public_path('images/citas/foto0/'.$cita->id.'.jpg'))){
            $cita->foto0=asset('images/citas/foto0/'.$cita->id.'.jpg');
        }else{
            $cita->foto0="";
        }

        if(file_exists(public_path('images/citas/foto1/'.$cita->id.'.png'))){
            $cita->foto1=asset('images/citas/foto1/'.$cita->id.'.png');
        }else if(file_exists(public_path('images/citas/foto1/'.$cita->id.'.jpg'))){
            $cita->foto1=asset('images/citas/foto1/'.$cita->id.'.jpg');
        }else{
            $cita->foto1="";
        }

        $png=public_path('images/qr/boleta/rs.png');
        $svg=public_path('images/qr/boleta/rs.svg');

        $materialobra=MaterialObra::find($cita->id_materialobra);
        
        $cita->fechacita=str_replace("-","/",date('Y-m-d',strtotime($cita->fechacita)));
        $cita->qr=$nombreimagen;
        
        
       
        
        
        //return view('formatos.boleta2', ['cita'=>$cita,'materialobra'=>$materialobra,'id_planta'=>$id_planta->id_planta,'qr'=>$qr]);
        $pdf=\PDF::loadView('formatos.boleta2', ['cita'=>$cita,'materialobra'=>$materialobra,'id_planta'=>$id_planta->id_planta,'png'=>$png,'svg'=>$svg]);
        
        return $pdf->setPaper('A4', 'portrait')->download('Boleta '.$cita->folio.'.pdf');
    }


    public function manifiesto($id)
    {
        $cita = DB::table('clientes')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('obras','obras.id_generador','=','generadores.id')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('citas.id', $id)
        ->select('citas.obra','citas.folio','generadores.razonsocial',
        'generadores.fisicaomoral','generadores.telefono','generadores.calle',
        'generadores.numeroext','generadores.numeroint','generadores.colonia',
        'generadores.municipio','generadores.cp','obras.cantidadobra',
        'obras.telefono as obrtelefono','citas.calleynumeroobr as obrcalle','citas.nautorizacion',
        'citas.coloniaobr as obrcolonia','citas.municipioobr as obrmunicipio','citas.cpobr as obrcp','obras.tipoobra',
        'obras.superficie','citas.distancia',
        'citas.nautorizacion','obras.numeroint as obrnumeroint','obras.colonia as obrcolonia',
        
        'citas.id_materialobra','citas.nombrecompleto','citas.observacion','citas.fechacita',
        'citas.unidades','citas.combustible',
        'citas.cantidad','citas.razonvehiculo','citas.direccionvehiculo','citas.telefonovehiculo',
        'citas.ramir','citas.regsct','citas.vehiculo','citas.marcaymodelo','citas.matricula',
        'citas.condicionesmaterial','citas.planta','citas.plantaauto','citas.direccionplanta',
        'citas.nombreres','citas.firmares','citas.nombrecompleto','citas.firmachof','citas.recibio',
        'citas.cargo','citas.firmarecibio','citas.confirmacion')
        ->first();
        $cita->tipoobra=CodificaTipoObra($cita->tipoobra);

        $materialobra=MaterialObra::find($cita->id_materialobra);
        
        $cita->fechacita=str_replace("-","/",date('Y-m-d',strtotime($cita->fechacita)));
        $cita->qr=$id.'.png';
        
        
        $qrimage= ('images/qr/manifiesto/'.$cita->qr);
        \QRCode::text('reci-track.mx/manifiesto/'.$id)->setOutfile($qrimage)->png(); 
        
        return view('formatos.manifiestoview', ['cita'=>$cita,'materialobra'=>$materialobra]);
        $pdf = \PDF::loadView('formatos.manifiesto', ['cita'=>$cita,'materialobra'=>$materialobra]);
    
        return $pdf ->setPaper('legal', 'portrait')->download('Manifiesto '.($cita->folio==0 ? '' : $cita->folio).'.pdf');
    }


    

    public function manifiestodescarga($id)
    {
        $cita = DB::table('clientes')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('obras','obras.id_generador','=','generadores.id')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('citas.id', $id)
        ->select('citas.obra','citas.folio','citas.razonsocial','generadores.fisicaomoral','generadores.telefono',
        'generadores.calle','generadores.numeroext','generadores.numeroint','generadores.colonia','generadores.municipio','generadores.cp',
        'obras.telefono as obrtelefono','citas.calleynumeroobr as obrcalle','citas.nautorizacion','citas.coloniaobr as obrcolonia',
        'citas.municipioobr as obrmunicipio','citas.cpobr as obrcp','obras.tipoobra','obras.cantidadobra','obras.superficie','citas.distancia',
        'citas.id_materialobra','citas.nombrecompleto','citas.observacion','citas.fechacita','citas.unidades','citas.combustible',
        'citas.cantidad','citas.razonvehiculo','citas.direccionvehiculo','citas.telefonovehiculo','citas.ramir','citas.regsct','citas.vehiculo','citas.marcaymodelo','citas.matricula','citas.condicionesmaterial','citas.planta','citas.plantaauto','citas.direccionplanta','citas.nombreres','citas.firmares','citas.nombrecompleto','citas.firmachof','citas.recibio','citas.cargo','citas.firmarecibio','citas.confirmacion')
        ->first();

        $cita->tipoobra=CodificaTipoObra($cita->tipoobra);
        
       
        

        $materialobra=MaterialObra::find($cita->id_materialobra);
        
        $cita->fechacita=str_replace("-","/",date('Y-m-d',strtotime($cita->fechacita)));
        $cita->qr=$id.'.png';
        
        
        $qrimage= ('images/qr/manifiesto/'.$cita->qr);
        \QRCode::text('reci-track.mx/manifiesto/'.$id)->setOutfile($qrimage)->png(); 
        
        //return view('formatos.manifiesto', ['cita'=>$cita,'materialobra'=>$materialobra]);
        $pdf = \PDF::loadView('formatos.manifiesto', ['cita'=>$cita,'materialobra'=>$materialobra]);
    
        return $pdf ->setPaper('legal', 'portrait')->download('Manifiesto '.($cita->folio==0 ? '' : $cita->folio).'.pdf');
    }

    public function manifiestos($id_obra)
    {
        $citas = DB::table('clientes')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('obras','obras.id_generador','=','generadores.id')
        ->join('citas','citas.id_obra','=','obras.id')        
        ->join('materialesobra','materialesobra.id','=','citas.id_materialobra')
        ->where('citas.id_obra', $id_obra)
        ->select('materialesobra.material','citas.folio','generadores.razonsocial','generadores.fisicaomoral','generadores.telefono','generadores.calle','generadores.numeroext','generadores.numeroint','generadores.colonia','generadores.municipio','generadores.cp',
        'obras.telefono as obrtelefono','obras.calle as obrcalle','obras.numeroext as obrnumeroext','citas.nautorizacion','obras.numeroint as obrnumeroint','obras.colonia as obrcolonia','obras.municipio as obrmunicipio','obras.cp as obrcp','obras.tipoobra','obras.superficie',
        'citas.id_materialobra','citas.nombrecompleto','citas.observacion','citas.fechacita','citas.unidades',
        'citas.cantidad','citas.razonvehiculo','citas.direccionvehiculo','citas.telefonovehiculo','citas.ramir','citas.regsct','citas.vehiculo','citas.marcaymodelo','citas.matricula','citas.condicionesmaterial','citas.planta','citas.plantaauto','citas.direccionplanta','citas.nombreres','citas.firmares','citas.nombrecompleto','citas.firmachof','citas.recibio','citas.cargo','citas.firmarecibio','citas.confirmacion')
        ->get();
        

        //$materialobra=MaterialObra::find($cita->id_materialobra);
        
        //$cita->fechacita=str_replace("-","/",date('Y-m-d',strtotime($cita->fechacita)));
        $cita->qr=$citas[0]->obra.'.png';
        
        
        $qrimage= ('images/qr/manifiesto/'. $cita->qr);
        \QRCode::text('reci-track.mx/manifiesto/'.$id)->setOutfile($qrimage)->png(); 
        
        //return view('formatos.manifiesto', ['cita'=>$cita,'materialobra'=>$materialobra]);
        $pdf = \PDF::loadView('formatos.manifiestos', ['cita'=>$cita]);
    
        return $pdf ->setPaper('legal', 'portrait')->download('Manifiesto '.($cita->folio==0 ? '' : $cita->folio).'.pdf');
    }
  

    function EntregaQr($id){
        $cita = Cita::find($id);
        CrearRuta('images/qr/entregaqr/');
        $qrimage= ('images/qr/entregaqr/'. $id.'.png');
        \QRCode::text($id)->setOutfile($qrimage)->png(); 
        return view('generales.citas.entregaqr',['qr'=>$qrimage,'cita'=>$cita]);
    }
}
