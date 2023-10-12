<?php

namespace App\Http\Controllers\Soporte;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\EmpresaTransporte;
use Redirect;


class TransportistaController extends Controller
{
    function index(){
        $transportes = DB::table('empresastransporte')
        ->orderby('razonsocial')
        ->paginate(15); 

        return view('soporte.transportistas.transportistas',['transportes'=>$transportes]);
    }
    

    function create(){
        return view('soporte.transportistas.create');
    }

    function show($id){
        $empresa=EmpresaTransporte::find($id);
        return view('soporte.transportistas.editarempresa',['empresa'=>$empresa]);
        

    }

    function update(Request $request,$id){
        $empresa=EmpresaTransporte::find($id);        
        
        $empresa->razonsocial=$request->razonsocial;
        $empresa->ramir=$request->ramir;
        $empresa->regsct=$request->regsct;
        $empresa->giro=$request->giro;
        $empresa->ramir=$request->ramir;
        $empresa->domicilio=$request->domicilio;
        $empresa->correo=$request->mail;
        $empresa->telefono=$request->telefono;
        $empresa->giro=$request->giro;
        if($empresa->save()){
            RevisaDatosVehiculos($request,$id);
            return Redirect::back()->with('success','Datos guardados.');
        }else{
            return Redirect::back()->with('error','Error al guardar la empresa');
        }
    }

}