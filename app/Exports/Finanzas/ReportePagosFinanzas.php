<?php

namespace App\Exports\Finanzas;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Illuminate\Support\Facades\DB;
use App\Models\Cita;

class ReportePagosFinanzas implements FromView
{
    private $id_planta,$inipago,$finpago;
    public function  __construct($id_planta,$inipago,$finpago){
        $this->id_planta=$id_planta;
        $this->inipago=$inipago;
        $this->finpago=$finpago;
    }
   
    public function view(): View
    {

        $pagos=DB::table('pagos')
        ->join('obras','obras.id','=','pagos.id_obra')
        ->where('obras.id_planta','=',$this->id_planta)
        ->whereraw("date(pagos.created_at)>='".$this->inipago."'")
        ->whereraw("date(pagos.created_at)<='".$this->finpago."'")
        ->where('pagos.status','=',2)
        ->select(DB::raw("(select razonsocial from generadores where id = obras.id_generador) as generador"),'obras.obra','pagos.monto','pagos.referencia','pagos.descripcion','pagos.created_at')
        ->orderby('pagos.created_at','asc')        
        ->get();
        

        for($i=0;$i<count($pagos);$i++){            
            $pagos[$i]->created_at=FechaFormateada($pagos[$i]->created_at);
            $pagos[$i]->monto=number_format($pagos[$i]->monto,2);
        }

        return view('formatos.reportes.administradores.reportepagos', [
            'pagos' => $pagos
        ]);
    }
}
