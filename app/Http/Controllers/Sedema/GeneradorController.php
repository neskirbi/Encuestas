<?php

namespace App\Http\Controllers\Sedema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Models\Generador;
use App\Models\Planta;


class GeneradorController extends Controller
{
    public function index()
    {
        $conections=config('database.connections');
        $merged=array();
        foreach($conections as $conection){
            if(VerificarConexion($conection['name'])){
                continue;
            }
            $generadores = DB::connection($conection['name'])->table('generadores')
            ->select('id','id_cliente','razonsocial','rfc',DB::raw("'".$conection['name']."' as con"))
            ->where('verificado','1')
            ->orderby('created_at','desc')
            ->get();
            if(count($merged)==0){
                $merged=$generadores;
            }else{
                $merged = $merged->merge($generadores);
            }
        }

        $merged = $merged->sortBy('razonsocial');
        $page=0;
        $filas=10;
        if(isset($_GET['page'])){
            $page=$_GET['page'];
        }
        $links = new Paginator($merged, $merged->count(), $filas, $page);
        $links->setPath('');
        $generadores = $merged->forPage( $page, $filas); //Filter the page var
        
        return view('sedema.generadores.generadores',['generadores'=>$generadores,'links'=>$links]);
    }

    public function show($con,$id)
    {
        $generador = DB::table('generadores')->find($id);
        return view('sedema.generadores.generador',['generador'=>$generador]);
    }

    public function Dashboard($con,$id)
    {

        $generadores=DB::table('clientes')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->where('clientes.id','=',$id)
        ->select('generadores.id','razonsocial')->get();
        //return json_encode($cliente);


        

        $pagodetalles = DB::table('clientes')
        ->join('pagos','pagos.id_cliente','=','clientes.id')
        ->where('clientes.id',$id)
        ->select('pagos.id','pagos.monto','pagos.referencia','pagos.status','pagos.descripcion','pagos.created_at','pagos.detalle')
        ->orderby('pagos.created_at','desc')
        ->get();

        $reciclajes = DB::table('clientes')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('obras','obras.id_generador','=','generadores.id')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('clientes.id',$id)        
        ->where('obras.contrato',1)
        ->where('citas.confirmacion','!=',2)
        ->orderBy('fechacita', 'desc')
        ->select('obras.obra',DB::raw("'Reciclaje' as tipo"),'fechacita','planta','citas.confirmacion','material as material','cantidad','unidades','precio','iva')
        ->get();       
        
        
        $obras= DB::table('clientes')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('obras','obras.id_generador','=','generadores.id')
        ->where('clientes.id',$id)        
        ->where('obras.contrato',1)
        ->select('obras.id','obras.obra','obras.superficie','obras.id_planta')
        ->orderby('obras.obra','asc')
        ->get();
        
        
        
        $pago = Pago($id);
        $reciclaje=Reciclaje($id);
        $pedido=Pedidos($id);
        $gasto=$reciclaje+$pedido;
        
        $saldo=$pago-$reciclaje;

        $id_plantas=array();
        foreach($obras as $obra){
            $id_plantas[]=$obra->id_planta;
        }

        $plantas=Planta::wherein('id',$id_plantas)->orderby('planta','asc')->get();

        return view('sedema.generadores.dashboard',['generadores'=>$generadores,'obras'=>$obras,
        'saldo'=>$saldo,
        'pagodetalles'=>$pagodetalles,
        'pago'=>$pago,
        'gasto'=>$gasto,
        'reciclajes'=>$reciclajes,'plantas'=>$plantas,'con'=>$con,'id'=>$id]);
    }


    function GraficasPagosClienteSedema(Request $request,$con,$id){
        
        $year = isset($request->year) ? $request->year : date('Y');
        $pagos = DB::table('clientes')
        ->leftjoin('pagos','pagos.id_cliente','=','clientes.id')
        ->where('clientes.id',$id)
        ->where('pagos.status',2)
        ->whereraw('YEAR(pagos.created_at) = \''.$year.'\'')
        ->select(DB::raw('YEAR(pagos.created_at) year, MONTH(pagos.created_at) month'), DB::raw('SUM(pagos.monto) as monto'))
        ->groupby('year','month')
        ->get();

        $gastos=GastosMesaMes($id,$year);

        $pedidos=PedidosMesaMes($id,$year);

        return view('sedema.generadores.frames.graficapagos',[
        'filtros'=>$request,
        'pagos'=>$pagos,
        'pedidos'=>$pedidos,
        'gastos'=>$gastos,
        'con'=>$con,
        'id'=>$id]);

    }
}
