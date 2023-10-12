<?php

namespace App\Http\Controllers\Dosificadores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehiculo;

class ApiController extends Controller
{
    function GetVehiculoInfo(Request $request){
        return Vehiculo::where('id',$request->matricula)->first();
    }
}
