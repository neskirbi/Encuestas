<?php

namespace App\Http\Controllers\Android\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coordenada;

class CoordenadaController extends Controller
{
    function Coordenadas(Request $request){
        //return $request->all();
        //$respuesta[]=array("Error"=>"algo");
        $respuesta=array();
        $ubicaciones=PostmanAndroid($request);
        //$ubicaciones=str_replace("\"",'"',json_encode($request->all()));
        //$ubicaciones=json_decode($ubicaciones,1);
        
        
        try {
            //$request=isset($request['request']) ? $request=json_decode($request['request']) : json_decode($request = $request);

            foreach($ubicaciones as $ubicacion){
                $marcador=Coordenada::find($ubicacion['id']);
                if($marcador){
                    continue;
                }
                if($ubicacion['lat'] == null || $ubicacion['lon'] == null)
                {
                    continue;
                }
                $coordenada=new Coordenada();
                $coordenada->id=$ubicacion['id'];
                $coordenada->id_cita=isset($ubicacion['id_cita']) ? $ubicacion['id_cita'] : '';
                $coordenada->id_referencia=isset($ubicacion['id_referencia']) ? $ubicacion['id_referencia'] : '';
                $coordenada->lat=$ubicacion['lat'];
                $coordenada->lon=$ubicacion['lon'];
                $coordenada->created_at=$ubicacion['created_at'];
                $coordenada->updated_at=$ubicacion['updated_at'];
                if($coordenada->save()){
                }
            
                
            }
          
        } catch (Exception $e) {
            $respuesta[]=array("Error"=>$e);
        } 
       
        $respuesta[]=array("Correcto"=>1);
      
        
        return json_encode($respuesta);
    }
}
