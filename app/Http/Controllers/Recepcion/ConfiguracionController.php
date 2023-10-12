<?php

namespace App\Http\Controllers\Recepcion;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Configuracion;
use App\Models\Recepcion;
use App\Models\Planta;
use Redirect;
class ConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configuraciones=DB::table('configuraciones')->where('id_planta','=',Auth::guard('recepciones')->user()->id_planta)->first();
        $planta=Planta::find(Auth::guard('recepciones')->user()->id_planta);
        $recepcion=Recepcion::find(Auth::guard('recepciones')->user()->id);
        return view('recepcion.configuraciones.configuraciones',['configuraciones'=>$configuraciones,'recepcion'=>$recepcion,'planta'=>$planta]);
    }

    

    function ConfiguracionCuenta(Request $request){
        $recepcion=Recepcion::where('mail',$request->mail)->first();

        if($recepcion && $request->mail!=Auth::guard('recepciones')->user()->mail){
            return redirect('configuracionnes')->with('error','Error, el correo ya esta en uso.');
        }

        $recepcion=Recepcion::find(Auth::guard('recepciones')->user()->id);
        $recepcion->nombre=$request->nombre;
        $recepcion->cargo=$request->cargo;
        $recepcion->firma=$request->firma==null ? '' : $request->firma;
        if($recepcion->save()){            
            return redirect('configuracionnes')->with('succes', 'Datos guardados.');
        }else{
            return redirect('configuracionnes')->with('error', 'Error al guardar.');
        }
    }

    function CambioPass(Request $request,$id){
        if($request->pass!=$request->pass){            
            return redirect('configuracionnes')->with('error', 'Error, las contraseñas no coinciden.');
        }
        $recepcion=Recepcion::find($id);
        $recepcion->pass=password_hash($request->pass,PASSWORD_DEFAULT);
        if($recepcion->save()){ 
            return redirect('logout');
            return redirect('configuracionnes')->with('success', 'Datos guardados.');
        }else{
            return redirect('configuracionnes')->with('error', 'Error al guardar.');
        }
    }


    
}
