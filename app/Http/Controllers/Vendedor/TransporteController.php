<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

use App\Models\Transporte;

class TransporteController extends Controller
{


    
    public function __construct(){
        $this->middleware('vendedorlogged');
    }

    
    function index(){
        $transportes=DB::table('transportes')->where('id_planta',Auth::guard('vendedores')->user()->id_planta)
        ->select('transportes.id','transportes.transporte','transportes.precio','transportes.descripcion',
        DB::raw(" concat('/images/productos/',transportes.id,'0.jpg') as portada"))
        ->get();
        return view('ventas.transportes.transportes',['transportes'=>$transportes]);
    }

    function store(Request $request){
        $transporte=new Transporte();
        $transporte->id=GetUuid();
        $transporte->id_planta=Auth::guard('vendedores')->user()->id_planta;
        
        $transporte->transporte=$request->transporte;
        $transporte->precio=$request->precio;
        $transporte->descripcion=$request->descripcion;
        $transporte->capacidad=$request->capacidad;
        if($transporte->save()){
            return redirect('transporte')->with('success','Datos guardados correctamente.');
        }else{
            return redirect('transporte')->with('error','Error al guardar.');
        }
    }

    function Cargar(){
        return view('ventas.transportes.cargar');
    }

    function show($id){
        $transporte = Transporte::find($id);
        return view('ventas.transportes.editar',['transporte'=>$transporte]);
    }

    function update(Request $request,$id){
        $transporte= Transporte::find($id);
        $transporte->sku=$request->sku;
        $transporte->transporte=$request->transporte;
        $transporte->precio=$request->precio;
        $transporte->descripcion=$request->descripcion;
        $transporte->capacidad=$request->capacidad;
        if($transporte->save()){
            return redirect('transporte/'.$id)->with('success','Datos guardados correctamente.');
        }else{
            return redirect('transporte/'.$id)->with('error','Error al guardar.');
        }
    }

    function destroy($id){
        $transporte=Transporte::find($id);
        if($transporte->delete()){
            return redirect('transporte')->with('success','Transporte Borrado.');
        }else{
            return redirect('transporte')->with('error','Error al borrar el transporte.');
        }
    }
}
