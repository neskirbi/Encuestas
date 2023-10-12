<?php

namespace App\Http\Controllers\Publicidad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class CorreoObraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bannercorreo=Banner::where('tipo',4)->orderby('created_at' , 'desc')->first();
        return view('publicidad.correoobra.correoobra',['bannercorreo'=>$bannercorreo]);
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


    function CargarObraCorreo(Request $request){
        

        $banner=new Banner();
        $id=GetUuid();

        

        $banner->id=$id;
        $banner->tipo=4;
        $banner->tiponombre='obras';
        $banner->nombre='';
        $banner->enlace='';
        $banner->mail=$request->mail;
        $banner->save();
        

        return redirect('CorreoObras')->with('success','Se generó el correo.');
    }
}
