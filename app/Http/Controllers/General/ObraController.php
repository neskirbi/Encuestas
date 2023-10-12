<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;

class ObraController extends Controller
{
    function terminacion($id){
        return redirect(url('documentos/clientes/finalizacion/'.$id.'.pdf'));
    }
}
