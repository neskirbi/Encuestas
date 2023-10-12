<?php

namespace App\Http\Controllers\Administracion;

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
use App\Models\Obra;

class ReporteController extends Controller
{



    public function __construct(){
        //No activar por que no salen los reportes compartidos
        //$this->middleware('administradorlogged');
    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obras=DB::table('obras')
        ->where('id_planta','=',GetIdPlanta())
        ->orderby('obra','asc')->get();
        return view('administracion.reportes.reportes',['obras'=>$obras]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

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
        //return Excel::download(new ReporteTransporte($obra,$ini,$fin,$id_planta), 'ReporteTransporte-'.$ini.' '.$fin.'.xlsx');     
         
    }
    function ReporteStatusObraAdministracion($id_planta){   

        
        




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
