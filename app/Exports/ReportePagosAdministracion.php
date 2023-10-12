<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Illuminate\Support\Facades\DB;
use App\Models\Cita;

class ReportePagosAdministracion implements FromView
{
    private $id_planta,$month,$year;
    public function  __construct($id_planta,$month,$year){
        $this->id_planta=$id_planta;
        $this->month=$month;
        $this->year=$year;
    }
   
    public function view(): View
    {

        $pagos=DB::table('pagos')
        ->join('obras','obras.id','=','pagos.id_obra')
        ->where('obras.id_planta','=',$this->id_planta)
        ->whereraw('month(pagos.created_at)='.$this->month)
        ->whereraw('year(pagos.created_at)='.$this->year)
        ->where('pagos.status','=',2)
        ->select(DB::raw("(select razonsocial from generadores where id = obras.id_generador) as generador"),'obras.obra','pagos.monto','pagos.referencia','pagos.descripcion','pagos.created_at')
        ->orderby('pagos.created_at','asc')        
        ->get();
/*
        $pagos= DB::table('pagos')
        ->join('clientes','clientes.id','=','pagos.id_cliente')
        ->where('id_planta','=',$this->id_planta)
        ->whereraw('month(pagos.created_at)='.$this->month)
        ->whereraw('year(pagos.created_at)='.$this->year)
        ->where('pagos.status','=',2)        
        ->select('clientes.nombres','clientes.apellidos','pagos.monto','pagos.referencia','pagos.descripcion','pagos.created_at')
        ->orderby('pagos.created_at','asc')
        ->get();
        */

        for($i=0;$i<count($pagos);$i++){            
            $pagos[$i]->created_at=FechaFormateada($pagos[$i]->created_at);
            $pagos[$i]->monto=number_format($pagos[$i]->monto,2);
        }

        return view('formatos.reportes.administradores.reportepagos', [
            'pagos' => $pagos
        ]);
    }
}
