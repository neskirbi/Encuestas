<?php

namespace App\Http\Controllers\Asociacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Uia;


class UiaController extends Controller
{
    function index(){
        $uias=Uia::orderby('nombre','asc')->get();
        return view('asociados.uias.uias',['uias'=>$uias]);
    }


    function store(Request $request){

        if(ValidarMail($request->mail)){
            return redirect('unidadesia')->with('error','¡¡Error al agregar al Inspector!!, el correo ya esta registrado.');
        }
        $uia = new Uia();
        $uia->id = GetUuid();
        $uia->uia = $request->uia;
        $uia->nombre = $request->nombre;
        $uia->mail = $request->mail;
        $uia->pass = $request->pass;

        if($uia->save()){
            return redirect('unidadesia')->with('success','Inspector agregado.');
        }else{
            return redirect('unidadesia')->with('error','¡¡Error al agregar al Inspector!!');
        }

    }


    function EliminarUia($id){
        $uia=Uia::find($id);
        $uia->delete();
        return redirect('unidadesia')->with('error','¡¡Usuario eliminado!!');
    }


    function update(Request $request,$id){

        $uia=Uia::find($id);
        $uia->uia = $request->uia;
        $uia->nombre = $request->nombre;
        $uia->pass = $request->pass;

        if($uia->save()){
            return redirect('unidadesia')->with('success','¡¡Inspector guardado!!');
        }else{
            return redirect('unidadesia')->with('error','¡¡Error al guardar los datos!!');
        }

    }
}
