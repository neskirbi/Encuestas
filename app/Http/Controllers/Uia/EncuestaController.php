<?php

namespace App\Http\Controllers\Uia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use App\Models\Encuesta;
use App\Models\Inspeccion;
use App\Models\Pregunta;
use App\Models\Respuesta;
use App\Models\Obra;

class EncuestaController extends Controller
{

    
    public function __construct(){
        $this->middleware('uiaslogged');
    }

    
    function index(){
        

        $inspecciones=Encuesta::select('inspecciones.id','inspecciones.created_at','encuestas.encuesta')
        ->join('inspecciones', 'inspecciones.id_encuesta','=','encuestas.id')
        ->where('id_uia',GetId())
        ->orderby('created_at','asc')
        ->paginate(15);


        return view('uia.encuestas.encuestas',['inspecciones'=>$inspecciones]);
    }



    


    function show($id){
        //return $id;
        $inspeccion=Inspeccion::find($id);
        $encuesta=Encuesta::find($inspeccion->id_encuesta);
        $preguntas=Pregunta::where('id_encuesta',$inspeccion->id_encuesta)->orderby('orden','asc')->get();
        $respuestas=array();
        for($i=0;$i<count($preguntas);$i++){
            $respuestas[$preguntas[$i]->id]=$this->GetRespuesta($preguntas[$i]->id,$id);
        }

        return view('uia.encuestas.show',['inspeccion'=>$inspeccion,'encuesta'=>$encuesta,'preguntas'=>$preguntas,'respuestas'=>$respuestas,'id_inspeccion'=>$id]);
    }


    function GetRespuesta($id_pregunta,$id_inspeccion){
        //return $id_inspeccion.'        '.$id_pregunta;
        $respuesta = Respuesta::where('id_pregunta',$id_pregunta)->where('id_inspeccion',$id_inspeccion)->first();
        if(!$respuesta){
            return '' ;
        }
        return $respuesta->respuesta;

    }


    

    function EliminarEncuesta($id){
        $inspeccion=Inspeccion::find($id);
        return view('uia.encuestas.destroy',['inspeccion'=>$inspeccion]);
    }

    function DestroyEncuesta($id){
        $inspeccion=Inspeccion::find($id);
        
        $inspeccion->delete();



        return redirect('encuestasadm')->with('error','Encuesta eliminada.');

    }
}
