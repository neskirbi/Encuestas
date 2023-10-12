<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Director;
use App\Models\Administrador;
use App\Models\Vendedor;
use App\Models\Planta;
use App\Models\Recepcion;
use App\Models\Finanza;
use App\Models\Dosificador;
use Redirect;

class PlantaController extends Controller
{


    public function __construct(){
        $this->middleware('administradorlogged');
    }

    
    function index(){

        $plantas=GetPlantas();
        $id_plantas=array();
        if(count($plantas)){
            foreach($plantas as $planta){
                $id_plantas[]=$planta->id_planta;
            }
        }else{
            $id_plantas[]=GetIdPlanta(); 
        }
       


        $planta = DB::table('plantas')
        ->where('id',GetIdPlanta())
        ->first();

        $directores=DB::table('directores')
        ->wherein('id_planta',$id_plantas)
        ->orderby('director','asc')
        ->get();

        $administradores=DB::table('administradores')
        ->wherein('id_planta',$id_plantas)
        ->orderby('administrador','asc')
        ->get();

        $vendedores=DB::table('vendedores')
        ->wherein('id_planta',$id_plantas)
        ->orderby('vendedor','asc')
        ->get();

        $recepciones=DB::table('recepciones')
        ->wherein('id_planta',$id_plantas)
        ->orderby('nombre','asc')
        ->get();


        $finanzas=DB::table('finanzas')
        ->wherein('id_planta',$id_plantas)
        ->orderby('nombre','asc')
        ->get();


        $dosificadores=DB::table('dosificadores')
        ->wherein('id_planta',$id_plantas)
        ->orderby('dosificador','asc')
        ->get();

        return view('administracion.plantas.planta',['planta'=>$planta,'plantas'=>$plantas,'directores'=>$directores,'administradores'=>$administradores,'vendedores'=>$vendedores,'recepciones'=>$recepciones,'finanzas'=>$finanzas,'dosificadores'=>$dosificadores]);
    }

    function show($id){
        $planta = DB::table('plantas')
        ->select('id','planta','direccion','plantaauto')
        ->where('id',$id)
        ->first();

        $administradores=DB::table('administradores')
        ->where('id_planta',$planta->id)
        ->orderby('administrador','asc')
        ->get();

        return view('administracion.plantas.planta',['planta'=>$planta,'administradores'=>$administradores]);
    }

    function update(Request $request,$id){
        $planta=Planta::find($id);
        $planta->planta=$request->planta;
        $planta->direccion=$request->direccion;
        $planta->codigo=$request->codigo;
        $planta->plantaauto=$request->plantaauto;
        if($planta->save()){
            return redirect('planta')->with('success', 'Se actializ&oacute; la informaci&oacute;n.');
        }else{
            return redirect('planta')->with('error', 'Error al guardar.');
        }
    }


    function AltaAdmin(Request $request){
       
        
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

        $dosificador=Dosificador::where('mail',$request->mail)->first(); 
        if($dosificador){            
            return redirect('planta')->with('error', 'El correo ya está registrado en Dosificadores, debe utilizar otro.');
        }  
        //return $request;

        switch ($request->tadmin) {
            case '1':
                $director=new Director();
                $director->id=GetUuid();
                $director->id_planta=GetIdPlanta();
                $director->director=$request->nombre;
                $director->mail=$request->mail;
                $director->pass='';
                if($director->save()){
                    
                    Historial('directores',$director->id,GetId(),'Alta de director','Director: '.$director->director.' Correo:'.$director->mail);
                    $token=TokenGen($request->mail);
                    if($token){
                        Notificar('Alta Directivo Recitrack','Asignar Contraseña.','','Se le ha generado una cuenta de Director, para la plataforma Recitrack, favor de ir al sigiente link para generar su contraseña. ',[$request->mail],'<a href="https://reci-track.mx/AdminPass/'.$token.'" class="btn btn-default  btn-outline-secondary">Asignar Contraseña</a>');
                    }
                    
                    return redirect('planta')->with('success', 'Se agregó el nuevo director.');
                }else{
                    return redirect('planta')->with('error', 'Error al guardar.');
                }
                break;

             case '2':
                $administrador=new Administrador();
                $administrador->id=GetUuid();
                $administrador->id_planta=GetIdPlanta();
                $administrador->administrador=$request->nombre;
                $administrador->cargo=$request->cargo;
                $administrador->mail=$request->mail;
                $administrador->pass='';
                if($administrador->save()){
                    
                    Historial('administradores',$administrador->id,GetId(),'Alta de administrador','Administrador: '.$administrador->administrador.' Correo:'.$administrador->mail);
                    $token=TokenGen($request->mail);
                    if($token){
                        Notificar('Alta Administrador Recitrack','Asignar Contraseña.','','Se le ha generado una cuenta de administrador, para la plataforma Recitrack, favor de ir al sigiente link para generar su contraseña. ',[$request->mail],'<a href="https://reci-track.mx/AdminPass/'.$token.'" class="btn btn-default  btn-outline-secondary">Asignar Contraseña</a>');
                    }
                    
                    return redirect('planta')->with('success', 'Se agregó el nuevo administrador.');
                }else{
                    return redirect('planta')->with('error', 'Error al guardar.');
                }
              
             break;
            
            case '3':
                $vendedor=new Vendedor();
                $vendedor->id=GetUuid();
                $vendedor->id_planta=GetIdPlanta();
                $vendedor->vendedor=$request->nombre;
                $vendedor->mail=$request->mail;
                $vendedor->pass='';
                if($vendedor->save()){
                    
                    Historial('vendedores',$vendedor->id,GetId(),'Alta de vendedor','Vendedor: '.$vendedor->vendedor.' Correo:'.$vendedor->mail);
                    $token=TokenGen($request->mail);
                    if($token){
                        Notificar('Alta Ventas Recitrack','Asignar Contraseña.','','Se le ha generado una cuenta de Vendedor, para la plataforma Recitrack, favor de ir al sigiente link para generar su contraseña. ',[$request->mail],'<a href="https://reci-track.mx/AdminPass/'.$token.'" class="btn btn-default  btn-outline-secondary">Asignar Contraseña</a>');
                    }
                    
                    return redirect('planta')->with('success', 'Se agregó el nuevo vendedor.');
                }else{
                    return redirect('planta')->with('error', 'Error al guardar.');
                }
            break;

            case '4':
                $administrador=new Recepcion();
                $administrador->id=GetUuid();
                $administrador->id_planta=GetIdPlanta();
                $administrador->nombre=$request->nombre;
                $administrador->cargo=$request->cargo;
                $administrador->mail=$request->mail;
                $administrador->pass='';
                if($administrador->save()){
                    
                    Historial('administradores',$administrador->id,GetId(),'Alta de recepcionista','Recepción: '.$administrador->administrador.' Correo:'.$administrador->mail);
                    $token=TokenGen($request->mail);
                    if($token){
                        Notificar('Alta Recepción Recitrack','Asignar Contraseña.','','Se le ha generado una cuenta de recepción, para la plataforma Recitrack, favor de ir al sigiente link para generar su contraseña. ',[$request->mail],'<a href="https://reci-track.mx/AdminPass/'.$token.'" class="btn btn-default  btn-outline-secondary">Asignar Contraseña</a>');
                    }
                    
                    return redirect('planta')->with('success', 'Se agregó el nuevo recepcionista.');
                }else{
                    return redirect('planta')->with('error', 'Error al guardar.');
                }
              
             break;

             case '5':
                $administrador=new Finanza();
                $administrador->id=GetUuid();
                $administrador->id_planta=GetIdPlanta();
                $administrador->nombre=$request->nombre;
                $administrador->cargo=$request->cargo;
                $administrador->mail=$request->mail;
                $administrador->pass='';
                if($administrador->save()){
                    
                    Historial('administradores',$administrador->id,GetId(),'Alta '.$request->cargo,'Administrador: '.$administrador->nombre.' Correo:'.$administrador->mail);
                    $token=TokenGen($request->mail);
                    if($token){
                        Notificar('Alta Finanzas Recitrack','Asignar Contraseña.','','Se le ha generado una cuenta de finanzas, para la plataforma Recitrack, favor de ir al sigiente link para generar su contraseña. ',[$request->mail],'<a href="https://reci-track.mx/AdminPass/'.$token.'" class="btn btn-default  btn-outline-secondary">Asignar Contraseña</a>');
                    }
                    
                    return redirect('planta')->with('success', 'Se agregó el nuevo administrador.');
                }else{
                    return redirect('planta')->with('error', 'Error al guardar.');
                }
              
             break;

             case '6':
                $dosificador=new Dosificador();
                $dosificador->id=GetUuid();
                $dosificador->id_planta=GetIdPlanta();
                $dosificador->dosificador=$request->nombre;
                $dosificador->cargo=$request->cargo;
                $dosificador->mail=$request->mail;
                $dosificador->pass='';
                if($dosificador->save()){
                    
                    Historial('dosificadores',$dosificador->id,GetId(),'Alta '.$request->cargo,'Dosificador: '.$dosificador->dosificador.' Correo:'.$dosificador->mail);
                    $token=TokenGen($request->mail);
                    if($token){
                        Notificar('Alta Recitrack','Asignar Contraseña.','','Se le ha generado una cuenta de dosificador, para la plataforma Recitrack, favor de ir al sigiente link para generar su contraseña. ',[$request->mail],'<a href="https://reci-track.mx/AdminPass/'.$token.'" class="btn btn-default  btn-outline-secondary">Asignar Contraseña</a>');
                    }
                    
                    return redirect('planta')->with('success', 'Se agregó el nuevo administrador.');
                }else{
                    return redirect('planta')->with('error', 'Error al guardar.');
                }
              
             break;
        }
    }

    function EditarAdmin(Request $request,$id){
        

        if(isset($request->mail)){
            
            
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

            $dosificador=Dosificador::where('mail',$request->mail)->first(); 
            if($dosificador){            
                return redirect('planta')->with('error', 'El correo ya está registrado en Dosificadores, debe utilizar otro.');
            }  
        }
        
        
        $director=Director::find($id); 
        if($director){            
            $director->director=$request->director;
            $director->mail=isset($request->mail) ? $request->mail : $director->mail;
            
            if($director->save()){
                return redirect('planta')->with('success', 'Datos Actualizados.');
            }else{
                return redirect('planta')->with('error', 'Error al guardar.');
            }
        }   
        
        $administrador=Administrador::find($id); 
        if($administrador){            
            $administrador->administrador=$request->administrador;
            $administrador->cargo=$request->cargo;
            $administrador->mail=isset($request->mail) ? $request->mail : $administrador->mail;

            if($administrador->save()){
                return redirect('planta')->with('success', 'Datos Actualizados.');
            }else{
                return redirect('planta')->with('error', 'Error al guardar.');
            }
        }       

        $vendedor=Vendedor::find($id);
        if($vendedor){  
            $vendedor->vendedor=$request->vendedor;
            $vendedor->mail=isset($request->mail) ? $request->mail : $vendedor->mail;

            if($vendedor->save()){
                return redirect('planta')->with('success', 'Datos Actualizados.');
            }else{
                return redirect('planta')->with('error', 'Error al guardar.');
            }
        } 


        $recepcion=Recepcion::find($id);
        if($recepcion){  
            $recepcion->nombre=$request->nombre;
            $recepcion->cargo=$request->cargo;
            $recepcion->mail=isset($request->mail) ? $request->mail : $recepcion->mail;

            if($recepcion->save()){
                return redirect('planta')->with('success', 'Datos Actualizados.');
            }else{
                return redirect('planta')->with('error', 'Error al guardar.');
            }
        } 

        $finanza=Finanza::find($id);
        if($finanza){  
            $finanza->nombre=$request->nombre;
            $finanza->cargo=$request->cargo;
            $finanza->mail=isset($request->mail) ? $request->mail : $finanza->mail;

            if($finanza->save()){
                return redirect('planta')->with('success', 'Datos Actualizados.');
            }else{
                return redirect('planta')->with('error', 'Error al guardar.');
            }
        } 

        $dosificador=Dosificador::find($id);
        if($dosificador){  
            $dosificador->dosificador=$request->nombre;
            $dosificador->cargo=$request->cargo;
            $dosificador->mail=isset($request->mail) ? $request->mail : $finanza->mail;

            if($dosificador->save()){
                return redirect('planta')->with('success', 'Datos Actualizados.');
            }else{
                return redirect('planta')->with('error', 'Error al guardar.');
            }
        } 

       
    }


    function BorrarAdmin($id){ 
       
      
        $director=Director::find($id); 
        if($director){            
            if($director->delete()){
                return redirect('planta')->with('success', 'Se quitó a '.$director->director.'.');
            }else{
                return redirect('planta')->with('error', 'Error al quitar.');
            } 
        }   
        
        $administrador=Administrador::find($id); 
        if($administrador){            
            if($administrador->delete()){
                return redirect('planta')->with('success', 'Se quitó a '.$administrador->administrador.'.');
            }else{
                return redirect('planta')->with('error', 'Error al quitar.');
            } 
        }       

        $vendedor=Vendedor::find($id);
        if($vendedor){            
            if($vendedor->delete()){
                return redirect('planta')->with('success', 'Se quitó a '.$vendedor->vendedor.'.');
            }else{
                return redirect('planta')->with('error', 'Error al quitar.');
            } 
        }

        $recepcion=Recepcion::find($id);
        if($recepcion){            
            if($recepcion->delete()){
                return redirect('planta')->with('success', 'Se quitó '.$recepcion->nombre.'.');
            }else{
                return redirect('planta')->with('error', 'Error al quitar.');
            } 
        } 

        $finanza=Finanza::find($id);
        if($finanza){            
            if($finanza->delete()){
                return redirect('planta')->with('success', 'Se quitó '.$finanza->nombre.'.');
            }else{
                return redirect('planta')->with('error', 'Error al quitar.');
            } 
        } 

        $dosificador=Dosificador::find($id);
        if($dosificador){            
            if($dosificador->delete()){
                return redirect('planta')->with('success', 'Se quitó '.$dosificador->dosificador.'.');
            }else{
                return redirect('planta')->with('error', 'Error al quitar.');
            } 
        } 


        
    }
}
