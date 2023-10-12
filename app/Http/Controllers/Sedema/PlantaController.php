<?php

namespace App\Http\Controllers\Sedema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Planta;
use App\Models\Material;
use Redirect;


class PlantaController extends Controller
{
    function show($id_planta){
        /**
         * Datos de los pagos 
         */
        $planta=Planta::find($id_planta);
        
        $volumen = DB::table('citas')
        ->whereraw("id_obra in (select id from obras where id_planta='".$id_planta."')")
        ->where('confirmacion',1)
        ->select( DB::raw('SUM(citas.cantidad) as volumen'))
        ->first();


        $citas=DB::table('citas')
        ->select(DB::raw('sum((citas.cantidad*citas.precio)+(citas.cantidad*citas.precio*(citas.iva/100))) as consumo'))
        ->where('id_planta',$id_planta)
        ->where('citas.confirmacion',1)
        ->first();

        /**
         * Aqui solo se calcula la suma de la columna total, porque ya viene el iva
         */
        $pedidos = DB::table('pedidos') 
        ->where('id_planta',$id_planta) 
        ->where('confirmacion','=',2)
        ->select( DB::raw('SUM((total)) as monto'))
        ->first();

        $consumo=$citas->consumo+$pedidos->monto;

        /**
         * Datos para las graficas de depositos por mes
         */

        


        /**
         * Datos de las citas para sedema 
         */


        $citas = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('obras.id_planta',$id_planta)
        ->count();

        $pendientes = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('obras.id_planta',$id_planta)
        ->where('citas.confirmacion',0)
        ->count();

        $confirmadas = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('obras.id_planta',$id_planta)
        ->where('citas.confirmacion',1)
        ->count();

        $faltas = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('obras.id_planta',$id_planta)
        ->where('citas.confirmacion',2)
        ->count();

        
        /**
         * Datos para la grafica de citasa
         */

        

        /**
         * Datos para la grafica de contratos
         * 
         */
        $obras=DB::table('obras')
        ->select('id','id_planta','contrato')
        ->where('obras.id_planta',$id_planta)
        ->where('obras.contrato','=',1)
        ->get();
        $firmados=0;
        foreach($obras as $obra){
            $transporte=DB::select(DB::raw("select (precio*cantidad) as transporte from transporteobras where id_obra='".$obra->id."' and cantidad>0 "));
            $material=DB::select(DB::raw("select sum(cantidad*precio) as material from materialesobra where id_obra='".$obra->id."'"));
            if(isset($transporte[0]))
            $firmados+=$transporte[0]->transporte;

            if(isset($material[0]))
            $firmados+=$material[0]->material;

        }
        
        
        $obras=DB::table('obras')
        ->select('id','id_planta','contrato')
        ->where('obras.id_planta',$id_planta)
        ->where('obras.contrato','=',0)
        ->get();
        $sinfirmar=0;
        foreach($obras as $obra){
            $transporte=DB::select(DB::raw("select (precio*cantidad) as transporte from transporteobras where id_obra='".$obra->id."' and cantidad>0 "));
            $material=DB::select(DB::raw("select sum(cantidad*precio) as material from materialesobra where id_obra='".$obra->id."'"));
            if(isset($transporte[0]))
            $sinfirmar+=$transporte[0]->transporte;

            if(isset($material[0]))
            $sinfirmar+=$material[0]->material;

        }




       
        return view('sedema.dashboard.dashboard',['planta'=>$planta,'pago'=>$volumen->volumen,'consumo'=>$consumo,'citas'=>$citas,
        'pendientes'=>$pendientes,'confirmadas'=>$confirmadas,'faltas'=>$faltas,
        'firmados'=>number_format($firmados,2),'sinfirmar'=>number_format($sinfirmar,2)]);
    }

    function GraficaVolumenSEDEMA(Request $request){
        //return $request;
        $id_planta=$request->id_planta;
        $year = $request->year;
        $volumen = DB::table('citas')
        ->whereraw("id_obra in (select id from obras where id_planta='".$id_planta."')")
        ->whereraw('YEAR(citas.fechacita) = \''.$year.'\'')
        ->where('confirmacion',1)
        ->select(DB::raw('YEAR(citas.fechacita) year, MONTH(citas.fechacita) month'), DB::raw('FORMAT(SUM(citas.cantidad),2) as volumen'))
        ->groupby('year','month')
        ->get();

        
        return view('sedema.dashboard.frames.graficavolumen',['volumen'=>$volumen,'id_planta'=>$id_planta,'year'=>$year]);
    }

    function CitasSedemaPlanta(Request $request){
        /**
     * Datos de las citas para sedema 
     */

        $id_planta=$request->id_planta;
        $year = $request->year;
       

        
        /**
         * Datos para la grafica de citasa
         */

        $citasmes = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('obras.id_planta',$id_planta)
        ->whereraw('YEAR(citas.created_at) = \''.$year.'\'')
        ->where('obras.verificado',1)
        ->select(DB::raw('YEAR(citas.created_at) year, MONTH(citas.created_at) month'),DB::raw("count(citas.id) as citas"))
        ->groupby('year','month')
        ->get();

        $citasmesconfi = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('obras.id_planta',$id_planta)
        ->whereraw('YEAR(citas.created_at) = \''.$year.'\'')
        ->where('citas.confirmacion',1)
        ->select(DB::raw('YEAR(citas.created_at) year, MONTH(citas.created_at) month'),DB::raw("count(citas.id) as citas"))
        ->groupby('year','month')
        ->get();
        
        $faltasmes = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('obras.id_planta',$id_planta)
        ->whereraw('YEAR(citas.created_at) = \''.$year.'\'')
        ->where('citas.confirmacion',2)
        ->select(DB::raw('YEAR(citas.created_at) year, MONTH(citas.created_at) month'),DB::raw("count(citas.id) as citas"))
        ->groupby('year','month')
        ->get();

        return view('sedema.dashboard.frames.graficacitas',['id_planta'=>$id_planta,'year'=>$year,
        'citasmes'=>$citasmes,'citasmesconfi'=>$citasmesconfi,
        'faltasmes'=>$faltasmes]);

    }

    function GraficasMaterialMesSEDEMA(Request $request){
        /**
         * Datos para la grafica de citas
         */
        
        $id_planta=$request->id_planta;
        $year = isset($request->year) ? $request->year : date('Y');
        $month = isset($request->month) ? $request->month : date('m');

        $materialmes = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('obras.id_planta',$id_planta)
        ->where('citas.confirmacion',1)
        ->whereraw('YEAR(citas.fechacita) = \''.$year.'\'')        
        ->whereraw('MONTH(citas.fechacita) = \''.$month.'\'')
        ->select(DB::RAW("concat(citas.material,' 0 m³') as material"),DB::raw("FORMAT(sum(citas.cantidad),2) as cantidad"))
        ->groupby('citas.material')
        ->get();

        $materiales=Material::select(DB::RAW("concat(material,' 0 m³') as material"),DB::RAW("0 as cantidad"))
        ->where('materiales.id_planta',$id_planta)
        ->orderby('material','asc')
        ->get();
        
        for($i=0;$i<count($materiales);$i++){
            
            foreach($materialmes as $j=>$mater){
                if($materiales[$i]->material==$materialmes[$j]->material){
                    $materiales[$i]->material=str_replace(' 0 m³',' '.$materialmes[$j]->cantidad.' m³',$materiales[$i]->material);
                    $materiales[$i]->cantidad=$materialmes[$j]->cantidad;
                    unset($materialmes[$j]);
                    break;
                }
            }
           
        }
        //return $noestan;
        foreach($materialmes as $notan){
            $notan->material=str_replace(' 0 m³',' '.$notan->cantidad.' m³',$notan->material);
            //$notan->material=$notan->material.' '.$notan->cantidad.' m³';
            $materiales[]=$notan;
        }

        $materialmes=$materiales;

        //return $material;


        $total = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('obras.id_planta',$id_planta)
        ->where('citas.confirmacion',1)
        ->whereraw('YEAR(citas.fechacita) = \''.$year.'\'')        
        ->whereraw('MONTH(citas.fechacita) = \''.$month.'\'')
        ->select('obras.id_planta',DB::raw("sum(citas.cantidad) as total"))        
        ->groupby('obras.id_planta')
        ->first();
  
        
        
        return view('sedema.dashboard.frames.materialmensual',['filtros'=>$request,'materialmes'=>$materialmes,'id_planta'=>$id_planta,'total'=>(isset($total->total)?$total->total:0) ]);
    }
}
