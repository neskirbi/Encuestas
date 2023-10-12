<?php


namespace App\Http\Controllers\Cliente;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Cliente;
use App\Models\Campamento;
use App\Models\Obra;



class CampamentoController extends Controller
{
    function index(){
        $campamentos = Campamento::get(); 
        
        

        return view(' cliente.campamentos.campamentos',['campamentos'=> $campamentos]);
    }


    function create(){
        $obras=Cliente::select('obras.id','obras.obra')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('obras','obras.id_generador','=','generadores.id')
        ->where('clientes.id',GetId())        
        ->get();
        return view(' cliente.campamentos.create',['obras'=>$obras]);
    }
   
    function store(Request $request)
    {
        //return $request;
        $campamentos =new Campamento();
        $id = $campamentos->id = GetUuid();
        $campamentos->id_obra=$request->obra;
        $campamentos->responsable=$request->responsable;
        $campamentos->arearesponsable=$request->arearesponsable;
        $campamentos->calle=$request->calle;
        $campamentos->colonia=$request->colonia;
        $campamentos->alcaldia=$request->alcaldia;
        $campamentos->codigopostal=$request->codigopostal;
        $campamentos->telefono=$request->telefono;
        
        

        if($campamentos->save()){
            return redirect(url('campamentos'))->with('success', 'Registro de campamento exitoso');
        }else{
            return Redirect::back();
        }
    }

    function show($id){
        $campamento=Campamento::find($id);

        $obras=Cliente::select('obras.id','obras.obra')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('obras','obras.id_generador','=','generadores.id')
        ->where('clientes.id',GetId())        
        ->get();

        $obra=Obra::select('obras.id','obras.obra')
        ->where('obras.id',$campamento->id_obra)        
        ->first();
        return view('cliente.campamentos.editarcampamento',['campamento'=> $campamento,'obra'=>$obra,'obras'=>$obras]);
        

    }

    function update(Request $request,$id){
        
        $campamento=Campamento::find($id);

        $campamento->id_obra=$request->obra;
        $campamento->responsable=$request->responsable;
        $campamento->arearesponsable=$request->arearesponsable;
        $campamento->calle=$request->calle;
        $campamento->colonia=$request->colonia;
        $campamento->alcaldia=$request->alcaldia;
        $campamento->codigopostal=$request->codigopostal;
        $campamento->telefono=$request->telefono;
    
        if($campamento->save()){
            return redirect('campamentos/'.$id)->with('success','Registro de campamento exitoso');
        }else{
            return redirect('campamentos/'.$id)->with('error','Error al guardar el campamento');
        }
    }
}
