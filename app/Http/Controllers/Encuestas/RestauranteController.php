<?php

namespace App\Http\Controllers\Encuestas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurante;
use Illuminate\Support\Facades\DB;
use App\Models\Entidad;
use Redirect;

class RestauranteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurantes=Restaurante::orderby('created_at','desc')->paginate(15);
        return view('encuestas.restaurantes.restaurantes',['restaurantes'=>$restaurantes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entidades=Entidad::All();
        return view('encuestas.restaurantes.create',['entidades'=>$entidades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $restaurante=new Restaurante();

        $restaurante->id=Getuuid();

        $restaurante->json=json_encode($request->all());
        

        if($restaurante->save()){
            
            return redirect('restaurantes')->with('success','Encuesta guardada.');
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
        $restaurantestr=Restaurante::find($id);
        $restaurante=json_decode($restaurantestr->json);
        $entidades=Entidad::All();
        return view('encuestas.restaurantes.show',['restaurante'=>$restaurante,'entidades'=>$entidades,'id'=>$restaurantestr->id]);
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

        $restaurante=Restaurante::find($id);

        $restaurante->json=json_encode($request->all());
        

        if($restaurante->save()){
            
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


    function reporterestaurantes(){
        $restaurantes = DB::table('restaurantes')->get();

        /*
        $total=DB::table('materialesobra')
        ->select(DB::raw("(select sum(cantidad*precio)+(sum(cantidad*precio)*(".$obra->ivaobra."/100)) from materialesobra where id_obra='".$id."') as total"))->first();
        $total=$total->total-($total->total*($obra->descuento/100));
        */
        return view('formatos.reportes.administradores.restaurantes',['restaurantes'=>$restaurantes]);
    }
}
