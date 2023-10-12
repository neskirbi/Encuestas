<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Pago;
use App\Models\Cliente;
use Redirect;

class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pago=DB::table('pagos')
        ->where('status','=',2)
        ->select(DB::raw('sum(monto) as montot'))
        ->first();

        $pagos_fecha=DB::table('pagos')
        ->where('status','=',2)
        ->select(DB::raw('date(created_at) as created_at'),DB::raw('sum(monto) as montot'))
        ->groupby('created_at')
        ->get();

        $citas=DB::table('citas')
        ->join('materialesobra','materialesobra.id','=','citas.id_materialobra')
        ->select(DB::raw('sum(citas.cantidad*materialesobra.precio) as consumo'))
        ->where('citas.confirmacion',1)
        ->first();
        $consumo=$citas->consumo;

        

        $pagos=DB::table('pagos')
        ->join('clientes','clientes.id','=','pagos.id_cliente')
        ->select('clientes.nombres','clientes.apellidos','pagos.id','pagos.monto','pagos.descripcion','pagos.detalle','pagos.created_at',DB::raw('time(pagos.created_at) as hora'),'pagos.status','pagos.referencia')
        ->orderby('created_at','desc')
        ->paginate(10);
        return view('administracion.pagos.pagos',['pago'=>$pago,'pagos'=>$pagos,'consumo'=>$consumo,'pagos_fecha'=>$pagos_fecha]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = Cliente::find($request->cliente);
        if(!$cliente){
            return Redirect::back()->with('error', 'Cliente no encontrado.');
        }

        $pago=new Pago();
        $pago->id=GetUuid();
        $pago->id_cliente=$cliente->id;
        $pago->monto=$request->monto;
        $pago->descripcion = $request->descripcion;
        $pago->referencia= $request->referencia==null ? '' : $request->referencia;
        if($pago->save()){
            return Redirect::back()->with('success', 'Pago guardado.');
        }else{
            return Redirect::back()->with('error', 'Error al guardar el pago.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    
}
