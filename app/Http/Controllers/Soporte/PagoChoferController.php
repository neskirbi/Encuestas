<?php

namespace App\Http\Controllers\Soporte;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PagoChofer;
use App\Models\Chofer;
use App\Models\Planta;
use App\Models\Cita;

class PagoChoferController extends Controller
{

    function index(){
        $pagoschof=Cita::select('citas.id','citas.id_chofer','citas.nombrecompleto','citas.cantidad','plantas.recompensa','plantas.planta',     
        DB::RAW("(SELECT count(id) from pagoschof where id_cita = citas.id) as pago"))
        ->join('plantas','plantas.id','=','citas.id_planta')
        ->where('id_chofer','!=','')
        ->where('citas.confirmacion',1)
        ->whereraw(" (select count(id) from pagoschof where id_cita = citas.id) = 0")
        ->paginate(20);

        
        
        return view('soporte.pagoschof.pagoschof',['pagoschof'=>$pagoschof]);
    }

    function create(){
        
        $citas=Cita::select('citas.id','citas.id_chofer','citas.nombrecompleto','citas.cantidad','citas.id_planta',
        DB::RAW("(select count(id) from pagoschof where id_cita = citas.id) as pagos"))
        ->where('id_chofer','!=','')
        ->where('citas.confirmacion',1)
        ->whereraw(" (select count(id) from pagoschof where id_cita = citas.id) = 0")
        ->get();

        $this->PagoChoferSoporte($citas);
        return redirect('pagoschofer')->with('success','Los pagos se generaron.');
    }


    function PagoChoferSoporte($citas){
        foreach($citas as $cita){
            if(!PagoChofer::where('id_cita',$cita->id)->first()){
    
            
                $planta=Planta::find($cita->id_planta);
                $pago=new PagoChofer();
                $pago->id=GetUuid();        
                $pago->id_planta=$planta->id;
                $pago->id_cita=$cita->id;
                $pago->id_chofer=$cita->id_chofer;
                $pago->precio=$planta->recompensa;
                $pago->cantidad=$cita->cantidad;
                $pago->save();
            }
    
    
            
        }
        
       
    }

    
}
