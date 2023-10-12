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
class ConfiguracionController extends Controller
{
    
    public function __construct(){
        $this->middleware('administradorlogged');
    }

    
    public function index()
    {
        $configuraciones=DB::table('configuraciones')->where('id_planta','=',GetIdPlanta())->first();
        $planta=Planta::find(GetIdPlanta());
        $administrador=Administrador::find(GetId());
        return view('administracion.configuraciones.configuraciones',['configuraciones'=>$configuraciones,'administrador'=>$administrador,'planta'=>$planta]);
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

    public function ConfiguracionBanco(Request $request){
        $configuracion=Configuracion::where('id_planta','=',GetIdPlanta())->first();
        $configuracion->razonsocial=$request->razonsocial;
        $configuracion->referencia=$request->referencia;
        $configuracion->banco=$request->banco;
        $configuracion->cuenta=$request->cuenta;
        $configuracion->clabe=$request->clabe;
        $configuracion->iva=$request->iva;
        if($configuracion->save()){
            return redirect('configuracion'.($request->pestania!=null ? '?pestania='.$request->pestania : '' ))->with('success','¡Se guardaron los datos!');
        }else{
            return redirect('configuracion'.($request->pestania!=null ? '?pestania='.$request->pestania : '' ))->with('error','¡Error al guardar!');
        }
    }
    public function ConfiguracionBoleta(Request $request){
        $configuracion=Configuracion::where('id_planta','=',GetIdPlanta())->first();
        $configuracion->folio=$request->folio;
        if($configuracion->save()){
            return redirect('configuracion'.($request->pestania!=null ? '?pestania='.$request->pestania : '' ))->with('success','¡Se guardaron los datos!');
        }else{
            return redirect('configuracion'.($request->pestania!=null ? '?pestania='.$request->pestania : '' ))->with('error','¡Error al guardar!');
        }
    }

    function ConfiguracionCuenta(Request $request){
        $administrador=Administrador::where('mail',$request->mail)->first();

        if($administrador && $request->mail!=GetMail()){
            return redirect('configuracion'.($request->pestania!=null ? '?pestania='.$request->pestania : '' ))->with('error','Error, el correo ya esta en uso.');
        }

        $administrador=Administrador::find(GetId());
        $administrador->administrador=$request->administrador;
        $administrador->cargo=$request->cargo;
        $administrador->firma=$request->firma==null ? '' : $request->firma;
        if($administrador->save()){            
            return redirect('configuracion'.($request->pestania!=null ? '?pestania='.$request->pestania : '' ))->with('succes', 'Datos guardados.');
        }else{
            return redirect('configuracion'.($request->pestania!=null ? '?pestania='.$request->pestania : '' ))->with('error', 'Error al guardar.');
        }
    }

    function CambioPass(Request $request,$id){
        if($request->pass!=$request->pass){            
            return redirect('configuracion'.($request->pestania!=null ? '?pestania='.$request->pestania : '' ))->with('error', 'Error, las contraseñas no coinciden.');
        }
        $administrador=Administrador::find($id);
        $administrador->pass=password_hash($request->pass,PASSWORD_DEFAULT);
        if($administrador->save()){ 
            return redirect('logout');
            return redirect('configuracion'.($request->pestania!=null ? '?pestania='.$request->pestania : '' ))->with('success', 'Datos guardados.');
        }else{
            return redirect('configuracion'.($request->pestania!=null ? '?pestania='.$request->pestania : '' ))->with('error', 'Error al guardar.');
        }
    }


    function Horarios(Request $request,$id){
        if(''==strtotime($request->domingoi) || count(explode(':',$request->domingoi))!=2){
            return Redirect::back()->with('error', 'Formato de fecha para domingo invalido.');
        }
        if(''==strtotime($request->lunesi) || count(explode(':',$request->lunesi))!=2){
            return Redirect::back()->with('error', 'Formato de fecha para lunes invalido.');
        }
        if(''==strtotime($request->martesi) || count(explode(':',$request->martesi))!=2){
            return Redirect::back()->with('error', 'Formato de fecha para martes invalido.');
        }
        if(''==strtotime($request->miercolesi) || count(explode(':',$request->miercolesi))!=2){
            return Redirect::back()->with('error', 'Formato de fecha para miercoles invalido.');
        }
        if(''==strtotime($request->juevesi) || count(explode(':',$request->juevesi))!=2){
            return Redirect::back()->with('error', 'Formato de fecha para jueves invalido.');
        }
        if(''==strtotime($request->viernesi) || count(explode(':',$request->viernesi))!=2){
            return Redirect::back()->with('error', 'Formato de fecha para viernes invalido.');
        }
        if(''==strtotime($request->sabadoi) || count(explode(':',$request->sabadoi))!=2){
            return Redirect::back()->with('error', 'Formato de fecha para sabado invalido.');
        }
        if(''==strtotime($request->domingof) || count(explode(':',$request->domingof))!=2){
            return Redirect::back()->with('error', 'Formato de fecha para domingo invalido.');
        }
        if(''==strtotime($request->lunesf) || count(explode(':',$request->lunesf))!=2){
            return Redirect::back()->with('error', 'Formato de fecha para lunes invalido.');
        }
        if(''==strtotime($request->martesf) || count(explode(':',$request->martesf))!=2){
            return Redirect::back()->with('error', 'Formato de fecha para martes invalido.');
        }
        if(''==strtotime($request->miercolesf) || count(explode(':',$request->miercolesf))!=2){
            return Redirect::back()->with('error', 'Formato de fecha para miercoles invalido.');
        }
        if(''==strtotime($request->juevesf) || count(explode(':',$request->juevesf))!=2){
            return Redirect::back()->with('error', 'Formato de fecha para jueves invalido.');
        }
        if(''==strtotime($request->viernesf) || count(explode(':',$request->viernesf))!=2){
            return Redirect::back()->with('error', 'Formato de fecha para viernes invalido.');
        }
        if(''==strtotime($request->sabadof) || count(explode(':',$request->sabadof))!=2){
            return Redirect::back()->with('error', 'Formato de fecha para sabado invalido.');
        }

        $planta=Planta::find($id);
        $planta->intervalo= $request->intervalo;
        $planta->domingoi= $request->domingoi;
        $planta->lunesi= $request->lunesi;
        $planta->martesi= $request->martesi;
        $planta->miercolesi= $request->miercolesi;
        $planta->juevesi= $request->juevesi;
        $planta->viernesi= $request->viernesi;
        $planta->sabadoi= $request->sabadoi;
        $planta->domingof= $request->domingof;
        $planta->lunesf= $request->lunesf;
        $planta->martesf= $request->martesf;
        $planta->miercolesf= $request->miercolesf;
        $planta->juevesf= $request->juevesf;
        $planta->viernesf= $request->viernesf;
        $planta->sabadof= $request->sabadof;

        if($planta->save()){ 
            return redirect('configuracion'.($request->pestania!=null ? '?pestania='.$request->pestania : '' ))->with('success', 'Datos guardados.');
        }else{
            return redirect('configuracion'.($request->pestania!=null ? '?pestania='.$request->pestania : '' ))->with('error', 'Error al guardar.');
        }
    }


    function ConfiguracionValidacion(Request $request,$id){
        $planta=Planta::find($id);
        $planta->restriccion= $request->restriccion=='on' ? 1 : 0;
        $planta->tiempo=$request->tiempo;
        if($planta->save()){ 
            return redirect('configuracion'.($request->pestania!=null ? '?pestania='.$request->pestania : '' ))->with('success', 'Datos guardados.');
        }else{
            return redirect('configuracion'.($request->pestania!=null ? '?pestania='.$request->pestania : '' ))->with('error', 'Error al guardar.');
        }

    }


    function ConfiguracionCorreo(Request $request,$id){
        $planta=Planta::find($id);
        $planta->correosrc= $request->correosrc;
        $planta->correosobra= $request->correosobra;
        if($planta->save()){ 
            return redirect('configuracion'.($request->pestania!=null ? '?pestania='.$request->pestania : '' ))->with('success', 'Datos guardados.');
        }else{
            return redirect('configuracion'.($request->pestania!=null ? '?pestania='.$request->pestania : '' ))->with('error', 'Error al guardar.');
        }

    }
}
