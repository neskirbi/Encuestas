<?php

namespace App\Http\Controllers\Soporte;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;
use App\Models\Vehiculo;
use App\Models\EmpresaTransporte;

class VehiculoController extends Controller
{
    function index(Request $request){ 
        $paginacion=15;
        if($request->razonsocial!='' || $request->matricula!=''){
            $paginacion=10000;
        }
        $vehiculos=DB::table('transportistas')
        ->join('empresastransporte','empresastransporte.id_transportista','=','transportistas.id')
        ->join('vehiculos','vehiculos.id_empresatransporte','=','empresastransporte.id')     
        ->where('empresastransporte.razonsocial','like','%'.$request->razonsocial.'%')
        ->where('vehiculos.matricula','like','%'.$request->matricula.'%')
        ->orderby('empresastransporte.razonsocial','asc')
        ->orderby('vehiculos.created_at','desc')
        ->paginate($paginacion);
        
        return view('soporte.vehiculos.vehiculos',['vehiculos'=>$vehiculos,'filtros'=>$request]);
    }

    function create(){
        
        $empresastransporte = DB::table('empresastransporte')
        ->orderby('razonsocial')
        ->get(); 
        return view('soporte.vehiculos.create',['empresastransporte'=>$empresastransporte]);
    }

    function store(Request $request){  
        $buscar=Vehiculo::where('matricula',$request->matricula)
        ->first();

        if($buscar){            
            Redirect::back()->with('error', 'Esta matricula ya fue dada de alta.');
        }
        

        $vehiculo=new Vehiculo();
        $vehiculo->id = GetUuid();
        $vehiculo->id_empresatransporte = $request->empresatransporte;
        $vehiculo->vehiculo = $request->vehiculo;
        $vehiculo->marca = $request->marca;
        $vehiculo->modelo = $request->modelo;
        $vehiculo->matricula = $request->matricula;
        $vehiculo->combustible = $request->combustible;
        
    
        $vehiculo->detalle = $request->detalle;
        
      

        if($vehiculo->save()){
            return redirect('vehiculossoporte')->with('success','Vehículo registrado correctamente.');
        }else{
            return redirect('vehiculossoporte/create')->with('error','Error al guardar.');
        }
        
        
    }

    function show($id){
        $empresas=EmpresaTransporte::orderby('razonsocial','asc')->get();
        $vehiculo=Vehiculo::find($id);
        $empresa=EmpresaTransporte::find($vehiculo->id_empresatransporte);
        return view('soporte.vehiculos.editar',['vehiculo'=>$vehiculo,'empresa'=>$empresa,'empresas'=>$empresas]);
        

    }
    
    function update(Request $request,$id){
        $vehiculo= Vehiculo::find($id);
        
        $matriculaant=$vehiculo->matricula;
        
        $vehiculo->id_empresatransporte=$request->empresatransporte;
        $vehiculo->vehiculo=$request->vehiculo;
        $vehiculo->marca=$request->marca;
        $vehiculo->modelo=$request->modelo;
        $vehiculo->matricula=$request->matricula;
        $vehiculo->combustible=$request->combustible;        
        $vehiculo->detalle=$request->detalle;        
       
       

        if($vehiculo->save()){
            RevisaDatosVehiculo($matriculaant,$request->matricula);
            return redirect('vehiculossoporte/'.$id)->with('success','Registro de vehículo exitoso');
        }else{
            return redirect('vehiculossoporte/'.$id)->with('error','Error al guardar la vehículo');
        }
    }
}
