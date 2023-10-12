<?php

namespace App\Http\Controllers\Transportista;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Coordenada;

class ViajeController extends Controller
{
    function index(){

        $citas = DB::table('citas')
        ->join('vehiculos','vehiculos.matricula','=','citas.matricula')
        ->join('empresastransporte','empresastransporte.id','=','vehiculos.id_empresatransporte')
        ->join('transportistas','transportistas.id','=','empresastransporte.id_transportista')
        ->where('transportistas.id','=',Auth::guard('transportistas')->user()->id)
        ->select('citas.obra','citas.planta','citas.fechacita','citas.confirmacion','citas.id',DB::raw("'Reciclaje' as tipo"))
        ->orderby('citas.fechacita','desc')
        ->paginate(10);


        $citas_count = DB::table('citas')
        ->join('vehiculos','vehiculos.matricula','=','citas.matricula')
        ->join('empresastransporte','empresastransporte.id','=','vehiculos.id_empresatransporte')
        ->join('transportistas','transportistas.id','=','empresastransporte.id_transportista')
        ->where('transportistas.id','=',Auth::guard('transportistas')->user()->id)
        ->count();

        $citas_pendientes_count = DB::table('citas')
        ->join('vehiculos','vehiculos.matricula','=','citas.matricula')
        ->join('empresastransporte','empresastransporte.id','=','vehiculos.id_empresatransporte')
        ->join('transportistas','transportistas.id','=','empresastransporte.id_transportista')
        ->where('transportistas.id','=',Auth::guard('transportistas')->user()->id)
        ->where('citas.confirmacion',0)        
        ->orwhere('citas.confirmacion',3)
        ->count();

        $citas_asistidas_count = DB::table('citas')
        ->join('vehiculos','vehiculos.matricula','=','citas.matricula')
        ->join('empresastransporte','empresastransporte.id','=','vehiculos.id_empresatransporte')
        ->join('transportistas','transportistas.id','=','empresastransporte.id_transportista')
        ->where('transportistas.id','=',Auth::guard('transportistas')->user()->id)
        ->where('citas.confirmacion',1)
        ->count();

        $citas_falta_count = DB::table('citas')
        ->join('vehiculos','vehiculos.matricula','=','citas.matricula')
        ->join('empresastransporte','empresastransporte.id','=','vehiculos.id_empresatransporte')
        ->join('transportistas','transportistas.id','=','empresastransporte.id_transportista')
        ->where('transportistas.id','=',Auth::guard('transportistas')->user()->id)
        ->where('citas.confirmacion',2)
        ->count();


        return view('transportistas.viajes.viajes',['citas'=>$citas,
        'citas_count'=>$citas_count,
        'citas_pendientes_count'=>$citas_pendientes_count,
        'citas_asistidas_count'=>$citas_asistidas_count,
        'citas_falta_count'=>$citas_falta_count]);
    }

    public function show($id)
    {
        $cita = DB::table('citas')
        ->where('id', $id)
        ->first();

      

        $coordenadas=Coordenada::select('lat','lon','created_at')
        ->where('id_referencia','=',$id)
        ->orderby('updated_at','desc')
        ->get();
        


        $cita->fechacita=str_replace("-","/",date('Y-m-d',strtotime($cita->fechacita)));
        $cita->qr=$id.'.png';
        
        $qrimage= ('images/qr/boleta/'.$cita->qr);
        \QRCode::text('reci-track.mx/boleta/'.$id)->setOutfile($qrimage)->png(); 

        return view('transportistas.viajes.viaje', ['cita'=>$cita,'coordenadas'=>$coordenadas]);
    
        
    }
}
