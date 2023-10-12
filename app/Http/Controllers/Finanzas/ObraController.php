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
use App\Models\TipoObra;

class ObraController extends Controller 
{

    public function __construct(){
        $this->middleware('finanzaslogged');
    }

    
    function index(Request $request){
        $obras = Obra::where("id_planta",Auth::guard('finanzas')->user()->id_planta)        
        ->select('obras.id','obras.obra','obras.cantidadobra','obras.puedepospago','obras.superunidades',
        DB::raw("(select sum(cantidad) as cantidad from citas where id_obra=obras.id) as entregado " ))
        ->where('obras.obra','like','%'.$request->obra.'%')
        ->where('obras.deshabilitada',0)
        ->paginate(10);

        return view('finanzas.obras.obras',['filtros'=>$request,'obras'=>$obras]);
    }

    function show($id){
        $obra=Obra::find($id);
        $obra->tipoobra=json_decode($obra->tipoobra);        

        $obra->subtipoobra=json_decode($obra->subtipoobra);
        //return $obra;

        $tipoobras=TipoObra::select('tipoobra',DB::raw("group_concat(id,'::',subtipoobra SEPARATOR ';;') as subtipoobra"))->groupby('tipoobra')->get();

        $generador=Generador::find($obra->id_generador);
        $materiales=MaterialObra::where('id_obra','=',$obra->id)->get();
        $planta=Planta::find($obra->id_planta);
        return view('finanzas.obras.obra',['generador'=>$generador,'obra'=>$obra,'planta'=>$planta,'materiales'=>$materiales,'tipoobras'=>$tipoobras]);
    }
}
