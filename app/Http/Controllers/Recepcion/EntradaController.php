<?php

namespace App\Http\Controllers\Recepcion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    function index(){
        return view('recepcion');
    }
}
