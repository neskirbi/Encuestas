<?php

namespace App\Http\Controllers\Soporte;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Municipio;

class ApiController extends Controller
{
function GuardarMunicipio(Request $request){
    $json=array('success'=>true,'message'=>"");
    
    if(!isset($request->id)){
        $municipio=new Municipio();
        $municipio->id=GetUuid();
        $municipio->id_entidad=$request->entidad;    
        $municipio->municipio=$request->municipio;
        $municipio->lat=$request->lat;
        $municipio->lon=$request->lon;
        $municipio->save();
        $json['success']=true;
        $json['message']=$municipio->id;
        return $json;
    }else{
        $municipio= Municipio::find($request->id);
        $municipio->id_entidad=$request->entidad;    
        $municipio->municipio=$request->municipio;
        $municipio->lat=$request->lat;
        $municipio->lon=$request->lon;
        $municipio->save();
        $json['success']=true;
        return $json;
    }
    
    
}
}
