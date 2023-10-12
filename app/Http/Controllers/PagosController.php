<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Pago;
use App\Models\Cliente;
use App\Models\Obra;
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



    function PagoCliente(Request $request){
        if(is_null($request->pmonto)){
            return Redirect::back()->with('error', 'El campo monto no puede ser nulo.');
        }
        if(is_null($request->pobra)){
            return Redirect::back()->with('error', 'El campo Obra no puede ser nulo.');
        }
        if(is_null($request->pnombre)){
            return Redirect::back()->with('error', 'El campo Nombre no puede ser nulo.');
        }
        if(is_null($request->pdireccion)){
            return Redirect::back()->with('error', 'El campo Dirección no puede ser nulo.');
        }
        if(is_null($request->pcp)){
            return Redirect::back()->with('error', 'El campo CP no puede ser nulo.');
        }
        if(is_null($request->pmunicipio)){
            return Redirect::back()->with('error', 'El campo Municipio no puede ser nulo.');
        }
        if(is_null($request->pentidad)){
            return Redirect::back()->with('error', 'El campo Entidad no puede ser nulo.');
        }
        $request->pmonto = str_replace(",","",$request->pmonto); 


        $obra=Obra::find($request->pobra);

       

        
        $pago=new Pago();
        $id = $pago->id = GetUuid();
        $pago->id_cliente = Auth::guard('clientes')->user()->id;        
        $pago->id_obra = $request->pobra;
        $pago->id_planta = $obra->id_planta;
        $pago->id_pedido = $request->pid == null ? '' : $request->pid;
        $pago->monto = $request->pmonto;
        $pago->nombre = $request->pnombre;
        $pago->direccion = $request->pdireccion;
        $pago->cp = $request->pcp;
        $pago->municipio = $request->pmunicipio;
        $pago->entidad = $request->pentidad;
        $pago->descripcion = 'Transferencia';

        
        $pago->referencia= $request->pid==null ? GetReferencia($obra->id_planta) : CambiaStatusPedido($request->pid,3);
        if($pago->save()){
            //Notificar('¡Se ha registrado un nuevo pago!','Nuevo Pago Registrado.','Por favor verificar el estatus del pago para la validación.','',['ventas@csmx.mx'],'<a href="https://reci-track.mx/" class="btn btn-default  btn-outline-secondary">Ir a Recitrack</a>');
            return Redirect::back()->with('success', 'Se generó el pago.')->with('transferencia', $id);
        }else{
            return Redirect::back()->with('error', 'Error al generar el pago.');
        }

       

    }
}
