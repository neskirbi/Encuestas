<?php

namespace App\Http\Controllers\Dosificadores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;
use App\Models\Vehiculo;
use App\Models\Transportista;

use App\Models\TipoVehiculo;

class VehiculoController extends Controller
{
    function index(Request $request){ 

        if($request->razonsocial!='' || $request->matricula!=''){
            $paginacion=10000;
        }
        $vehiculos=DB::table('vehiculos')
        ->where('id_planta','=',GetIdPlanta())        
        ->where('vehiculos.matricula','like','%'.$request->matricula.'%')
        ->orderby('vehiculos.created_at','desc')
        ->paginate(15);
        
        return view('dosificadores.vehiculos.vehiculos',['vehiculos'=>$vehiculos,'filtros'=>$request]);
    }

    function create(){
        
        $tiposvehiculo=TipoVehiculo::all();
        return view('dosificadores.vehiculos.create',['tiposvehiculo'=>$tiposvehiculo]);
    }

    function store(Request $request){  
        $vehiculo=Vehiculo::where('matricula',$request->matricula)
        ->first();

        if($vehiculo){            
            return Redirect::back()->with('error', 'Esta matricula ya fue dada de alta.');
        }
        
        

        $vehiculo=new Vehiculo();
        $vehiculo->id = GetUuid();
        $vehiculo->id_empresatransporte = '';     
        
        $vehiculo->id_planta = GetIdPlanta();       
        $vehiculo->tipo = $request->tipovehiculo;
        $vehiculo->vehiculo = $request->vehiculo;
        $vehiculo->marca = $request->marca;
        $vehiculo->modelo = $request->modelo;
        $vehiculo->matricula=$request->matricula;
        $vehiculo->combustible = $request->combustible;
    
        $vehiculo->detalle = $request->detalle;
        
      

        if($vehiculo->save()){
            return redirect('vehiculosd')->with('success','Vehículo registrado correctamente.');
        }else{
            return redirect('vehiculosd/create')->with('error','Error al guardar.');
        }
        
        
    }

    function show($id){
        $vehiculo=Vehiculo::find($id);
        $tiposvehiculo=TipoVehiculo::all();
        $tipovehiculo=TipoVehiculo::where('id_tipo',$vehiculo->tipo)->first();
        return view('dosificadores.vehiculos.editar',['vehiculo'=>$vehiculo,'tiposvehiculo'=>$tiposvehiculo,'tipovehiculo'=>$tipovehiculo]);
        

    }
    
    function update(Request $request,$id){
        if(isset($request->matricula)){
            $buscar=Vehiculo::where('matricula',$request->matricula)
            ->first();
    
            if($buscar){            
                return Redirect::back()->with('error', 'Esta matricula ya fue dada de alta.');
            }
        }

        $vehiculo= Vehiculo::find($id);
        
        $vehiculo->vehiculo=$request->vehiculo;
        $vehiculo->marca=$request->marca;
        $vehiculo->modelo=$request->modelo;        
        $vehiculo->matricula = isset($request->matricula) ? $request->matricula : $vehiculo->matricula;
        $vehiculo->combustible=$request->combustible;        
        $vehiculo->detalle=$request->detalle;        
        $vehiculo->tipo=$request->tipovehiculo;        
       
       

        if($vehiculo->save()){
            return redirect('vehiculosd/'.$id)->with('success','Registro de vehículo exitoso');
        }else{
            return redirect('vehiculosd/'.$id)->with('error','Error al guardar la vehículo');
        }
    }
}
