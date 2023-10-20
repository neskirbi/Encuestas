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


    function create(Request $request){
        if(!isset($request->id)){            
            return redirect('formularios/create'.'?id='.GetUuid())->with('success','Se creo nueva encuesta.');
        }        

        $encuesta=Encuesta::find($request->id);
        $preguntas=Pregunta::where('id_encuesta',$request->id)->orderby('orden','asc')->get();
        return view('uia.encuestas.create',['encuesta'=>$encuesta,'preguntas'=>$preguntas,'id'=>$request->id]);
    }

    function store(Request $request){
        if(!Encuesta::find($request->id)){
            $encuesta=new Encuesta();
            $encuesta->id_uia = GetId();
            $encuesta->id=$request->id;
            $encuesta->save();
        }

        if(Pregunta::where('id_encuesta',$request->id)->where('tipo',$request->tipo)->first() && ($request->tipo*1)==5){
            return redirect('formularios/create'.'?id='.$request->id)->with('error','No se pueden agregar mas 1 ubicación.');
        }

       $pregunta=new Pregunta();
       $pregunta->id=GetUuid();
       $pregunta->tipo=$request->tipo;
       $pregunta->id_encuesta=$request->id;
       $pregunta->pregunta=isset($request->pregunta) ? $request->pregunta : '';
       $pregunta->opciones=isset($request->opciones) ? $request->opciones : '';
       $pregunta->orden=$request->orden;
       $pregunta->save();

       return redirect('formularios/create'.'?id='.$request->id)->with('success','Se creo nueva encuesta.');
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


    function destroy($id){
        $pregunta=Pregunta::find($id);
        $id_encuesta=$pregunta->id_encuesta;
        $pregunta->delete();



        return redirect('formularios/create'.'?id='.$id_encuesta)->with('error','Pregunta eliminada.');

    }

    function GuardarNombreEncuesta(Request $request,$id){
        if(!Encuesta::find($id)){
            $encuesta=new Encuesta();
            $encuesta->id_uia = GetId(); 
            $encuesta->id=$id;
            $encuesta->save();
        }

        $encuesta=Encuesta::find($id);
        $encuesta->encuesta=$request->encuesta;
        $encuesta->save();
        return redirect('formularios/create'.'?id='.$id)->with('success','Se guardo el nombre.');
    }

    function UpdatePregunta(Request $request,$id){
        $pregunta=Pregunta::find($id);
        $pregunta->orden=$request->orden;
        $pregunta->pregunta=isset($request->texto) ? $request->texto : '';
        $pregunta->opciones=isset($request->opciones) ? $request->opciones : '';
        $pregunta->save();

        return Redirect::back()->with('success', 'Correcto.');
        
    }

    function EliminarEncuesta($id){
        $encuesta=Encuesta::find($id);
        return view('uia.encuestas.destroy',['encuesta'=>$encuesta]);
    }

    function DestroyEncuesta($id){
        $encuesta=Encuesta::find($id);
        
        $encuesta->delete();



        return redirect('formularios')->with('error','Encuesta eliminada.');

    }
}
