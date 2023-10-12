<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Pago;
use App\Models\Cliente;
use App\Models\Obra;
use App\Models\Negocio;
use App\Models\Planta;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Redirect;

class SaldoController extends Controller
{

    public function __construct(){
        $this->middleware('administradorlogged');
    }

    public function index(Request $filtros){


        $clientessaldos = GetSaldosPorObras($filtros);
         

        $saldo=GetSaldosPlanta(GetIdPlanta());
       

        return view('administracion.saldos.saldos',['filtros'=>$filtros,'saldo'=>$saldo,'links'=>$clientessaldos['links'],
        'clientegastos'=>$clientessaldos['saldos']]);
    }
}
