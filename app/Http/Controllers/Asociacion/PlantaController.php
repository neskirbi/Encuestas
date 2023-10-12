<?php

namespace App\Http\Controllers\Asociacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Administrador;
use App\Models\Planta;
use App\Models\Configuracion;
use Redirect;

class PlantaController extends Controller
{
    function index(){
        $plantas = DB::table('plantas')
        ->join('administradores','administradores.id_planta','=','plantas.id')
        ->select('plantas.id','plantas.planta','plantas.direccion','plantas.plantaauto',DB::raw("GROUP_CONCAT(administradores.administrador SEPARATOR  '<br>') as administradores"))
        ->groupby('plantas.id','plantas.planta','plantas.direccion','plantas.plantaauto')
        ->orderby('planta','asc')
        ->paginate(10);
        return view('asociados.plantas.plantas',['plantas'=>$plantas]);
    }

    function show($id){
        $planta = DB::table('plantas')
        ->where('id',$id)
        ->first();

        $administradores=DB::table('administradores')
        ->where('id_planta',$planta->id)
        ->where('principal',1)
        ->orderby('administrador','asc')
        ->get();

        return view('asociados.plantas.planta',['planta'=>$planta,'administradores'=>$administradores]);
    }

    function update(Request $request,$id){
        $planta=Planta::find($id);
        $planta->planta=$request->planta;
        $planta->siglas=$request->siglas;
        $planta->direccion=$request->direccion;
        $planta->codigo=$request->codigo;
        $planta->plantaauto=$request->plantaauto;
        if($planta->save()){
            return redirect('plantasasoc/'.$id)->with('success', 'Se actializ&oacute; la informaci&oacute;n.');
        }else{
            return redirect('plantasasoc/'.$id)->with('error', 'Error al guardar.');
        }
    }

    function PlantaReg(Request $request){
        $administrador=Administrador::where('mail',$request->mail)->first(); 
        if($administrador){            
            return redirect('plantasasoc')->with('error', 'El correo de administrador ya está registrado, debe utilizar otro.');
        }  


        $planta=new Planta();
        $planta->id=GetUuid();
        $planta->planta=$request->planta;
        $planta->siglas=$request->siglas;
        $planta->direccion=$request->direccion;
        $planta->codigo=$request->codigo;
        $planta->plantaauto=$request->plantaauto;
        $planta->tipo=$request->tipo;

        if(!$planta->save()){
            return redirect('plantasasoc')->with('error', 'Error al registrar la planta.');            
        }


        $administrador=new Administrador();
        $administrador->id=GetUuid();
        $administrador->id_planta=$planta->id;
        $administrador->administrador=$request->administrador;
        $administrador->cargo=$request->cargo;
        $administrador->mail=$request->mail;
        $administrador->principal=1;
        $administrador->pass=password_hash($request->pass,PASSWORD_DEFAULT);
        if(!$administrador->save()){
            return redirect('plantasasoc')->with('error', 'Error al registrar al administrador.');  
        }


        $configuracion=new Configuracion();
        $configuracion->id=GetUuid();
        $configuracion->id_planta=$planta->id;

        if(!$configuracion->save()){
            return redirect('plantasasoc')->with('error', 'Error la configurar.');  
        }
        
        return redirect('plantasasoc')->with('success', 'La planta se registr&oacute; correctamente.');
    }
}
