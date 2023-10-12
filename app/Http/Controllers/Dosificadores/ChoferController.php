<?php

namespace App\Http\Controllers\Dosificadores;

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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $choferes=DB::table('choferes')
        ->where('id_planta','=',GetIdPlanta())
        ->paginate(15);
        
        return view('dosificadores.choferes.choferes',['choferes'=>$choferes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresastransporte = DB::table('empresastransporte')
        ->where('id_transportista',GetIdPlanta())
        ->orderby('razonsocial')
        ->get(); 
        return view('dosificadores.choferes.create',['empresastransporte'=>$empresastransporte]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->pass!=$request->pass2){
            return Redirect::back()->with('error','Las contrasañas no coinciden.');
        }

        $chofer=Chofer::where('telefono',$request->telefono)->first();
        if($chofer){
            return Redirect::back()->with('error','Error, El número telefónico ya esta registrado.');
        }
        
        $chofer=new Chofer();
        $chofer->id=GetUuid();
        
        $chofer->nombres=$request->nombres;        
        $chofer->apellidos=$request->apellidos;
        $chofer->telefono=$request->telefono;
        $chofer->licencia=$request->licencia;
        $chofer->telefono=$request->telefono;
        $chofer->pass=$request->pass;
        $chofer->tipo=1;
        $chofer->verificado=1;
        $chofer->id_planta=GetIdPlanta();
        /*
        if($chofer->telefono!=null){
            $response=EnviarMensaje("+52".$chofer->telefono,'Su numero se ha registrado en reci-track.mx, para confirmar el registro de su número vaya al siguiente link reci-track.mx/ConfirmacionChofer/'.$chofer->id.' .');
            if(intval($response)>=400){
                return Redirect::back()->with('error','Error, el numero es invalido.');
            }
        }
*/
        if($chofer->save()){
             return redirect('choferesd')->with('success','Registro correcto.');
        }else{
             return redirect('choferesd')->with('error','Error, de registro.');
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chofer=Chofer::find($id);
       
        return view('dosificadores.choferes.editar',['chofer'=>$chofer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if($request->pass!=$request->pass2){
            return Redirect::back()->with('error','Las contrasañas no coinciden.');
        }


        if(isset($request->telefono)){
            $chofer=Chofer::where('telefono',$request->telefono)->first();
            if($chofer){
                return Redirect::back()->with('error','Error, El número telefónico ya esta registrado.');
            }
        }
        
        

        $chofer=Chofer::find($id);
        
        $chofer->nombres=$request->nombres;        
        $chofer->apellidos=$request->apellidos;
        $chofer->licencia=$request->licencia;
        
        
        $chofer->telefono=isset($request->telefono) ? $request->telefono : $chofer->telefono;
        if($request->pass!=null){
            $chofer->pass=$request->pass;
        }

        if($chofer->save()){
            return redirect('choferesd/'.$id)->with('success','Registro correcto.');
       }else{
            return redirect('choferesd/'.$id)->with('error','Error, de registro.');
       }
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
