<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Vehiculo;
use App\Models\Chofer;
use Redirect;

class VehiculosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehiculos = DB::table('clientes')
        ->join('vehiculos', 'vehiculos.id_cliente', '=', 'clientes.id')
        ->where('clientes.id',Auth::guard('clientes')->user()->id)
        ->where('vehiculos.borrado',1)
        ->select('vehiculos.id','vehiculos.vehiculo','vehiculos.marca','vehiculos.modelo','vehiculos.matricula','vehiculos.borrado')
        ->get();

       
        return view('cliente.vehiculos.vehiculos',['vehiculos'=>$vehiculos]);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::guard('clientes')->check()) {
            return Redirect::back()->with('error', 'Error de sesión.');
        }

        
        
        $vehiculo=vehiculo::find($id);
        $vehiculo->borrado = 0;
        if($vehiculo->save()){
            return Redirect::back()->with('success', 'vehículo eliminado.');
        }

        return Redirect::back()->with('error', 'Error al eliminar.');
    }

    
}
