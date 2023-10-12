<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Friday;
use Redirect;

class FridayController extends Controller
{

    public function __construct(){
        $this->middleware('administradorlogged');
    }

    
    function index(){
        $fridays=DB::table('fridays')->join('administradores','administradores.id','=','fridays.id_administrador')
        ->select('administradores.administrador','fridays.titulo','fridays.id','fridays.status','fridays.prioridad','fridays.created_at')        
        ->orderby('fridays.status','asc')
        ->orderby('fridays.created_at','desc')   
        ->paginate(15);
        return view('administracion.friday.fridays',['fridays'=>$fridays]);
    }

    function create(){        
        return view('administracion.friday.cratefriday');
    }

    function store(Request $request){
        $friday=new Friday();
        $friday->id=GetUuid();        
        $friday->id_administrador=GetId();
        $friday->titulo=$request->titulo;
        $friday->detalle=$request->detalle;
        $friday->prioridad=$request->prioridad;
        if($friday->save()){
            return redirect('friday')->with('success','Se guardó el nuevo deseo.');
        }else{
            return Redirect::back()->with('error','No se guardó el deseo.');
        }
    }

    function show($id){
        $friday=DB::table('fridays')->join('administradores','administradores.id','=','fridays.id_administrador')
        ->select('administradores.administrador','fridays.titulo','fridays.id','fridays.status','fridays.detalle')
        ->where('fridays.id','=',$id)
        ->first();
        return view('administracion.friday.friday',['friday'=>$friday]);
    }


}
