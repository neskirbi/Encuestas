<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Illuminate\Support\Facades\DB;
class ReporteEncuestas implements FromView
{
    
    public function view(): View
    {
        $hoteles = DB::table('hoteles')->get();

        /*
        $total=DB::table('materialesobra')
        ->select(DB::raw("(select sum(cantidad*precio)+(sum(cantidad*precio)*(".$obra->ivaobra."/100)) from materialesobra where id_obra='".$id."') as total"))->first();
        $total=$total->total-($total->total*($obra->descuento/100));
        */
        return view('formatos.reportes.administradores.hoteles',['hoteles'=>$hoteles]);
    }
}
