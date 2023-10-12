<?php

namespace App\Http\Controllers\Recepcion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transferencia;
use App\Models\Planta;
use App\Models\Material;

class TransferenciaController extends Controller
{
    function index(){
        $enviost=Transferencia::select(db::raw('sum(cantidad_envio) as cantidad'))->where('id_origen',GetIdPlanta())->first();
        $enviost=$enviost->cantidad*1;
        $recepcionest=Transferencia::select(db::raw('sum(cantidad_envio) as cantidad'))->where('id_destino',GetIdPlanta())->first();
        $recepcionest=$recepcionest->cantidad*1;
        $transferencias_confirmadas=0;
        $transferencias_faltas=0;       
        
        $recepciones=Transferencia::select('transferencias.id','transferencias.material','transferencias.cantidad_envio','transferencias.unidades',db::raw("(select planta from plantas where id=transferencias.id_origen) as destino"))
        ->where('id_destino',GetIdPlanta())->paginate(15);
        $transferencias=Transferencia::select('transferencias.id','transferencias.material','transferencias.cantidad_envio','transferencias.unidades',db::raw("(select planta from plantas where id=transferencias.id_destino) as destino"))
        ->where('id_origen',GetIdPlanta())->paginate(15);
        return view('recepcion.transferencias.transferencias',['transferencias'=>$transferencias,
        'recepciones'=>$recepciones,
        'enviost'=>$enviost,
        'recepcionest'=>$recepcionest,
        'transferencias_confirmadas'=>$transferencias_confirmadas,
        'transferencias_faltas'=>$transferencias_faltas]);
    }

    function create(){
        //return GetIdPlanta();
        $plantas=Planta::where('tipo',1)->where('activa',1)->whereNotIn('id',['id'=>GetIdPlanta()])->get();
        $planta=Planta::find(GetIdPlanta());
        

        $materiales=Material::where('id_planta',GetIdPlanta())->orderby('categoria','asc')->orderby('material','asc')->get();
        return view('recepcion.transferencias.create',['planta'=>$planta,'plantas'=>$plantas,'materiales'=>$materiales]);
    }


    function store(Request $request){
        //return $request;

        $transferencia=new Transferencia();
        $transferencia->id=GetUuid();
        
        $transferencia->id_origen=$request->id_origen;
        $transferencia->id_destino=$request->id_destino;
        $transferencia->id_entrego=GetId();
        $transferencia->entrego=GetNombre();
        
        $transferencia->observacion_entrego=$request->observacion_entrego;
        $transferencia->fecha_entrego=GetDateTimeNow();
        $transferencia->chofer=$request->chofer;
        $transferencia->vehiculo=$request->vehiculo;
        $transferencia->marcaymodelo=$request->marcaymodelo;
        $transferencia->matricula=$request->matricula; 
        //return $request->material; 
        $material=Material::find($request->material);      
        $transferencia->id_material=$request->material;
        $transferencia->material=$material->material;
        $transferencia->unidades='m³';
        $transferencia->cantidad_envio=$request->cantidad_envio;       
        
        $transferencia->fecha_recibio=GetDateTimeNow();
        $transferencia->save();

        return redirect('transferencias')->with('success','Se guardo correctamente.');

    }

    function show($id){
        $transferencia = Transferencia::find($id);
        
        $origen=Planta::where('id',$transferencia->id_origen)->first();
        $destino=Planta::where('id',$transferencia->id_destino)->first();
        $material=Material::where('id',$transferencia->id_material)->first();
        return view('recepcion.transferencias.show',['transferencia'=>$transferencia,'origen'=>$origen,'destino'=>$destino,'material'=>$material]);
    }

    function Recepciones(){
        $recepciones=Transferencia::select('transferencias.id','transferencias.material','transferencias.cantidad_envio','transferencias.unidades',db::raw("(select planta from plantas where id=transferencias.id_origen) as destino"))
        ->where('id_destino',GetIdPlanta())->paginate(15);
        return view('recepcion.transferencias.frames.recepciones',['recepciones'=>$recepciones]);
    }

    function Envios(){
        $envios=Transferencia::select('transferencias.id','transferencias.material','transferencias.cantidad_envio','transferencias.unidades',db::raw("(select planta from plantas where id=transferencias.id_origen) as destino"))
        ->where('id_origen',GetIdPlanta())->paginate(15);
        return view('recepcion.transferencias.frames.envios',['envios'=>$envios]);
    }

    function Confirmar($id){
        
        
        $transferencia = Transferencia::find($id);

        if($transferencia->id_origen==GetIdPlanta())
            return redirect('transferencias/'.$id)->with('error','No abuses.');
        $transferencia->recibio=GetNombre(0);
        $transferencia->fecha_recibio=GetDateTimeNow();
        $transferencia->confirmacion=1;
        $transferencia->save();

        return redirect('transferencias/'.$id)->with('success','Se guardo correctamente.');
    }
}
