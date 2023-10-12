<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PagoChofer;
use App\Models\Chofer;
use App\Models\Solicitud;
class PagosChofController extends Controller
{

    function index(){

        $solicitudes = Solicitud::select('id','monto','created_at','status','id_chofer',DB::RAW("(select concat(nombres,' ',apellidos) from choferes where id=solicitudes.id_chofer) as chofer"),
        DB::RAW("(select cuenta from choferes where id=solicitudes.id_chofer) as cuenta"),
        DB::RAW("(select nombret from choferes where id=solicitudes.id_chofer) as nombret"),
        DB::RAW("(select telefono from choferes where id=solicitudes.id_chofer) as telefono"),
        DB::RAW("(select banco from choferes where id=solicitudes.id_chofer) as banco"))
        ->where('id_planta',GetIdPlanta())
        ->orderby('solicitudes.created_at','desc')
        ->paginate(15);

        return view('administracion.solicitudes.solicitudes',['solicitudes'=>$solicitudes]);
    }

    function update(Request $request,$id){
        $solicitud=Solicitud::find($id);
        $solicitud->status = $request->status;
        $solicitud->save();
        if($request->status==0)
        return redirect('solicitudes')->with('error','Se rechazó la solicitud de pago.');
        
        if($request->status==2)
        return redirect('solicitudes')->with('success','Se aceptó la solicitud de pago.');
    }
    
}
