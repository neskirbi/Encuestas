<?php

namespace App\Http\Controllers\Sedema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sedema;

class ConfiguracionController extends Controller
{
    function index(){
        $sedema=Sedema::find(Auth::guard('sedemas')->user()->id);
        return view('sedema.configuraciones.configuraciones',['sedema'=>$sedema]);
    }
    function DatosCuentaEdit(Request $request){
        $sedema=Sedema::where('mail',$request->mail)->first();
        if($sedema && $request->mail!=Auth::guard('sedemas')->user()->mail){
            return redirect('configuraciones')->with('error','Error, el correo ya esta en uso.');
        }
        $sedema=Sedema::find(Auth::guard('sedemas')->user()->id);
        $sedema->nombre=$request->nombre;
        $sedema->mail=$request->mail;
        $sedema->pass=$request->pass;
        if($sedema->save()){
            return redirect('logout');
        }else{
            return redirect('configuraciones')->with('error','Error al guardar.');
        }
    }
}
