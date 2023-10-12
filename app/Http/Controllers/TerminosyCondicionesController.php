<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TerminosyCondicionesController extends Controller
{
    function terminosycondiciones($direccion,$fechaini,$fechafin,$generador,$total){
        return view('formatos.terminosycondiciones',['direccion'=>$direccion,
        'fechaini'=>$fechaini,'fechafin'=>$fechafin,
        'generador'=>$generador,'total'=>$total]);
        
    }
}
