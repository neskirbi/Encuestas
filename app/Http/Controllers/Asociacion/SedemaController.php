<?php

namespace App\Http\Controllers\Asociacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sedema;

class SedemaController extends Controller
{
    function index(){
        $sedemas=Sedema::orderby('nombre','asc')->get();
        return view('asociados.sedemas.sedemas',['sedemas'=>$sedemas]);
    }

    function store(Request $request){
        $sedema=new Sedema();
        $sedema->id=GetUuid();
        $sedema->nombre=$request->nombre;
        $sedema->cargo=$request->cargo;
        $sedema->mail=$request->mail;
        $sedema->pass=$request->pass;
        $sedema->principal=1;
        if($sedema->save()){
            return redirect('sedemas')->with('success','Usuario de SEDEMA agregado.');
        }else{
            return redirect('sedemas')->with('error','¡¡Error al agregar al usuario de SEDEMA!!');
        }
        return $request;
    }


    function update(Request $request,$id){
        $sedema=Sedema::find($id);
        $sedema->nombre=$request->nombre;
        $sedema->cargo=$request->cargo;
        $sedema->mail=$request->mail;
        $sedema->pass=$request->pass;
        $sedema->updated_at=date('Y-m-d H:i:s');
        if($sedema->save()){
            return redirect('sedemas')->with('success','Datos guardados.');
        }else{
            return redirect('sedemas')->with('error','¡¡Error al guardar!!');
        }
    }

    function QuitarSedema($id){
        $sedema=Sedema::find($id);
        if($sedema->delete()){
            return redirect('sedemas')->with('success','Se quitó correctamente.');
        }else{
            return redirect('sedemas')->with('error','¡¡Error al quitar el usuario!!');
        }
    }
}
