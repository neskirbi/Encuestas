<?php

namespace App\Http\Controllers\Soporte;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;
use App\Models\Chofer;
use App\Models\Transportista;
use App\Models\EmpresaTransporte;

class ChoferController extends Controller
{
    public function index()
    {
        $choferes=DB::table('choferes')
        ->where('id_planta','')
        ->where('tipo',0)
        ->orderby('created_at','desc')
        ->paginate(15);
        
        return view('soporte.choferes.choferes',['choferes'=>$choferes]);
    }


    public function show($id)
    {
        $chofer=Chofer::find($id);
        
        return view('soporte.choferes.editar',['chofer'=>$chofer]);
    }

    public function update(Request $request,$id){

        $chofer=Chofer::find($id);
        
        $chofer->nombres=$request->nombres;        
        $chofer->apellidos=$request->apellidos;
        $chofer->licencia=$request->licencia;     
        $chofer->cuenta=$request->cuenta;    
        $chofer->banco=$request->banco;    
        $chofer->nombret=$request->nombret;
        

        if($chofer->save()){
            return redirect('choferes/'.$id)->with('success','Actualizado.');
       }else{
            return redirect('choferes/'.$id)->with('error','Error, de registro.');
       }
    }


    function ConfirmaChofer($id){
        $chofer=Chofer::find($id);
        $chofer->verificado=1;
        $chofer->save();
        return Redirect::back()->with('success','Se guardaron los datos.');
    }



    function SuspendeChofer($id){
        $chofer=Chofer::find($id);
        $chofer->verificado=0;
        $chofer->save();
        return Redirect::back()->with('success','Se guardaron los datos.');
    }
}
