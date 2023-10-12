<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Cita;
use App\Models\MaterialObra;
use App\Models\Material;
use App\Models\Cliente;
use App\Models\Planta;
use App\Models\CondicionMaterial;
use App\Models\Configuracion;
use App\Models\Obra;
use App\Models\Administrador;
use Redirect;

class AlertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('vendedorlogged');
    }


    public function CitasPendientesVentas(Request $request)
    {
        $citas_transito_count = DB::table('citas')
        ->where('citas.id_planta','=',GetIdPlanta())
                ->where('citas.confirmacion',3)
                    ->count();

        $citas = DB::table('citas')
        ->join('obras','obras.id','=','citas.id_obra')
        ->join('generadores','generadores.id','=','obras.id_generador')
        ->where('obras.id_planta','=',GetIdPlanta())
        ->where('obras.obra','like','%'.$request->obra.'%')
        ->where('citas.confirmacion',3)
        ->orderBy('citas.fechacita', 'desc')
        ->select('generadores.razonsocial','citas.id','citas.obra','citas.cantidad',
        'citas.precio',DB::raw("'Reciclaje' as tipo"),'citas.fechacita','citas.planta',
        'citas.confirmacion','citas.material as material','citas.matricula')
        ->paginate(10);

        
        return view('ventas.alertas.pendientes',['citas'=>$citas,        
        'citas_transito_count'=>$citas_transito_count,
        'filtros'=>$request]);
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
        //
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
    public function Borrarcitaspendientesventas($id)
    {
        $cita=Cita::find($id);
        $cita->confirmacion=2;
        $cita->save();
        return Redirect::back()->with('error', 'Cita eliminada.');
    }
}
