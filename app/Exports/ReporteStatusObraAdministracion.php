<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Illuminate\Support\Facades\DB;
use App\Models\Cita;

use App\Models\Obra;
class ReporteStatusObraAdministracion implements FromView
{
    private $id_planta;
    public function  __construct($id_planta){
        $this->id_planta=$id_planta;
        Memoria();
    }
    public function view(): View
    {

        $obrass=array();
        $obras = Obra::select('id')->where('obras.id_planta','=',$this->id_planta)->get();

        $in=array();

        $cont=0;
        foreach($obras as $obra){
            $in[]=$obra->id;
            
            $cont++;


            if((count($in)%10)==0 || count($obras)==$cont){
                

                $obrass[] = DB::table('generadores')
                ->join('obras' ,'obras.id_generador','=','generadores.id')
                ->select('obras.deshabilitada','generadores.razonsocial','obras.obra','obras.fechainicio','obras.fechafin','obras.terminada','obras.created_at',
                DB::raw("( datediff(obras.fechainicio,now())  ) as iniciada "),
                'obras.descuento','obras.superficie','obras.superunidades','obras.puedepospago','obras.updated_at','obras.contrato',
                DB::raw("(select sum(mat.cantidad*mat.precio)+(sum(mat.cantidad*mat.precio)*(obras.ivaobra/100)) from materialesobra as mat where mat.id_obra=obras.id) as monto"),
                DB::raw("(select sum(mat.cantidad*mat.precio)+(sum(mat.cantidad*mat.precio)*(obras.ivaobra/100)) from materialesobra as mat where mat.id_obra=obras.id)-((select sum(mat.cantidad*mat.precio)+(sum(mat.cantidad*mat.precio)*(obras.ivaobra/100)) from materialesobra as mat where mat.id_obra=obras.id)*(obras.descuento/100)) as montototal"),
                db::raw("(select SUM((citas.precio*citas.cantidad)+((citas.precio*citas.cantidad)*citas.iva/100)) from citas where id_obra=obras.id and citas.confirmacion=1) as reciclaje"),
                DB::raw("(select sum(monto) from pagos where id_obra=obras.id and status=2) as pagos"),
                DB::raw("(select sum(total) from pedidos where confirmacion=2 and id_obra=obras.id) as pedidos"),
                DB::raw("(select sum(cantidad) from citas where id_obra=obras.id and confirmacion=1) as entregado"),
                DB::raw("(select fechacita from citas where id_obra=obras.id and confirmacion=1 order by fechacita asc limit 0,1) as primera"),
                DB::raw("(select fechacita from citas where id_obra=obras.id and confirmacion=1 order by fechacita desc limit 0,1) as ultima"),
                DB::raw("(select datediff(fechacita,now()) from citas where id_obra=obras.id and confirmacion=1 order by fechacita desc limit 0,1) as activa")
                )
                ->wherein('obras.id',$in)
                ->where('obras.verificado','=',1)
                ->get();

            
                
                $in=array();
            }
            
        }

        //return $obrass;
       

        return view('formatos.reportes.administradores.reportestatusobra',['obrass'=>$obrass]);
    }
}
