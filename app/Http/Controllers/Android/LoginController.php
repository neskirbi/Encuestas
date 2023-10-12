<?php

namespace App\Http\Controllers\Android;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administrador;

class LoginController extends Controller
{
    function Login(Request $request){
        $administrador=Administrador::where('mail',$request->mail)
        ->where('pass',$request->pass)
        ->select('id','mail')
        ->first();

        if($administrador){
            return $administrador;
        }else{
            return '{"error":"Datos incorrectos."}';
        }
    }
}
