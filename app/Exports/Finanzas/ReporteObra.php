<?php

namespace App\Exports\Finanzas;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\ReporteCitasAdministracion;
use App\Exports\ReporteCitasAdministracionFotos;
use App\Exports\ReportePagosAdministracion;
use App\Exports\ReporteStatusObraAdministracion;

class ReporteObra implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $obras = DB::table('obras')
        ->join('generadores','generadores.id','=','obras.id_generador')
        ->join('plantas','plantas.id','=','obras.id_planta')
        ->select(DB::raw("(select concat(nombres,' ',apellidos) from clientes where id=generadores.id_cliente) as cliente"),'obras.contrato',
        'planta','plantas.direccion as dirplanta','razonsocial','obra','fechainicio','fechafin','obras.celular','obras.correo','obras.correo2',
        'obras.cantidadobra','obras.superunidades','obras.transporte','obras.puedepospago',
        DB::raw("concat(generadores.calle,' ',generadores.numeroext,' ',generadores.numeroint,' Col.',generadores.colonia,' CP.',generadores.cp,' ',generadores.municipio,' ',generadores.entidad) as domiciliogen"),
        DB::raw("concat(obras.calle,' ',obras.numeroext,' ',obras.numeroint,' Col.',obras.colonia,' CP.',obras.cp,' ',obras.municipio,' ',obras.entidad) as domicilioobr"),
        DB::raw("(select sum(cantidad) as cantidad from citas where id_obra=obras.id and confirmacion=1) as entregado " ),
        DB::raw("(select sum((cantidad*precio)*(1+(iva/100))) as consumo from citas where id_obra=obras.id and confirmacion=1) as consumo " ),
        DB::raw("(select sum(monto) from pagos where id_obra=obras.id and status=2) as monto " ),
        DB::raw("(select sum(precio) from transporteobras where id_obra=obras.id) as preciotrans " ),
        DB::raw("(select max(capacidad) from transporteobras where id_obra=obras.id) as capacidad " ),
        DB::raw("(select sum(precio*cantidad) from materialesobra where id_obra=obras.id) as preciomat " ))
        ->where('id_planta','=',Auth::guard('finanzas')->user()->id_planta)
        ->where('obras.deshabilitada',0)
        ->get();


        return view('formatos.reportes.finanzas.geppettos',['obras'=>$obras]);
    }
}
