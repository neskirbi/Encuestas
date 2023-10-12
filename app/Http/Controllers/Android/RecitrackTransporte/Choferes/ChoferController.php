<?php

namespace App\Http\Controllers\Android\RecitrackTransporte\Choferes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chofer;
use App\Models\PreVerificacion;

class ChoferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('android.choferes.create');
    }

    public function Token($id)
    {
        $chofer=Chofer::find($id);
        $chofer->token=GetUuid();
        $chofer->save();
        return redirect('DatosChofer/'.$id.'/'.$chofer->token);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Memoria();
        
        
        if($request->pass!=$request->pass2){
            return view('avisos.aviso',['titulo'=>'Error','mensaje'=>'Error las contraseñas no coinciden.']);
        }

        if(Chofer::where('telefono',$request->telefono)->first()){
            return Redirect::back()->with('error', 'El teléfono ya fue registrado anteriormente.');
        }

        if(!$pre=PreVerificacion::where('codigo',$request->codigo)->where('telefono',$request->telefono)->first()){
            return Redirect::back()->with('error', 'Verificación incorrecta.');
        }

        
        
        $chofer=new Chofer();
        $chofer->id=GetUuid();
        $chofer->nombres=$request->nombres;        
        $chofer->apellidos=$request->apellidos;
        $chofer->telefono=$request->telefono;
        $chofer->licencia=$request->licencia;
        
        $chofer->pass=$request->pass;

        if(!GuardarArchivos($request->inefrente,'/documentos/choferes/ine/frente',$chofer->id.'.jpg')){
            return Redirect::back()->with('error', 'Error al guardar INE.');
        }

        if(!GuardarArchivos($request->inereverso,'/documentos/choferes/ine/reverso',$chofer->id.'.jpg')){
            return Redirect::back()->with('error', 'Error al guardar INE.');
        }
        
       

        if($chofer->save()){
            return view('avisos.aviso',['titulo'=>'Registro correcto.','mensaje'=>'Gracias por registrarse en Recitrack Transporte .']);
        }else{
            return view('avisos.aviso',['titulo'=>'Error','mensaje'=>'Intentelo mas tarde.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function DatosChofer($id,$token)
    {
        $chofer=Chofer::find($id);
        if($chofer->token!=$token){
            return redirect('home');
        }
        return view('android.choferes.datos.datos',['chofer'=>$chofer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function UpdateChofer(Request $request, $id)
    {
        $chofer=Chofer::find($id);
        
        $chofer->nombres=$request->nombres;        
        $chofer->apellidos=$request->apellidos;
        $chofer->banco=isset($request->banco) ? $request->banco : '';
        $chofer->cuenta=isset($request->cuenta) ? $request->cuenta : '';
        
        $chofer->nombret=isset($request->nombret) ? $request->nombret : '';
        $chofer->licencia=$request->licencia;
        //$chofer->telefono=$request->telefono;

        /*if(isset($request->inefrente))
        if(!GuardarArchivos($request->inefrente,'/documentos/choferes/ine/frente',$chofer->id.'.jpg')){
            return Redirect::back()->with('error', 'Error al guardar INE.');
        }

        if(isset($request->inereverso))
        if(!GuardarArchivos($request->inereverso,'/documentos/choferes/ine/reverso',$chofer->id.'.jpg')){
            return Redirect::back()->with('error', 'Error al guardar INE.');
        }*/
        
        $chofer->save();
        return redirect('DatosChofer/'.$id.'/'.$chofer->token)->with('success','Actualizado.');
    }
    public function PassChofer($id,$token)
    {
        $chofer=Chofer::find($id);
        if($chofer->token!=$token){
            return redirect('home');
        }
        return view('android.choferes.pass.passedith',['chofer'=>$chofer]);
    }

    public function UpdateChoferPass(Request $request, $id)
    {
        $chofer=Chofer::find($id);
        if($request->pass!=$request->pass2){
            return redirect('PassChofer/'.$id.'/'.$chofer->token)->with('error','Las Contraseñas no son coinciden.');
        }
        
        $chofer->pass=$request->pass;       
        
        $chofer->save();
        return redirect('PassChofer/'.$id.'/'.$chofer->token)->with('success','Se cambio la contraseña.');
    }


    public function DocsChofer($id,$token)
    {
        $chofer=Chofer::find($id);
        if($chofer->token!=$token){
            return redirect('home');
        }
        return view('android.choferes.documentos.documentos',['chofer'=>$chofer]);
    }

    public function UpdateChoferDocs(Request $request, $id)
    {
        $chofer=Chofer::find($id);
        
        if(!GuardarArchivos($request->inefrente,'/documentos/choferes/ine/frente',$chofer->id.'.jpg')){
            return Redirect::back()->with('error', 'Error al guardar INE.');
        }

        
        if(!GuardarArchivos($request->inereverso,'/documentos/choferes/ine/reverso',$chofer->id.'.jpg')){
            return Redirect::back()->with('error', 'Error al guardar INE.');
        }      
        
        return redirect('DocsChofer/'.$id.'/'.$chofer->token)->with('success','Se cambio la contraseña.');
    }

}
