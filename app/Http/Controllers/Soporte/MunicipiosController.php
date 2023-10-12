<?php

namespace App\Http\Controllers\Soporte;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Entidad;
use App\Models\Municipio;


class MunicipiosController extends Controller
{
    function show($id){
        $municipios=Municipio::join('entidades','entidades.id','=','municipios.id_entidad')
        ->select('municipios.id_entidad',DB::raw("(Select entidad from entidades where id = municipios.id_entidad) as entidad "),'entidades.entidad','municipios.id','municipios.municipio','municipios.lat','municipios.lon')
        ->orderby('entidad','asc')
        ->orderby('municipio','asc')
        ->where('entidades.id',$id)
        ->get();

        
        $opciones='';
        $entidades=Entidad::orderby('entidad','asc')->get();
        foreach($entidades as $entidad){
            $opciones.='<option value="'.$entidad->id.'">'.$entidad->entidad.'</option>';
        }
        $entidad=Entidad::where('id','=',$id)->first();
        return view('soporte.municipios.municipios',['municipios'=>$municipios,'opciones'=>$opciones,'entidad'=>$entidad]);
    }

 
}
