<?php

namespace App\Http\Controllers\Transportista;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        //$this->middleware('administradorlogged');
    }

    public function index()
    {
        $coordenadas=DB::table('transportistas')
        ->join('empresastransporte','empresastransporte.id_transportista','=','transportistas.id')        
        ->join('choferes','choferes.id_empresatransporte','=','empresastransporte.id')
        ->select('choferes.id','choferes.nombres','choferes.apellidos',
        DB::RAW('(select created_at from coordenadas where id_referencia=choferes.id order by created_at desc limit 1) as fecha'))
        ->where('transportistas.id','=',Auth::guard('transportistas')->user()->id)
        ->get();
        return view('transportistas.ubicacion.ubicacion',['coordenadas'=>$coordenadas]);
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

    public function Mapa(){
        $coordenadas=DB::table('transportistas')
        ->join('empresastransporte','empresastransporte.id_transportista','=','transportistas.id')        
        ->join('choferes','choferes.id_empresatransporte','=','empresastransporte.id')
        ->select('choferes.id','choferes.nombres','choferes.apellidos',
        DB::RAW('(select lon from coordenadas where id_referencia=choferes.id order by created_at desc limit 1) as lon'),
        DB::RAW('(select lat from coordenadas where id_referencia=choferes.id order by created_at desc limit 1) as lat'),
        DB::RAW('(select created_at from coordenadas where id_referencia=choferes.id order by created_at desc limit 1) as fecha'))
        ->where('transportistas.id','=',Auth::guard('transportistas')->user()->id)
        ->get();
        return view('transportistas.ubicacion.frames.mapa',['coordenadas'=>$coordenadas]);
    }

    public function Ruta(Request $request){
        
        //return $id.'/'.$dia;
        $coordenadas=DB::table('coordenadas')
        ->select('lat','lon','created_at')
        ->where('id_referencia','=',$request->id)
        ->whereraw("DATE(created_at) = '".$request->dia."' ")
        ->orderby('created_at','asc')
        ->get();
        
        return view('transportistas.ubicacion.frames.ruta',['coordenadas'=>$coordenadas,'id'=>$request->id,'dia'=>$request->dia]);
    }
}
