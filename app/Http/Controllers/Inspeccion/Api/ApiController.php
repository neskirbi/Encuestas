<?php

namespace App\Http\Controllers\Inspeccion\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Generador;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    function GetDatosObra(Request $request){
        $generador = Generador::join('obras','obras.id_generador','=','generadores.id')
        ->select('obras.id','obras.obra','obras.calle','obras.numeroext','obras.fechainicio','obras.fechafin','obras.numeroint', 'obras.colonia', 'obras.cp', 'obras.municipio', 'obras.entidad',
        db::raw("(select razonsocial from generadores  where id = obras.id_generador) as razonsocial"),
        db::raw("(select concat(nombresrepre,' ',apellidosrepre,' ',nombresfisica,' ',apellidosfisica ) from generadores  where id = obras.id_generador) as repre"))
        ->where('obras.id',$request->id)
        ->first();
        
        $generador->fechainicio=FechaFormateada($generador->fechainicio);
        $generador->fechafin=FechaFormateada($generador->fechafin);

        return $generador;
    }
}
