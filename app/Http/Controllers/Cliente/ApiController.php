<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function AvanceEntregas(Request $request){
        $superficie=DB::table('obras')
        ->leftjoin('citas','citas.id_obra','=','obras.id')
        ->where('obras.id',$request->id_obra)
        ->select('obras.id','obras.obra','obras.superficie','obras.fechainicio','obras.fechafin')
        ->get();

        $entregado=DB::table('obras')
        ->leftjoin('citas','citas.id_obra','=','obras.id')
        ->where('obras.id',$request->id_obra)
        ->where('citas.confirmacion',1)
        ->select('obras.id','obras.obra','citas.confirmacion',DB::raw('SUM(citas.cantidad) as entregado'))
        ->groupby('obras.id','obras.obra','citas.confirmacion')
        ->get();

        $entregasdiarias=DB::table('obras')
        ->leftjoin('citas','citas.id_obra','=','obras.id')
        ->where('obras.id',$request->id_obra)
        ->where('citas.confirmacion',1)
        ->select(DB::raw('SUM(citas.cantidad) as entregado'),DB::raw('Date(citas.fechacita) as fecha'))
        ->groupby('fecha')
        ->get();
        return ['superficie'=>$superficie,'entregado'=>$entregado,'entregasdiarias'=>$entregasdiarias];
    }
}
