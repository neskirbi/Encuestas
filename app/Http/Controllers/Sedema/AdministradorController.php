<?php

namespace App\Http\Controllers\Sedema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Sedema;
use Redirect;

class AdministradorController extends Controller
{
    function index(){
       $sedemas=DB::table('sedemas')
        ->orderby('created_at','asc')
        ->get();
        

        return view('sedema.administradores.administradores',['sedemas'=>$sedemas]);
    }

    function show($id){
        $planta = DB::table('plantas')
        ->select('id','planta','direccion','plantaauto')
        ->where('id',$id)
        ->first();

        $administradores=DB::table('administradores')
        ->where('id_planta',$planta->id)
        ->orderby('administrador','asc')
        ->get();

        return view('administracion.plantas.planta',['planta'=>$planta,'administradores'=>$administradores]);
    }

    function update(Request $request,$id){
        $sedema=Sedema::find($id);
        $sedema->nombre=$request->nombre;
        $sedema->cargo=$request->cargo;
        $sedema->mail=$request->mail;
        $sedema->pass=$request->pass;
        if($sedema->save()){
            return redirect('admsedema')->with('success', 'Se actializ&oacute; la informaci&oacute;n.');
        }else{
            return redirect('admsedema')->with('error', 'Error al guardar.');
        }
    }
 
    function store(Request $request){
        $sedema=DB::table('sedemas')->where('mail',$request->mail)->first();
        if($sedema){
            return Redirect::back()->with('error', 'Error, el correo ya está registrado.');
        }
        $sedema=new Sedema();
        $sedema->id=GetUuid();
        $sedema->nombre=$request->nombre;
        $sedema->cargo=$request->cargo;
        $sedema->mail=$request->mail;
        $sedema->pass=$request->pass;
        if($sedema->save()){
            return redirect('admsedema')->with('success', 'Se actializdo la información');
        }else{
            return redirect('admsedema')->with('error', 'Error al guardar.');
        }
    
    

       
        
    }
    function QuitarAdmin($id){
  
        $sedema=Sedema::find($id);
      
        if($sedema->delete()){
            return redirect('admsedema')->with('success', 'Se borro el registro.');
            
        }else{
                return redirect('admsedema')->with('error', 'Error al borrar.');
            }       
        
    } 
}