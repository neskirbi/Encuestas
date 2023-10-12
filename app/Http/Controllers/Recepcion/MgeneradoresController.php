<?php

namespace App\Http\Controllers\Recepcion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Microgenerador;
use App\Models\Material;
use Redirect;


class MgeneradoresController extends Controller
{
    function index(Request $request){
        $microgeneradores=Microgenerador::orderby('fechayhora','desc')->paginate(10);
        return view('recepcion.microgeneradores.microgeneradores',['microgeneradores'=>$microgeneradores]);
    }

    function show($id){
        
        $microgenerador=Microgenerador::find($id);
        
        $materiales=DB::table('categoriasmaterial')
        ->join('materiales','materiales.id_categoriamaterial','=','categoriasmaterial.id')
        ->orderby('categoriasmaterial.categoriamaterial','asc')
        ->orderby('materiales.material','asc')
        ->where('categoriasmaterial.id_planta','=','0e8332117ef04888838b4037b7e99ee3')
        ->get();

        $iva=DB::table('configuraciones')
        ->where('id_planta','=','0e8332117ef04888838b4037b7e99ee3')
        ->first();
        
        $condiciones=DB::table('condicionmateriales')->get();

        return view('recepcion.microgeneradores.microgeneradorrev',['microgenerador'=>$microgenerador,'materiales'=>$materiales,'condiciones'=>$condiciones,'iva'=>$iva->iva]);
    }

    function update(Request $request,$id){
        
        $microgenerador = Microgenerador::find($id);
        $microgenerador->nombre = $request->nombre;
        $microgenerador->telefono = $request->telefono;
        $microgenerador->correo = $request->correo;
        $microgenerador->calle = $request->calle;
        $microgenerador->numeroext = $request->numeroext;
        $microgenerador->numeroint = $request->numeroint;
        $microgenerador->colonia = $request->colonia;
        $microgenerador->municipio = $request->municipio;
        $microgenerador->cp = $request->cp;
        if($request->material!=null){
            $material= Material::find($request->material);
            $microgenerador->material = $material->material;
        }
        $microgenerador->precio = $request->precio;
        $microgenerador->cantidad = $request->cantidad;
        if($request->condicionmaterial!=null)
            $microgenerador->condicionmaterial = $request->condicionmaterial;
        $microgenerador->fechayhora = $request->fechayhora;

        if($microgenerador->save()){
            return Redirect::back()->with('success','Se generó la cita correctamente.');
        }else{
            return Redirect::back()->with('error','Error al generar la cita.');
        }
    }

    
    function ConfirmarMicro($id){
        $microgenerador = Microgenerador::find($id);
        $microgenerador->confirmacion = 2;
        

        if($microgenerador->save()){
            return Redirect::back()->with('success','Se confirma entrega de material.');
        }else{
            return Redirect::back()->with('error','Error al guardar.');
        }
    }

       
}
