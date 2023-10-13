<?php

namespace App\Http\Controllers\Uia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use App\Models\Encuesta;
use App\Models\Pregunta;
use App\Models\Obra;

class EncuestaController extends Controller
{

    
    public function __construct(){
        $this->middleware('uiaslogged');
    }

    
    function index(){
        $encuestas=Encuesta::where('id_uia',GetId())->paginate(15);
        return view('uia.encuestas.encuestas',['encuestas'=>$encuestas]);
    }


    function create(Request $request){
        if(!isset($request->id)){            
            return redirect('encuestas/create'.'?id='.GetUuid())->with('success','Se creo nueva encuesta.');
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
       $pregunta=new Pregunta();
       $pregunta->id=GetUuid();
       $pregunta->tipo=$request->tipo;
       $pregunta->id_encuesta=$request->id;
       $pregunta->pregunta=$request->pregunta;
       $pregunta->opciones=isset($request->opciones) ? $request->opciones : '';
       $pregunta->orden=$request->orden;
       $pregunta->save();

       return redirect('encuestas/create'.'?id='.$request->id)->with('success','Se creo nueva encuesta.');
    }


    function destroy($id){
        $pregunta=Pregunta::find($id);
        $id_encuesta=$pregunta->id_encuesta;
        $pregunta->delete();



        return redirect('encuestas/create'.'?id='.$id_encuesta)->with('error','Pregunta eliminada.');

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
        return redirect('encuestas/create'.'?id='.$id)->with('success','Se guardo el nombre.');
    }

    function UpdatePregunta(Request $request,$id){
        $pregunta=Pregunta::find($id);
        $pregunta->orden=$request->orden;
        $pregunta->pregunta=$request->texto;
        $pregunta->opciones=isset($request->opciones) ? $request->opciones : '';
        $pregunta->save();

        return Redirect::back()->with('success', 'Correcto.');
        
    }
}
