<?php

namespace App\Http\Controllers\Director;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


use App\Exports\ReporteCitasAdministracion;
use App\Exports\Administracion\ReporteTransporte;
use App\Exports\ReporteCitasAdministracionFotos;
use App\Exports\ReportePagosAdministracion;
use App\Exports\Director\StatusObrasDirector;
use App\Exports\Administracion\ReporteMaterialesAnual;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Material;

class ReporteController extends Controller
{



    public function __construct(){
        $this->middleware('directorlogged');
    }
   
   
    

    public function index()
    {
        
        $obras=DB::table('obras')
        ->where('id_planta','=',GetIdPlanta())
        ->orderby('obra','asc')->get();
        return view('directores.reportes.reportes',['obras'=>$obras]);
    }

  
    
    


    function StatusObrasDirector($id_planta){   
     
        return Excel::download(new StatusObrasDirector($id_planta), 'StatusObrasDirector'.'.xlsx');
    }
 



   
}
