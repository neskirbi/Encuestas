<?php

namespace App\Exports\Director;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Illuminate\Support\Facades\DB;
use App\Models\Cita;

class StatusObrasDirector implements FromView
{
    private $id_planta;
    public function  __construct($id_planta){
        $this->id_planta=$id_planta;
    }
    public function view(): View
    {
        $obras = DB::table('generadores')
        ->join('obras' ,'obras.id_generador','=','generadores.id')
        ->select('obras.deshabilitada','generadores.razonsocial','obras.obra','obras.fechainicio','obras.fechafin','obras.descuento','obras.superficie','obras.superunidades','obras.puedepospago','obras.updated_at','obras.contrato',
        DB::raw("(select sum(mat.cantidad*mat.precio)+(sum(mat.cantidad*mat.precio)*(obras.ivaobra/100)) from materialesobra as mat where mat.id_obra=obras.id) as monto"),
        DB::raw("(select sum(mat.cantidad*mat.precio)+(sum(mat.cantidad*mat.precio)*(obras.ivaobra/100)) from materialesobra as mat where mat.id_obra=obras.id)-((select sum(mat.cantidad*mat.precio)+(sum(mat.cantidad*mat.precio)*(obras.ivaobra/100)) from materialesobra as mat where mat.id_obra=obras.id)*(obras.descuento/100)) as montototal"),
        db::raw("(select SUM((citas.precio*citas.cantidad)+((citas.precio*citas.cantidad)*citas.iva/100)) from citas where id_obra=obras.id and confirmacion=1) as reciclaje"),
        DB::raw("(select sum(monto) from pagos where id_obra=obras.id and status=2) as pagos"),
        DB::raw("(select sum(total) from pedidos where confirmacion=2 and id_obra=obras.id) as pedidos"),
        DB::raw("(select sum(cantidad) from citas where id_obra=obras.id and confirmacion=1) as entregado")
        )
        ->where('obras.id_planta','=',$this->id_planta)
        ->where('obras.verificado','=',1)
        ->get();

        /*$total=DB::table('materialesobra')
        ->select(DB::raw("(select sum(cantidad*precio)+(sum(cantidad*precio)*(".$obra->ivaobra."/100)) from materialesobra where id_obra='".$id."') as total"))->first();
        $total=$total->total-($total->total*($obra->descuento/100));
*/
        return view('formatos.reportes.director.reportestatusobra',['obras'=>$obras]);
    }
}
