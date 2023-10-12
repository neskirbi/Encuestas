<?php

namespace App\Http\Controllers\Android\Recitrack;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    function Login(Request $request){
        //return $request->all();
        
        $respuesta=array();
        $clientes=PostmanAndroid($request);
        foreach($clientes as $cliente){
            
            $client=Cliente::select('id','id as id_cliente','nombres','apellidos','pass','mail')->where('mail',$cliente['mail'])->first();
            if(!$client){
                $client=DB::table('clientes')
                ->join('generadores','generadores.id_cliente','=','clientes.id')
                ->join('obras','obras.id_generador','=','generadores.id')
                ->join('residentesobras','residentesobras.id_obra','=','obras.id')
                ->join('residentes','residentes.id','=','residentesobras.id_residente')
                ->where('residentes.mail',$cliente['mail'])
                ->select('clientes.id as id_cliente','residentes.id','residentes.nombre as nombres',DB::raw("'' as apellidos"),'residentes.mail','residentes.pass' )
               
                ->first();


                
            }
            
            
            if(!$client){
                return RespuestaAndroid(0,'Correo no registrado.');
                
            }
    
            //return $clientes;
            if(!password_verify($clientes[0]['pass'],$client->pass)){
                return RespuestaAndroid(0,'Error de contraseña.');
            }
    
            unset($client->pass);
            return RespuestaAndroid(1,'',$client);

        }
        
        
        

    }

    
}
