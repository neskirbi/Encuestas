<?php

namespace App\Http\Controllers\General\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Obra;

class RegistroController extends Controller
{

    public function __construct(){
        //$this->middleware('directorlogged');
    }
    
    function index(){        
        return view('GeneralAdministracion.registros.registros');
    }

    function GraficasRegistrosObras(Request $filtros){
        //return $filtros;
        $year = isset($filtros->year) ? $filtros->year : date('Y');
        $ini = isset($filtros->ini) ? $filtros->ini : 01;
        $fin = isset($filtros->fin) ? $filtros->fin : 12;

        $registros = DB::select("select count(id) as registros,month(created_at) as mes 
        from obras where id_planta='".GetIdPlanta()."' and verificado= 1 and year(created_at)='".$year."' group by mes order by mes  ");

        $iniciar = DB::select("select count(id) as iniciar,month(fechainicio) as mes 
        from obras where id_planta='".GetIdPlanta()."' and verificado= 1 and year(fechainicio)='".$year."' group by mes order by mes  ");

        //return"select count(id_obra) as iniciadas, mes from (select id_obra,month(created_at) as mes 
        //from citas where id_planta='".GetIdPlanta()."' and confirmacion= 1 and year(created_at)='".$year."' group by id_obra,mes order by mes) as ini group by mes
        // "; 
          
        $iniciadas = DB::select("
        

        select count((select (created_at) from citas where id_obra=obr.id and year(created_at)='".$year."' order by created_at asc limit 0,1)) as iniciada,
        (select month(created_at) from citas where id_obra=obr.id and year(created_at)='".$year."' order by created_at asc limit 0,1) as mes 
        from obras as obr where id_planta='".GetIdPlanta()."' group by mes order by mes;
        
          ");

        $datos=array();
        $datos[0] = 0;
        $datos[1] = 0;
        $datos[2] = 0;

        foreach($registros as $index=>$registro){
            if(($registros[$index]->mes)<$ini || ($registros[$index]->mes)>$fin){
                unset($registros[$index]);
                continue;
            }
            if($registro->mes!=null)
            $datos[0] += $registro->registros; 
        }

        foreach($iniciar as $index=>$iniciars){
            //return$iniciar[$index]->mes;
            if(($iniciar[$index]->mes)<$ini || ($iniciar[$index]->mes)>$fin){
                unset($iniciar[$index]);
                continue;
            }
            if($iniciars->mes!=null)
            $datos[1] += $iniciars->iniciar; 
        }

        //return $iniciar;
        foreach($iniciadas as $index=>$iniciada){
            if(($iniciadas[$index]->mes)<$ini || ($iniciadas[$index]->mes)>$fin){
                unset($iniciadas[$index]);
                continue;
            }
            if($iniciada->mes!=null)
            $datos[2] += $iniciada->iniciada; 
        }
        //return $datos;


        return view('GeneralAdministracion.registros.frames.graficaregistros',['registros'=>collect($registros),'iniciar'=>collect($iniciar),'iniciadas'=>collect($iniciadas),'filtros'=>$filtros,'datos'=>$datos]);
    }
}
