<?php

namespace App\Http\Controllers\Director;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class DashboardController extends Controller
{

    public function __construct(){
        $this->middleware('directorlogged');
    }

    function index(){

        $logueos = DB::select("select id,administrador as usuario,'Administrador' as cargo,(select count(id) from logueos where  id_usuario = adm.id) as veces  from administradores as adm where id_planta in ('0e8332117ef04888838b4037b7e99ee3','e500460066c94495b7de1f0c0a8204d9')
        UNION ALL
        select id,nombre as usuario,'Fianzas' as cargo,(select count(id) from logueos where  id_usuario = fin.id) as veces  from finanzas as fin where id_planta in ('0e8332117ef04888838b4037b7e99ee3','e500460066c94495b7de1f0c0a8204d9')
        UNION ALL
        select id,vendedor as usuario,'Ventas' as cargo,(select count(id) from logueos where  id_usuario = ven.id) as veces from vendedores as ven where id_planta in ('0e8332117ef04888838b4037b7e99ee3','e500460066c94495b7de1f0c0a8204d9')
        UNION ALL
        select id,nombre as usuario,'Recepción' as cargo,(select count(id) from logueos where  id_usuario = re.id) as veces from recepciones as re where id_planta in ('0e8332117ef04888838b4037b7e99ee3','e500460066c94495b7de1f0c0a8204d9')");


        $saldo=GetSaldosPlanta(GetIdPlanta());

        

        /**
         * Datos de las citas para director 
         */


        $citas = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->select(DB::raw("sum(citas.cantidad) as cantidad"))
        ->where('obras.id_planta',Auth::guard('directores')->user()->id_planta)
        ->where('obras.esalcaldia',0)
        ->first();
        $citas=$citas->cantidad*1;

        $pendientes = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->select(DB::raw("sum(citas.cantidad) as cantidad"))
        ->where('obras.id_planta',Auth::guard('directores')->user()->id_planta)
        ->where('citas.confirmacion',0)
        ->first();        
        $pendientes=$pendientes->cantidad*1;

        $confirmadas = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->select(DB::raw("sum(citas.cantidad) as cantidad"))
        ->where('obras.id_planta',Auth::guard('directores')->user()->id_planta)
        ->where('obras.esalcaldia',0)
        ->where('citas.confirmacion',1)
        ->first();        
        $confirmadas=$confirmadas->cantidad*1;

        $faltas = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->select(DB::raw("sum(citas.cantidad) as cantidad"))
        ->where('obras.id_planta',Auth::guard('directores')->user()->id_planta)
        ->where('citas.confirmacion',2)
        ->first();        
        $faltas=$faltas->cantidad*1;

        
        
        /**
         * Datos para la grafica de contratos
         * 
         */
        $obras=DB::table('obras')
        ->select('id','id_planta','contrato')
        ->where('obras.id_planta',Auth::guard('directores')->user()->id_planta)
        ->where('obras.contrato','=',1)
        ->where('obras.esalcaldia',0)
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
        ->where('obras.id_planta',Auth::guard('directores')->user()->id_planta)
        ->where('obras.contrato','=',0)
        ->where('obras.esalcaldia',0)
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

       
        return view('directores.dashboard.dashboard',['saldo'=>$saldo,'citas'=>$citas,
        'pendientes'=>$pendientes,'confirmadas'=>$confirmadas,'faltas'=>$faltas,
        'firmados'=>number_format($firmados,2),'sinfirmar'=>number_format($sinfirmar,2)]);
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
