<?php

namespace App\Http\Controllers\Administracion;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Configuracion;
use App\Models\Administrador;
use App\Models\Planta;
use Redirect;
class ConfiguracionAppController extends Controller
{
    public function __construct(){
        $this->middleware('administradorlogged');
    }

    
    public function index()
    {
        $configuraciones=DB::table('configuraciones')->where('id_planta','=',GetIdPlanta())->first();
        $planta=Planta::find(GetIdPlanta());
        $administrador=Administrador::find(GetId());
        return view('administracion.configuracionesapp.configuraciones',['configuraciones'=>$configuraciones,'administrador'=>$administrador,'planta'=>$planta]);
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
    public function destroy($id)
    {
        //
    }

    public function ConfiguracionRecompensa(Request $request){
        $planta=Planta::find(GetIdPlanta());
        $planta->recompensa=$request->recompensa;
        if($planta->save()){
            return redirect('configuracionapp')->with('success','¡Se guardaron los datos!');
        }else{
            return redirect('configuracionapp')->with('error','¡Error al guardar!');
        }
    }
    
}
