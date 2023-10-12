<?php

namespace App\Http\Controllers\Soporte;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Entidad;
use App\Models\Municipio;
use App\Models\Director;
use App\Models\Administrador;
use App\Models\Vendedor;
use App\Models\Recepcion;
use App\Models\Finanza;
use App\Models\Dependencia;
use Redirect;

class DependenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dependencias=DB::table('dependencias')->select('id','id_municipio',
        DB::raw("(select municipio from municipios where municipios.id=dependencias.id_municipio) as municipio"),
        'nombre','mail','pass')->orderby('municipio','asc')->get();
        return view('soporte.dependencias.dependencias',['dependencias'=>$dependencias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entidades=Entidad::orderby('entidad','asc')->get();
        return view('soporte.dependencias.create',['entidades'=>$entidades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $director=Director::where('mail',$request->mail)->first(); 
        if($director){            
            return redirect('planta')->with('error', 'El correo ya está registrado como Director, debe utilizar otro.');
        }   
      
        $administrador=Administrador::where('mail',$request->mail)->first(); 
        if($administrador){            
            return redirect('planta')->with('error', 'El correo ya está registrado como Administrador, debe utilizar otro.');
        }

        $vendedor=Vendedor::where('mail',$request->mail)->first(); 
        if($vendedor){            
            return redirect('planta')->with('error', 'El correo ya está registrado como Vendedor, debe utilizar otro.');
        }  
        
        $recepcion=Recepcion::where('mail',$request->mail)->first(); 
        if($recepcion){            
            return redirect('planta')->with('error', 'El correo ya está registrado en recepción, debe utilizar otro.');
        }  

        $finanza=Finanza::where('mail',$request->mail)->first(); 
        if($finanza){            
            return redirect('planta')->with('error', 'El correo ya está registrado en Finanzas, debe utilizar otro.');
        }  

        $dependencia=Dependencia::where('mail',$request->mail)->first(); 
        if($dependencia){            
            return redirect('planta')->with('error', 'El correo ya está registrado en Finanzas, debe utilizar otro.');
        }  

        $dependencia=new Dependencia();
        
        $dependencia->id=GetUuid();
        $dependencia->nombre=$request->nombre;
        $dependencia->id_municipio=$request->municipio;
        $dependencia->mail=$request->mail;
        $dependencia->pass=$request->pass;
        $dependencia->save();
        return redirect('dependencias')->with('success','Datos Guardados.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $dependecia=Dependencia::find($id);
        $entidades=Entidad::orderby('entidad','asc')->get();
        $municipio=Municipio::find($dependecia->id_municipio);
        
        $entidad=Entidad::find($municipio->id_entidad);
        return view('soporte.dependencias.update',['dependecia'=>$dependecia,'entidades'=>$entidades,'entidad'=>$entidad,'municipio'=>$municipio]);
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
        $dependencia= Dependencia::find($id);
        
        $dependencia->nombre=$request->nombre;
        $dependencia->id_municipio=$request->municipio;
        $dependencia->pass=$request->pass;
        $dependencia->save();
        return redirect('dependencias')->with('success','Datos Guardados.');
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
