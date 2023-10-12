<?php

namespace App\Http\Controllers\Director;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class PagoController extends Controller
{

    public function __construct(){
        $this->middleware('directorlogged');
    }

    function index(Request $filtros){
        //return $filtros;
        $year = isset($filtros->year) ? $filtros->year : date('Y');
        


        $saldo=array();
        /**
         * Datos de los pagos 
         */
        $pago=DB::table('pagos')
        ->whereraw("id_planta = '".GetIdPlanta()."' and status = 2 and  year(created_at) = '".$year."'")
        ->select(DB::raw('sum(monto) as montot'))
        ->first();

        

        /**
         * Aqui se calcula mas iva por que no tiene iva contemplado
         */
        $citas=DB::table('citas')
        ->join('obras','obras.id','=','citas.id_obra')
        ->select(DB::raw('sum((citas.cantidad*citas.precio)+(citas.cantidad*citas.precio*(citas.iva/100))) as consumo'))       
        ->whereraw("obras.esalcaldia = 0 and citas.confirmacion = 1 and obras.id_planta = '".GetIdPlanta()."' and year(citas.fechacita) = '".$year."' ")
        ->first();

        $metros=DB::table('citas')
        ->join('obras','obras.id','=','citas.id_obra')
        ->select(DB::raw('sum(citas.cantidad) as consumo'))       
        ->whereraw("obras.esalcaldia = 0 and citas.confirmacion = 1 and obras.id_planta = '".GetIdPlanta()."' and year(citas.fechacita) = '".$year."' ")
        ->first();

        /**
         * Aqui solo se calcula la suma de la columna total, porque ya viene el iva
         */
        $pedidos = DB::table('pedidos')  
        ->whereraw("id_planta = '".GetIdPlanta()."' and confirmacion = 2 and  year(created_at) = '".$year."'")
        ->select( DB::raw('SUM((total)) as monto'))
        ->first();

        $consumo=$citas->consumo+$pedidos->monto;


        $condonado=DB::table('condonaciones')
        ->whereraw("id_planta = '".GetIdPlanta()."' and year(created_at) = '".$year."'")
        ->select(DB::raw('sum(monto) as monto'))
        ->first();

        $saldo['pago']=$pago->montot;
        $saldo['consumo']=$consumo;
        $saldo['metros']=$metros->consumo;
        $saldo['saldo']=$pago->montot-$consumo;
        $saldo['condonado']=$condonado->monto;
        $saldo['total']=($saldo['pago']+$saldo['condonado'])-$saldo['consumo'];


        //$saldo=GetSaldosPlanta(GetIdPlanta());

        

        $year = isset($filtros->year) ? $filtros->year : date('Y');

        $pagosmesp = DB::table('pagos')
        ->select(DB::raw('YEAR(pagos.created_at) year'),DB::raw(' MONTH(pagos.created_at) month'), DB::raw('SUM(pagos.monto) as monto'))
        ->where('id_planta',Auth::guard('directores')->user()->id_planta)
        ->where('status',2)
        ->whereraw('YEAR(pagos.created_at) = \''.$year.'\'')
        ->whereraw('DATE(pagos.created_at) <= \''.date('Y-m-d').'\'')
        ->groupby('year','month')
        ->get();
        
        $citasmesp = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('obras.id_planta',Auth::guard('directores')->user()->id_planta)
        ->where('obras.esalcaldia',0)
        ->whereraw('YEAR(citas.created_at) = \''.$year.'\'')
        ->select(DB::raw('YEAR(citas.created_at) year, MONTH(citas.created_at) month'), 
        DB::raw('sum((citas.cantidad*citas.precio)+(citas.cantidad*citas.precio*(citas.iva/100))) as monto'))
        ->groupby('year','month')
        ->get();

        $pedidosmesp = DB::table('pedidos') 
        ->where('id_planta',Auth::guard('directores')->user()->id_planta) 
        ->where('confirmacion','=',2)
        ->whereraw('YEAR(pedidos.created_at) = \''.$year.'\'')
        ->select(DB::raw('YEAR(pedidos.created_at) year, MONTH(pedidos.created_at) month'),DB::raw('SUM((total)) as monto'))
        ->groupby('year','month')
        ->get();
        //return view('directores.dashboard.frames.graficapagos',['filtros'=>$request,'pagosmesp'=>$pagosmesp,'citasmesp'=>$citasmesp,'pedidosmesp'=>$pedidosmesp]);


        $metrosmesp = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('obras.id_planta',Auth::guard('directores')->user()->id_planta)
        ->where('obras.esalcaldia',0)
        ->whereraw('YEAR(citas.created_at) = \''.$year.'\'')
        ->select(DB::raw('YEAR(citas.created_at) year, MONTH(citas.created_at) month'), 
        DB::raw('sum(citas.cantidad) as metros'))
        ->groupby('year','month')
        ->get();        
        
        
      
       
        return view('directores.pagos.pagos',['saldo'=>$saldo,'filtros'=>$filtros,
        'pagosmesp'=>$pagosmesp,'citasmesp'=>$citasmesp,'pedidosmesp'=>$pedidosmesp,'metrosmesp'=>$metrosmesp]);
    }

    function GraficaPagosDiretor(Request $request){
        /**
         * Datos para las graficas de depositos por mes
         */

        $year = isset($request->year) ? $request->year : date('Y');
        $pagosmesp = DB::table('pagos')
        ->select(DB::raw('YEAR(pagos.created_at) year'),DB::raw(' MONTH(pagos.created_at) month'), DB::raw('SUM(pagos.monto) as monto'))
        ->where('id_planta',Auth::guard('directores')->user()->id_planta)
        ->where('status',2)
        ->whereraw('YEAR(pagos.created_at) = \''.$year.'\'')
        ->whereraw('DATE(pagos.created_at) <= \''.date('Y-m-d').'\'')
        ->groupby('year','month')
        ->get();
        
        $citasmesp = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('obras.id_planta',Auth::guard('directores')->user()->id_planta)
        ->where('obras.esalcaldia',0)
        ->whereraw('YEAR(citas.created_at) = \''.$year.'\'')
        ->select(DB::raw('YEAR(citas.created_at) year, MONTH(citas.created_at) month'), 
        DB::raw('sum((citas.cantidad*citas.precio)+(citas.cantidad*citas.precio*(citas.iva/100))) as monto'))
        ->groupby('year','month')
        ->get();

        $pedidosmesp = DB::table('pedidos') 
        ->where('id_planta',Auth::guard('directores')->user()->id_planta) 
        ->where('confirmacion','=',2)
        ->whereraw('YEAR(pedidos.created_at) = \''.$year.'\'')
        ->select(DB::raw('YEAR(pedidos.created_at) year, MONTH(pedidos.created_at) month'),DB::raw('SUM((total)) as monto'))
        ->groupby('year','month')
        ->get();
        return view('directores.dashboard.frames.graficapagos',['filtros'=>$request,'pagosmesp'=>$pagosmesp,'citasmesp'=>$citasmesp,'pedidosmesp'=>$pedidosmesp]);
    }

    function Pagos(){
        $pagos=DB::table('pagos')
        ->join('clientes','clientes.id','=','pagos.id_cliente')
        ->select(DB::raw('if((select administrador from administradores where id=pagos.id_administrador)=null,(select administrador from administradores where id=pagos.id_administrador),(select vendedor from vendedores where id=pagos.id_administrador)) as administrador'),'clientes.nombres','clientes.apellidos','pagos.id','pagos.monto','pagos.descripcion','pagos.detalle','pagos.created_at',DB::raw('time(pagos.created_at) as hora'),'pagos.status','pagos.referencia')
        ->orderby('created_at','desc')
        ->where('pagos.id_planta','=',Auth::guard('directores')->user()->id_planta)
        ->paginate(10);
        return view('directores.dashboard.frames.pagos',['pagos'=>$pagos]);
    }

    function Citas(Request $filtros){
        $citas = DB::table('citas')
        ->join('obras','obras.id','=','citas.id_obra')
        ->where('obras.id_planta','=',Auth::guard('directores')->user()->id_planta)
        ->where('obras.obra','like','%'.$filtros->obra.'%')
        ->where('obras.esalcaldia',0)
        ->orderBy('citas.fechacita', 'desc')
        ->select('citas.id','citas.obra',DB::raw("'Reciclaje' as tipo"),'citas.fechacita','citas.planta','citas.confirmacion','citas.material as material','citas.matricula')
        ->paginate(10);

        return view('directores.dashboard.frames.citas',['citas'=>$citas]);
    }

    function Saldos(Request $filtros){
        
       
        $clientessaldos = GetSaldosPorCliente($filtros);

        
        return view('directores.dashboard.frames.saldos',['filtros'=>$filtros,'links'=>$clientessaldos['links'],
        'clientegastos'=>$clientessaldos['saldos']]);
    }

    function GraficasCitasDirector(Request $request){
        /**
         * Datos para la grafica de citas
         */
        $year = isset($request->year) ? $request->year : date('Y');
        $citasmes = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('obras.id_planta',Auth::guard('directores')->user()->id_planta)
        ->where('obras.verificado',1)
        ->whereraw('YEAR(citas.created_at) = \''.$year.'\'')
        ->select(DB::raw('YEAR(citas.created_at) year, MONTH(citas.created_at) month'),DB::raw("sum(citas.cantidad) as citas"))
        ->groupby('year','month')
        ->get();

        $citasmesconfi = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('obras.id_planta',Auth::guard('directores')->user()->id_planta)
        ->where('citas.confirmacion',1)
        ->whereraw('YEAR(citas.created_at) = \''.$year.'\'')
        ->select(DB::raw('YEAR(citas.created_at) year, MONTH(citas.created_at) month'),DB::raw("sum(citas.cantidad) as citas"))
        ->groupby('year','month')
        ->get();
        
        $faltasmes = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('obras.id_planta',Auth::guard('directores')->user()->id_planta)
        ->where('citas.confirmacion',2)
        ->whereraw('YEAR(citas.created_at) = \''.$year.'\'')
        ->select(DB::raw('YEAR(citas.created_at) year, MONTH(citas.created_at) month'),DB::raw("sum(citas.cantidad) as citas"))
        ->groupby('year','month')
        ->get();
        return view('directores.dashboard.frames.graficacitas',['filtros'=>$request,'citasmes'=>$citasmes,'citasmesconfi'=>$citasmesconfi,'faltasmes'=>$faltasmes]);
    }

    function GraficasMaterialMesDirector(Request $request){
        /**
         * Datos para la grafica de citas
         */
        $year = isset($request->year) ? $request->year : date('Y');
        $month = isset($request->month) ? $request->month : date('m');

        $materialmes = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('obras.id_planta',Auth::guard('directores')->user()->id_planta)
        ->where('citas.confirmacion',1)
        ->whereraw('YEAR(citas.created_at) = \''.$year.'\'')        
        ->whereraw('MONTH(citas.created_at) = \''.$month.'\'')
        ->select('citas.material',DB::raw("sum(citas.precio*citas.cantidad) as cantidad"))
        ->groupby('citas.material')
        ->get();
        $total=0;
        foreach($materialmes as $material){
            $total+=$material->cantidad;
        }
        
        
        return view('directores.dashboard.frames.materialmensual',['filtros'=>$request,'materialmes'=>$materialmes,'total'=>$total]);
    }
}
