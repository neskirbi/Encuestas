<?php

namespace App\Exports\Administracion;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class ReporteTransporte implements FromView
{
    private $pedidos;
    public function  __construct($obra,$ini,$fin,$id_planta){
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 0); 

        ini_set('post_max_size', '30G');


        $this->pedidos= DB::table('obras')
        ->join('pedidos','pedidos.id_obra','=','obras.id')
        ->select(DB::raw("(Select razonsocial from generadores where id=obras.id_generador) as generador"),
        DB::raw("(Select group_concat(concat(descripcion,' $',format(precio,2)) separator'\n') as detalle from detallepedidos where id_pedido=pedidos.id) as detalle"),
        'obras.obra','pedidos.subtotal','pedidos.iva','pedidos.total','pedidos.created_at','pedidos.updated_at')
        ->where('obras.id','like','%'.($obra == 0 ? '' : $obra).'%')
        ->where('pedidos.created_at','>=',$ini)
        ->where('pedidos.updated_at','<=',$fin)
        ->where('obras.id_planta','=',$id_planta)
        ->where('pedidos.confirmacion','=',2)
        ->orderby('pedidos.created_at','desc')
        ->get();
        
        for($i=0;$i<count($this->pedidos);$i++){            
            $this->pedidos[$i]->created_at=FechaFormateada($this->pedidos[$i]->created_at);

        }

    }


    public function view(): View
    { 
      
        return view('formatos.reportes.administradores.reportetransporte', [
            'pedidos' => $this->pedidos
        ]);
    }
}
