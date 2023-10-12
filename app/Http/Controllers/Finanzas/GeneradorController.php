<?php

namespace App\Http\Controllers\Finanzas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Generador;
use App\Models\Obra;
use App\Models\MaterialObra;
use App\Models\Planta;

class GeneradorController extends Controller 
{

    public function __construct(){
        $this->middleware('finanzaslogged');
    }

    
    function index(Request $request){
        


        
        $generadores = DB::table('obras')
        ->join('generadores','obras.id_generador','=','generadores.id')
        ->select('generadores.id','generadores.razonsocial',
        DB::raw('sum(obras.superficie) as cantidadobra'),
        DB::raw("(select sum(cantidad) from citas where id_obra in (select id from obras where id_generador = generadores.id) and confirmacion=1 ) as entregado"))
        ->where("id_planta",Auth::guard('finanzas')->user()->id_planta) 
        ->where('generadores.razonsocial','like','%'.$request->generador.'%')
        ->where('obras.id_planta','=',Auth::guard('finanzas')->user()->id_planta)
        ->where('obras.deshabilitada',0)
        ->groupby('generadores.id','generadores.razonsocial')
        ->orderby('generadores.razonsocial', 'asc')
        ->paginate(10);

        return view('finanzas.generadores.generadores',['filtros'=>$request,'generadores'=>$generadores]);
    }

    function show($id){
        $generador=Generador::find($id);        
        
        $obras = Obra::where("id_planta",Auth::guard('finanzas')->user()->id_planta)        
        ->select('obras.id','obras.obra', DB::raw('obras.superficie as cantidadobra'),'obras.puedepospago','obras.superunidades',
        DB::raw("(select sum(cantidad) from citas where id_obra=obras.id and confirmacion=1 ) as entregado " ),        
        DB::raw("(select sum(precio*cantidad) from materialesobra where id_obra=obras.id) as preciomat " ))
        ->where('id_generador','=',$generador->id)
        ->where('obras.deshabilitada',0)
        ->paginate(10);

        return view('finanzas.generadores.generador',['generador'=>$generador,'obras'=>$obras]);
    }
}
