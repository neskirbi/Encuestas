<?php

namespace App\Http\Controllers\Mgeneradores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Microgenerador;
use App\Models\Material;
use Redirect;



class MgeneradoresController extends Controller
{
    
    function index(){
        $materiales=DB::table('materiales')
        ->orderby('categoria','asc')
        ->orderby('materiales.material','asc')
        ->where('materiales.id_planta','=','0e8332117ef04888838b4037b7e99ee3')
        ->get();

        $iva=DB::table('configuraciones')
        ->where('id_planta','=','0e8332117ef04888838b4037b7e99ee3')
        ->first();

        $condiciones=DB::table('condicionmateriales')->get();
        return view('mgeneradores.create',['materiales'=>$materiales,'condiciones'=>$condiciones,'iva'=>$iva->iva]);
    }

    function store(Request $request){
        $material= Material::find($request->material);
        
        $iva=DB::table('configuraciones')
        ->where('id_planta','=','0e8332117ef04888838b4037b7e99ee3')
        ->first();

        $microgenerador = new Microgenerador();
        $microgenerador->id = GetUuid();
        $microgenerador->nombre = $request->nombre;
        $microgenerador->telefono = $request->telefono;
        $microgenerador->correo = $request->correo;
        $microgenerador->calle = $request->calle;
        $microgenerador->numeroext = $request->numeroext;
        $microgenerador->numeroint = $request->numeroint;
        $microgenerador->colonia = $request->colonia;
        $microgenerador->municipio = $request->municipio;
        $microgenerador->cp = $request->cp;
        $microgenerador->material = $material->material;
        $microgenerador->precio = 0;
        $microgenerador->cantidad = $request->cantidad;
        $microgenerador->iva = $iva->iva;
        $microgenerador->condicionmaterial = $request->condicionmaterial;
        $microgenerador->fechayhora = $request->fechayhora;
        $subject="Comprobante RCD";
        $title="Comprobante de entrega de residuos";
        $subtitle="Gracias por elegir Reci-track.";
        $body="$microgenerador->nombre<br>$microgenerador->material $microgenerador->cantidad m<sup>3</sup><br> Fecha: ".FechaFormateadaTiempo($request->fechayhora);

        if($microgenerador->save()){
            Notificar($subject,$title,$subtitle,$body,$request->correo,"");
            return redirect('home')->with('success','Se generó la cita correctamente.');
        }else{
            return Redirect::back()->with('error','Error al generar la cita.');
        }
    }

    
}
