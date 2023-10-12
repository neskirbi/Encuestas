<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Condonacion;
use App\Models\Obra;
use Redirect;

class CondonacionController extends Controller
{
    

    public function __construct(){
        $this->middleware('administradorlogged');
    }

    
    public function index(Request $filtros)
    {
        
       

        $condonaciones=DB::table('condonaciones')
        ->join('obras','obras.id','=','condonaciones.id_obra')
        ->select('obras.obra','condonaciones.id','condonaciones.monto','condonaciones.detalle','condonaciones.created_at',
        DB::raw('time(condonaciones.created_at) as hora'))
        ->orderby('created_at','desc')
        ->where('obras.obra','like','%'.$filtros->obra.'%')
        ->where('condonaciones.id_planta','=',GetIdPlanta())
        ->paginate(15);

        $pobras=Obra::where('id_planta',GetIdPlanta())
        ->select('obras.id','obras.obra','obras.superficie','obras.id_planta',
        DB::RAW("(select planta from plantas where id=obras.id_planta) as planta"))->orderby('obra','asc')->get();
        return view('administracion.condonaciones.condonaciones',['condonaciones'=>$condonaciones,'filtros'=>$filtros,'pobras'=>$pobras]);
    }


    function store(Request $request){
        //return $request;

        if(is_null($request->pmonto)){
            return Redirect::back()->with('error', 'El campo monto no puede ser nulo.');
        }
        if(is_null($request->pobra)){
            return Redirect::back()->with('error', 'El campo Obra no puede ser nulo.');
        }
        


        $obra=Obra::find($request->pobra);

       

        
        $pago=new Condonacion();
        $id = $pago->id = GetUuid();
        $pago->id_cliente = $request->pidcliente;      
        $pago->id_obra = $request->pobra;
        $pago->id_planta = $obra->id_planta;
        $pago->monto = str_replace(',','',$request->pmonto);
        $pago->detalle = $request->detalle;

        
        
        if($pago->save()){
            Notificar('¡Se ha registrado un nuevo pago!','Nuevo Pago Registrado.','Por favor verificar el estatus del pago para la validación.','',['ventas@csmx.mx'],'<a href="https://reci-track.mx/" class="btn btn-default  btn-outline-secondary">Ir a Recitrack</a>');
            return Redirect::back()->with('success', 'Se generó el pago. Validar el pago para verlo reflejado.')->with('transferencia', $id);
        }else{
            return Redirect::back()->with('error', 'Error al generar el pago.');
        }

    }
}
