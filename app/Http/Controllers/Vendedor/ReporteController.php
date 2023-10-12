<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\ReporteCitasAdministracion;
use App\Exports\ReporteCitasAdministracionFotos;
use App\Exports\ReportePagosAdministracion;
use App\Exports\ReporteStatusObraAdministracion;
use Maatwebsite\Excel\Facades\Excel;

class ReporteController extends Controller
{
    
    public function __construct(){
        $this->middleware('vendedorlogged');
    }

    
    public function index()
    {
        $obras=DB::table('obras')
        ->where('id_planta','=',Auth::guard('vendedores')->user()->id_planta)
        ->orderby('obra','asc')->get();
        return view('ventas.reportes.reportes',['obras'=>$obras]);
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

   
}
