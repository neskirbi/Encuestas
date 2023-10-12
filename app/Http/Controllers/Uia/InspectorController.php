<?php

namespace App\Http\Controllers\Uia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inspector;
use Redirect;

class InspectorController extends Controller
{

    public function __construct(){
        $this->middleware('uiaslogged');
    }

    function index(Request $filtros){
        $inspectores=Inspector::where('id_uia',GetId())
        ->whereraw("inspector like '%".$filtros->inspector."%' or telefono like '%".$filtros->inspector."%'")  
        ->paginate(15);

        return view('uia.inspectores.inspectores',['inspectores'=>$inspectores,'filtros'=>$filtros]);
    }

    function create(){
        return view('uia.inspectores.create');
    }

    function store(Request $request){
        if(ValidarMail($request->mail)){
            return Redirect::back()->with('error','¡¡Error al agregar al Inspector!!, el correo ya esta registrado.');
        }

        $inspector = new Inspector();
        
        $inspector->id=GetUuid();
        $inspector->id_uia=GetId();
        $inspector->inspector=$request->inspector;
        $inspector->telefono=$request->telefono;
        $inspector->mail=$request->mail;
        $inspector->pass=$request->pass;

        if($inspector->save()){
            return redirect('inspectores')->with('success', '¡Registro correcto!');
        }else{
            return Redirect::back()->with('error', '¡Error de registro!');
        }
    }

    function show($id){
        $inspector=Inspector::find($id);
        return view('uia.inspectores.show',['inspector'=>$inspector]);
    }

    
    function update(Request $request,$id){
        $inspector=Inspector::find($id);
       
        
        $inspector->inspector=$request->inspector;
        $inspector->telefono=$request->telefono;
        $inspector->mail=$request->mail;
        $inspector->pass=$request->pass;

        if($inspector->save()){
            return Redirect::back()->with('success', '¡Registro correcto!');
        }else{
            return Redirect::back()->with('error', '¡Error de registro!');
        }
    }


    function destroy($id){
        $inspector=Inspector::find($id);
        return view('uia.inspectores.destroy',['inspector'=>$inspector]);
    }


    function EliminarInspector($id){
        $inspector=Inspector::find($id);

        if($inspector->delete()){
            return redirect('inspectores')->with('success', '¡Registro eliminado!');
        }else{
            return redirect('inspectores')->with('error', '¡Error al borrar!');
        }
    }

}
