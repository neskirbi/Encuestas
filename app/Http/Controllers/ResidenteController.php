<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Residente;
use App\Models\ResidenteObra;
use Redirect;

class ResidenteController extends Controller
{

    public function __construct(){
        $this->middleware('clientelogged');
    }

    
    public function index(){
        $residentes=DB::table('clientes')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('obras','obras.id_generador','=','generadores.id')
        ->join('residentesobras','residentesobras.id_obra','=','obras.id')
        ->join('residentes','residentes.id','=','residentesobras.id_residente')
        ->where('clientes.id',Auth::guard('clientes')->user()->id)
        ->select('residentes.id','residentes.nombre','residentes.mail','residentes.pass',DB::raw('GROUP_CONCAT(obras.obra SEPARATOR \',\') as obras' ))
        ->groupby('residentes.id','residentes.nombre','residentes.mail','residentes.pass')
        ->get();
        foreach($residentes as $key=>$residente){
            $residentes[$key]->obras = explode(",",$residente->obras);
        }

        $obras=DB::table('clientes')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('obras','obras.id_generador','=','generadores.id')
        ->where('clientes.id',Auth::guard('clientes')->user()->id)
        ->get();

        return view('cliente.residentes.residentes',['residentes'=>$residentes,'obras'=>$obras]);
    }

    public function RegistroResidente(){
        return view('cliente.residentes.registroresidente');
    }

    public function store(Request $request){

        $cliente=DB::table('clientes')->where('mail',$request->mail)->first();
        if($cliente){
            return Redirect::back()->with('error', 'Error, el correo ya está registrado.');
        }

        $residente=DB::table('residentes')->where('mail',$request->mail)->first();
        if($residente){
            return Redirect::back()->with('error', 'Error, el correo ya está registrado.');
        }

        $id_residente=GetUuid();

        $residente=new Residente();
        $residente->id = $id_residente;
        $residente->nombre = $request->nombre;
        $residente->mail = $request->mail;
        $residente->pass = password_hash($request->pass,PASSWORD_DEFAULT);
        $residente->firma = '';


        if(!$residente->save()){
            return Redirect::back()->with('error', 'Error al registrar al residente.');
        }

        foreach($request->obras as $obra){
            $residenteobra=new ResidenteObra();
            $residenteobra->id = GetUuid();
            $residenteobra->id_residente = $id_residente;
            $residenteobra->id_obra = $obra;
            if(!$residenteobra->save()){
                return Redirect::back()->with('error', 'Error al asignar obra al residente.');
            }
        }

        return Redirect::back()->with('success', 'Se registró correctamente al residente.');
       
    }

    public function destroy($id){
        $residenteobras=DB::table('residentesobras')
        ->where('id_residente','=',$id)
        ->get();
        foreach($residenteobras as $residenteobra){
            $obra=ResidenteObra::find($residenteobra->id);
            if(!$obra->delete()){
                return Redirect::back()->with('error', 'Error al borrar asignacion.');
            }

        }
        $residente=Residente::find($id);
        if(!$residente->delete()){
            return Redirect::back()->with('error', 'Error al borrar residente.');
        }
        return Redirect::back()->with('success', 'Se borro el registro correctamente.');
    }
}
