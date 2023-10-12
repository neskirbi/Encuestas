<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReporteMensualVendedor implements FromView{
    private $materialmes;
    public function  __construct($month,$year){
        ini_set('memory_limit', '-1');

        $this->materialesmes = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('obras.id_planta',Auth::guard('vendedores')->user()->id_planta)
        ->where('citas.confirmacion',1)
        ->whereraw('YEAR(citas.fechacita) = \''.$year.'\'')        
        ->whereraw('MONTH(citas.fechacita) = \''.$month.'\'')
        ->select('citas.material',DB::raw("sum(citas.precio*citas.cantidad) as cantidad"))
        ->groupby('citas.material')
        ->get();

    }
    public function view(): View
    {       
        

        return view('formatos.reportes.vendedores.reportemesvendedor', [
            'materialesmes' => $this->materialesmes
        ]);
    }

    
}
