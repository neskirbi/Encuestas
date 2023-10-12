<?php

namespace App\Http\Controllers\General\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


use App\Exports\ReporteCitasAdministracion;
use App\Exports\Administracion\ReporteTransporte;
use App\Exports\ReporteCitasAdministracionFotos;
use App\Exports\ReportePagosAdministracion;
use App\Exports\ReporteStatusObraAdministracion;
use App\Exports\Administracion\ReporteMaterialesAnual;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Material;

class ReporteController extends Controller
{



    

    function ReportePagosAdministracion($id_planta,$month,$year){  
        return Excel::download(new ReportePagosAdministracion($id_planta,$month,$year), 'ReportePagos.xlsx');
    }

    function ReporteCitasAdministracion($obra,$ini,$fin,$id_planta,$fotos){ 
        if($fotos==0){
            return Excel::download(new ReporteCitasAdministracion($obra,$ini,$fin,$id_planta), 'ReporteCitas-'.$ini.' '.$fin.'.xlsx');
        } else if($fotos==1){
            return Excel::download(new ReporteCitasAdministracionFotos($obra,$ini,$fin,$id_planta), 'ReporteCitasFotos-'.$ini.' '.$fin.'.xlsx');
        }      
         
    }


    function ReporteTransporte($obra,$ini,$fin,$id_planta){ 
        
        return Excel::download(new ReporteTransporte($obra,$ini,$fin,$id_planta), 'ReporteTransporte-'.$ini.' '.$fin.'.xlsx');     
         
    }
    function ReporteStatusObraAdministracion($id_planta){   
        /*return$obras = DB::table('generadores')
        ->join('obras' ,'obras.id_generador','=','generadores.id')
        ->where('obras.id_planta','=',$id_planta)
        ->select('generadores.razonsocial','obras.obra','obras.fechainicio','obras.fechafin',
        DB::raw("(select sum(mat.cantidad*mat.precio)+(sum(mat.cantidad*mat.precio)*(obras.ivaobra/100)) from materialesobra as mat where mat.id_obra=obras.id) as monto")
        )
        ->get();    */
        return Excel::download(new ReporteStatusObraAdministracion($id_planta), 'ReporteStatusObras'.'.xlsx');
    }
 
    function BorrarTemporales(){
        $ruta=public_path().'/images/temp';
        //Limpiando el folder 
        $files = glob($ruta); // get all file names
        foreach($files as $file){ // iterate files
            if(is_file($file)) {
            unlink($file); // delete file
            }
        }
    }


    function ReporteMaterialesAnual($year){ 


        
        $id_planta=GetIdPlanta();
        $materiales=DB::select("select material,month(fechacita) as mes ,FORMAT(sum(cantidad),2) as cantidad from citas 
        where id_obra in (select id from obras where id_planta = '".$id_planta."') 
        and year(fechacita)='".$year."' 
        and confirmacion = 1
        group by material,mes order by  mes asc ,material asc");
        
       


        
        //return view('formatos.reportes.administradores.reportematerialesanual', [  'materiales' => $materiale ]);
        return Excel::download(new ReporteMaterialesAnual($materiales), 'ReporteMaterialesAnual.xlsx');     
         
    }

   
}
