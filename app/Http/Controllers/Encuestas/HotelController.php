<?php

namespace App\Http\Controllers\Encuestas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Hotel;
use App\Models\Entidad;
use Illuminate\Support\Facades\DB;
use Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteEncuestas;


class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hoteles=Hotel::orderby('created_at','desc')->paginate(15);
        return view('encuestas.hoteles.hoteles',['hoteles'=>$hoteles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $entidades=Entidad::All();
        return view('encuestas.hoteles.create',['entidades'=>$entidades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hoteles=new Hotel();

        $hoteles->id=Getuuid();

        $hoteles->json=json_encode($request->all());
        

        if($hoteles->save()){
            
            return redirect('hoteles')->with('success','Encuesta guardada.');
        }else{           
           
            return Redirect::back()->with('error', 'Error al guardar la información.');
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
        $hotelestr=Hotel::find($id);
        $hoteles=json_decode($hotelestr->json);
        $entidades=Entidad::All();
        return view('encuestas.hoteles.show',['hoteles'=>$hoteles,'entidades'=>$entidades,'id'=>$hotelestr->id]);
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
        $hoteles=Hotel::find($id);

        $hoteles->json=json_encode($request->all());
        

        if($hoteles->save()){
            
            return Redirect::back()->with('success','Encuesta guardada.');
        }else{           
           
            return Redirect::back()->with('error', 'Error al guardar la información.');
        }
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

    function reportehoteles(){
        $hoteles = DB::table('hoteles')->get();

        /*
        $total=DB::table('materialesobra')
        ->select(DB::raw("(select sum(cantidad*precio)+(sum(cantidad*precio)*(".$obra->ivaobra."/100)) from materialesobra where id_obra='".$id."') as total"))->first();
        $total=$total->total-($total->total*($obra->descuento/100));
        */
        return view('formatos.reportes.administradores.hoteles',['hoteles'=>$hoteles]);
    }
}
