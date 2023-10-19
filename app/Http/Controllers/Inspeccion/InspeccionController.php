<?php

namespace App\Http\Controllers\Inspeccion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Inspeccion;
use App\Models\Obra;
use App\Models\Encuesta;
use App\Models\Pregunta;
use App\Models\Respuesta;
use App\Models\AdInspeccion;

class InspeccionController extends Controller
{

    
    public function __construct(){
        //$this->middleware('uiaslogged');
    }
    
    function index(Request $filtros){
        
        $encuestas=Encuesta::where("id_uia",Auth::guard('inspectores')->user()->id_uia)->orderby('encuesta','asc')->get();
        
        $inspecciones=Inspeccion::select('id','created_at',
        DB::RAW("(select encuesta from encuestas where id = inspecciones.id_encuesta) as encuesta"))
        ->where('id_inspector',GetId())
        ->orderby('created_at','asc')->paginate(15);

        
        return view('inspecciones.inspecciones.inspecciones',['encuestas'=>$encuestas,'inspecciones'=>$inspecciones,'filtros'=>$filtros]);
    }


    function Informe($id){
        /*$obra=Obra::select('obras.id','obras.obra','obras.calle','obras.numeroext','obras.fechainicio','obras.fechafin',
        'obras.numeroint', 'obras.colonia', 'obras.cp', 'obras.municipio', 'obras.entidad',
        db::raw("(select razonsocial from generadores  where id = obras.id_generador) as razonsocial"),
        db::raw("(select concat(nombresrepre,' ',apellidosrepre,' ',nombresfisica,' ',apellidosfisica ) from generadores  where id = obras.id_generador) as repre"))
        ->where('obras.id',$id)
        ->first();*/

        $encuesta=Encuesta::find($id);
        
        $preguntas=Pregunta::where('id_encuesta',$id)->orderby('orden','asc')->get();
        return view('inspecciones.inspecciones.create',['encuesta'=>$encuesta,'preguntas'=>$preguntas,'id_encuesta'=>$id]);
    }


    function GuardarInforme(Request $request){

        
        $id_inspeccion=GetUuid();
        //Primero se crea la inspeccion y despues las respuestas 
        $inspeccion=new Inspeccion();
        
        
        $inspeccion->id=$id_inspeccion;
        $inspeccion->id_inspector=GetId();
        $inspeccion->id_encuesta=$request->id_encuesta;
        
       

        $inspeccion->save();

        
        $preguntas=explode(",",$request->preguntas);
        


        for($i=0;$i<count($preguntas);$i++){
            $respuesta=new Respuesta();

            $respuesta->id=GetUuid();
            $respuesta->id_inspeccion=$id_inspeccion;
            $respuesta->id_pregunta=$preguntas[$i];
            $respuesta->respuesta=$request->pregunta[$i];
            $respuesta->save();
            

            
        }



        if(isset($request->fotos) && $request->fotos!=''){
            $fotos=explode(",",$request->fotos);
            for($i=0;$i<count($fotos);$i++){

                $nomfoto=GetUuid();
                
                if(!GuardarArchivos($request->foto[$i],'/images/inspecciones/evidencia',$nomfoto.'.jpg')){
                    return Redirect::back()->with('error', 'Error al guardar fotos, comuniquese con soporte.');
                }

                

                $respuesta=new Respuesta();

                $respuesta->id=GetUuid();
                $respuesta->id_inspeccion=$id_inspeccion;
                $respuesta->id_pregunta=$fotos[$i];
                $respuesta->respuesta=$nomfoto;
                $respuesta->save();
                

                
            }
        }
        

        return redirect('encuestas')->with('success', 'Se Generó el reporte.');

       


       
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

        return view('inspecciones.inspecciones.show',['inspeccion'=>$inspeccion,'encuesta'=>$encuesta,'preguntas'=>$preguntas,'respuestas'=>$respuestas,'id_inspeccion'=>$id]);
    }

    function GetRespuesta($id_pregunta,$id_inspeccion){
        //return $id_inspeccion.'        '.$id_pregunta;
        $respuesta = Respuesta::where('id_pregunta',$id_pregunta)->where('id_inspeccion',$id_inspeccion)->first();
        if(!$respuesta){
            return '' ;
        }
        return $respuesta->respuesta;

    }


    function AdjuntarArchivos(Request $request){
        //return $request->archivo->getClientOriginalExtension();

        $adjuntar=new AdInspeccion();
        $adjuntar->id=GetUuid();
        $adjuntar->id_inspeccion=$request->id;
        $adjuntar->archivo=$adjuntar->id.'.'.$request->archivo->getClientOriginalExtension();
        $adjuntar->save();

        if(!GuardarArchivos($request->archivo,'/documentos/inspecciones/adjuntos',$adjuntar->id.'.'.$request->archivo->getClientOriginalExtension())){
            return Redirect::back()->with('error', 'Error al guardar el archivo, comuníquese con soporte.');
        }
        
        return redirect('encuestas')->with('success', 'Se cargo el archivo.');

    }
}
