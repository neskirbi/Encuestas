<?php

namespace App\Http\Controllers\Uia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use App\Models\Encuesta;
use App\Models\Pregunta;
use App\Models\Obra;

class FormularioController extends Controller
{

    
    public function __construct(){
        $this->middleware('uiaslogged');
    }

    
    function index(){
        $encuestas=Encuesta::where('id_uia',GetId())->paginate(15);


        return view('uia.formularios.formularios',['encuestas'=>$encuestas]);
    }


    function create(Request $request){
        if(!isset($request->id)){            
            return redirect('formularios/create'.'?id='.GetUuid())->with('success','Se creo nueva encuesta.');
        }        

        $encuesta=Encuesta::find($request->id);
        $preguntas=Pregunta::where('id_encuesta',$request->id)->orderby('orden','asc')->get();
        return view('uia.formularios.create',['encuesta'=>$encuesta,'preguntas'=>$preguntas,'id'=>$request->id]);
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
        return view('uia.formularios.destroy',['encuesta'=>$encuesta]);
    }

    function DestroyEncuesta($id){
        $encuesta=Encuesta::find($id);
        
        $encuesta->delete();



        return redirect('formularios')->with('error','Encuesta eliminada.');

    }
}
