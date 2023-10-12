<?php

namespace App\Http\Controllers\Finanzas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\Finanzas\ReportePagosFinanzas;
use App\Exports\Finanzas\ReporteObra;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Obra;

class ReporteController extends Controller
{


    public function __construct(){
        $this->middleware('finanzaslogged');
    }

    

    function index(){
        $obras=Obra::where('id_planta',Auth::guard('finanzas')->user()->id_planta)->orderby('obra','asc')->get();
        return view('finanzas.reportes.reportes',['obras'=>$obras]);
    }



    function Geppettos(){
        return Excel::download(new ReporteObra(), 'ReportesObras'.'.xlsx');
    }

    function ReportePagosFinanzas($id_planta,$inipago,$finpago){
       

        //return   $id_planta.'  '.$inipago.'  '.$finpago;
        return Excel::download(new ReportePagosFinanzas($id_planta,$inipago,$finpago), 'ReportePagos.xlsx');
    }
}
