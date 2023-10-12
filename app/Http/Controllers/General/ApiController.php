<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Obra;
use App\Models\MaterialObra;
use App\Models\Planta;
use App\Models\Entidad;
use App\Models\Municipio;

class ApiController extends Controller
{

    public function PuedeGastar(Request $request){
        
        $obra = Obra::find($request->id_obra);
        $planta = Planta::find($obra->id_planta);
        if($planta->activa==0){
            return json_decode('{"response":"0","msn":"No se puede solicitar citas en '.$planta->planta.' por el momento."}');
        }
        $material=MaterialObra::find($request->id_material);
        $precio=$material->precio-($material->precio*($obra->descuento/100));
        $monto = (($request->cantidad*$precio)+($request->cantidad*$precio*$obra->ivaobra/100));

        $id_obra=$request->id_obra;
        //$monto=$request->monto;
        
        
        if(PuedeGastar($id_obra,$monto)){
            return json_decode('{"response":"1","msn":""}');
        }else{
            return json_decode('{"response":"0","msn":"¡No cuenta con saldo suficiente!"}');
        }
    }

    function MunicipiosApi(Request $request){
        return$municipios=Entidad::join('municipios','municipios.id_entidad','=','entidades.id')
        ->select('municipios.id','municipios.municipio')
        ->where('entidades.entidad',$request->entidad)
        ->orderby('municipios.municipio','asc')
        ->get();
    }
}
