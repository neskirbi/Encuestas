<?php

namespace App\Http\Controllers\Android\RecitrackRecoleccion\Recolectores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recolector;

class LoginController extends Controller
{
    function RecolectorLogin(Request $request){
        if(strlen($request->telefono)==0 || $request->telefono==null){
            $request['error']='¡Error en el telefono(Campo Vacío)!';
            return $request;
        }
        if(strlen($request->pass)==0 || $request->pass==null){
            $request['error']='¡Error en la contraseña(Campo Vacío)!';
            return $request;
        }
        
        $recolector = Recolector::where([
            'telefono' => $request->telefono
        ])->first();

      
        if($recolector){
            
            if($request->pass!=$recolector->pass){
                $request['error']='¡Error de contraseña!';
                return $request;
            }
                
            return $recolector;
        }else{
            $request['error']='Teléfono incorrecto!';
            return $request;
        }
    }

    function ConfirmacionRecolector($id){
        $recolector=Recolector::find($id);
        if(!$recolector){
            return redirect('home')->with('error','Error de url.');
        }
        $recolector->confirmacion=1;
        if($recolector->save()){
            return view('mails.telefonoconfirmado');
        }else{
            return redirect('home')->with('error','Error al confirmar.');
        }
    }
}
