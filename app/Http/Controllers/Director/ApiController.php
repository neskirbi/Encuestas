<?php

namespace App\Http\Controllers\Director;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Generador;
use App\Models\Obra;
use App\Models\Material;

use App\Exports\ReporteCitasAdministracion;
use App\Exports\Administracion\ReporteTransporte;
use App\Exports\ReporteCitasAdministracionFotos;
use App\Exports\ReportePagosAdministracion;
use App\Exports\ReporteStatusObraAdministracion;
use App\Exports\Administracion\ReporteMaterialesAnual;
use Maatwebsite\Excel\Facades\Excel;


class ApiController extends Controller
{
    function StatusObrasDirector(Request $request){
        $obras = DB::table('generadores')
        ->join('obras' ,'obras.id_generador','=','generadores.id')
        ->select('generadores.razonsocial','obras.obra','obras.fechainicio','obras.fechafin','obras.descuento','obras.superficie','obras.superunidades','obras.puedepospago',
        DB::raw("(select sum(mat.cantidad*mat.precio)+(sum(mat.cantidad*mat.precio)*(obras.ivaobra/100)) from materialesobra as mat where mat.id_obra=obras.id) as monto"),
        DB::raw("(select sum(mat.cantidad*mat.precio)+(sum(mat.cantidad*mat.precio)*(obras.ivaobra/100)) from materialesobra as mat where mat.id_obra=obras.id)-((select sum(mat.cantidad*mat.precio)+(sum(mat.cantidad*mat.precio)*(obras.ivaobra/100)) from materialesobra as mat where mat.id_obra=obras.id)*(obras.descuento/100)) as montototal"),
        DB::raw("(select sum(monto) from pagos where id_obra=obras.id and status=2) as pagos"),
        DB::raw("(select sum(cantidad) from citas where id_obra=obras.id and confirmacion=1) as entregado")
        )
        ->where('obras.id_planta','=',$request->id_planta)
        ->where('obras.verificado','=',1)
        ->get();
        return $obras;
    }

    function GetObrasPagosFin(Request $request){
        return $obras=Obra::select('obras.id','obras.obra',
        DB::RAW("(select planta from plantas where id=obras.id_planta) as planta"))->
        where('id_generador',$request->generador)->get();
    }
}
