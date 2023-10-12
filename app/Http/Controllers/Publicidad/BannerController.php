<?php

namespace App\Http\Controllers\Publicidad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{


    public function __construct(){
        $this->middleware('publicidadeslogged');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bannercitas=Banner::where('tipo',1)->orderby('created_at' , 'desc')->first();
        $bannercorreo=Banner::where('tipo',2)->orderby('created_at' , 'desc')->first();
        return view('publicidad.banners.banners',['bannercitas'=>$bannercitas,'bannercorreo'=>$bannercorreo]);
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


    function CargarBCitas(Request $request){
        
        $banner=new Banner();
        $id=GetUuid();
        $nombre=$id.'.'.$request->bannercitas->getClientOriginalExtension();

        $banner->id=$id;
        $banner->tipo=1;
        $banner->tiponombre='citas';
        $banner->nombre=$nombre;
        $banner->enlace=$request->enlace;
        $banner->save();
        
        GuardarArchivos($request->bannercitas,'/images/banners/citas',$nombre);

        return redirect('banners')->with('success','Se cargo el banner de citas.');
    }

    
}
