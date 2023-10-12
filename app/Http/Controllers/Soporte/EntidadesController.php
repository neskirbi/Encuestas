<?php

namespace App\Http\Controllers\Soporte;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entidad;

class EntidadesController extends Controller
{
    function index(){
        $entidades=Entidad::orderby('entidad','asc')->get();
        return view('soporte.entidades.entidades',['entidades'=>$entidades]);
    }

    
}
