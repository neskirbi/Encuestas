<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Soporte;
use App\Models\Asociado;
use App\Models\Cliente;
use App\Models\Uia;
use App\Models\Inspector;
use App\Models\Administrador;


use App\Models\Token;
use App\Mail\MailRecuperar;
use App\Models\Director;

 



class LoginController extends Controller
{
    use AuthenticatesUsers;
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    function authenticateasociado(Request $request){
        if(strlen($request->mail)==0 || strlen($request->pass)==0){
            return redirect('acceso')->with('error', '¡Campos vacios!');
        }

        
        $asociado = Asociado::where([
            'mail' => $request->mail, 
            'pass' => $request->pass
        ])->first();
        
        
        if($asociado)
        {
            Auth::guard('asociados')->login($asociado);

            return redirect('generadorasoc');
        }
        return redirect('acceso')->with('error', '¡Error en los los datos!');
    }


    
    function LoginSoporte(Request $request){
        if(strlen($request->mail)==0 || strlen($request->pass)==0){
            return redirect('soporte')->with('error', '¡Campos vacios!');
        }

        
        $soporte = Soporte::where([
            'mail' => $request->mail, 
            'pass' => $request->pass
        ])->first();
        
        
        if($soporte){
            Auth::guard('soportes')->login($soporte);

            return redirect('vehiculossoporte');
        }
        return redirect('soporte')->with('error', '¡Error en los los datos!');
    }



    
        

    function authenticate(Request $request){
        if(strlen($request->mail)==0 || strlen($request->pass)==0){
            return redirect('home')->with('error', '¡Campos vacios!');
        }
        
        $cliente = Cliente::where([
            'mail' => $request->mail
        ])->first();       
        
        
        if($cliente)
        {
           

            if($cliente->confirmacion){
                if(!password_verify($request->pass,$cliente->pass)){
                    return redirect('home')->with('error', '¡Error de contraseña!');
                }
                Auth::guard('clientes')->login($cliente);
                //return $cliente;
                return redirect('dashboard');
            }else{
                return view('mails.enviodecorreo',['cliente'=>$cliente]);
            }
            
        }

        

        /**
         * Si no encuentra registro en la tabla de clientes la buscara en la tabla de residentes para iniciar secion con ese tipo de usuario
         */
        $residente = Residente::where([
            'mail' => $request->mail
        ])->first();
        
        
        if($residente)
        {
            if(!password_verify($request->pass,$residente->pass)){
                return redirect('home')->with('error', '¡Error de contraseña!');
            }
            Auth::guard('residentes')->login($residente);
            //return $cliente;
            return redirect('citas');
        }

        /**
         * Si no encuatra registro en ninguna de las dos tablas regresa mensaje de error 
         */
        return redirect('home')->with('error', '¡Correo no registrado!');
    }


    function authenticateresidentes(Request $request){
        if(strlen($request->mail)==0 || strlen($request->pass)==0){
            return redirect('home')->with('error', '¡Campos vacios!');
        }

        
        $residente = Residente::where([
            'mail' => $request->mail, 
            'pass' => $request->pass
        ])->first();
        
        
        if($residente)
        {
            Auth::guard('residentes')->login($residente);
            //return $cliente;
            return redirect('citas');
        }
        return redirect('home')->with('error', '¡Correo no registrado!');
    }

    function AuthenticateSedema(Request $request){
        if(strlen($request->mail)==0 || strlen($request->pass)==0){
            return redirect('home')->with('error', '¡Campos vacios!');
        }

        
        $sedema = Sedema::where([
            'mail' => $request->mail, 
            'pass' => $request->pass
        ])->first();
        
        
        if($sedema)
        {
            Auth::guard('sedemas')->login($sedema);
            //return $cliente;
            return redirect('sedemao');
        }
        return redirect('home')->with('error', '¡Correo no registrado!');
    }


    function Login(Request $request){
        /*
        $director = Director::where([
            'mail' => $request->mail
        ])->first();

        if($director){
            if(!password_verify($request->pass,$director->pass)){
                return redirect('loginpage')->with('error', '¡Error de contraseña!');
            }
            Auth::guard('directores')->login($director);
            return redirect('home');
        }

        $administrador = Administrador::where([
            'mail' => $request->mail
        ])->first();

        if($administrador){
            if(!password_verify($request->pass,$administrador->pass)){
                return redirect('loginpage')->with('error', '¡Error de contraseña!');
            }
            Auth::guard('administradores')->login($administrador);            
            Logueo(GetId());
            return redirect('home');
        }
        */
        

        $uia = Uia::where([
            'mail' => $request->mail
        ])->first();

        if($uia){
            if($request->pass!=$uia->pass){
                return redirect('loginpage')->with('error', '¡Error de contraseña!');
            }
            Auth::guard('uias')->login($uia);
            return redirect('home');
        }

        $inspector = Inspector::where([
            'mail' => $request->mail
        ])->first();

        if($inspector){
            if($request->pass!=$inspector->pass){
                return redirect('loginpage')->with('error', '¡Error de contraseña!');
            }
            Auth::guard('inspectores')->login($inspector);
            return redirect('home');
        }
        

        return redirect('loginpage')->with('error', '¡Correo no registrado!');
    }


    function logout(){
        if( Auth::guard('soportes')->check()){
            Auth::guard('soportes')->logout();
            return redirect('soporte');
        }
        if( Auth::guard('asociados')->check()){
            Auth::guard('asociados')->logout();
            return redirect('acceso');
        }
        if( Auth::guard('directores')->check()){
            Auth::guard('directores')->logout();
        }
        if( Auth::guard('administradores')->check()){
            Auth::guard('administradores')->logout();
        }
        if( Auth::guard('uias')->check()){
            Auth::guard('uias')->logout();
        }  
        if( Auth::guard('inspectores')->check()){
            Auth::guard('inspectores')->logout();
        }  
        
        return redirect('home');
    }


    function Recuperar(Request $request){

        if(Director::where('mail',$request->mail)->first()){
            $this->MailRecuperar($request->mail);
            return redirect('home')->with('success','Se envió un correo con las instrucciones para recuperar su contraseña.');
        }

        if(Administrador::where('mail',$request->mail)->first()){
            $this->MailRecuperar($request->mail);
            return redirect('home')->with('success','Se envió un correo con las instrucciones para recuperar su contraseña.');
        }

        if(Vendedor::where('mail',$request->mail)->first()){
            $this->MailRecuperar($request->mail);
            return redirect('home')->with('success','Se envió un correo con las instrucciones para recuperar su contraseña.');
        }

        if(Recepcion::where('mail',$request->mail)->first()){
            $this->MailRecuperar($request->mail);
            return redirect('home')->with('success','Se envió un correo con las instrucciones para recuperar su contraseña.');
        }

        if(Finanza::where('mail',$request->mail)->first()){
            $this->MailRecuperar($request->mail);
            return redirect('home')->with('success','Se envió un correo con las instrucciones para recuperar su contraseña.');
        }

        if(Dosificador::where('mail',$request->mail)->first()){
            $this->MailRecuperar($request->mail);
            return redirect('home')->with('success','Se envió un correo con las instrucciones para recuperar su contraseña.');
        }
        
        if(Cliente::where('mail',$request->mail)->first()){
            $this->MailRecuperar($request->mail);
            return redirect('home')->with('success','Se envió un correo con las instrucciones para recuperar su contraseña.');
        }

        if(Residente::where('mail',$request->mail)->first()){
            $this->MailRecuperar($request->mail);
            return redirect('home')->with('success','Se envió un correo con las instrucciones para recuperar su contraseña.');
        }

        if(Transportista::where('mail',$request->mail)->first()){
            $this->MailRecuperar($request->mail);
            return redirect('home')->with('success','Se envió un correo con las instrucciones para recuperar su contraseña.');
        }
    }

    function MailRecuperar($mail){
        $id=GetUuid();
        $token=Token::where('mail',$mail)->first();
        
       
        if($token){
            $token=Token::find($token->id);
            $token->delete();
        }
        
        $token=new Token();        
        $token->id=$id;
        $token->token=password_hash($id,PASSWORD_DEFAULT);
        $token->mail=$mail;
        $token->save();
        $correo=new MailRecuperar($mail,$token->id);
        Mail::to($mail)->queue($correo);
        if(count(Mail::failures())==0){
            return true;
        }else{
            return false;
        }
        


    }

    function GuardarPass(Request $request,$id){
        $token=Token::find($id);
        
        if($token){

            $pass=Director::where('mail',$token->mail)
            ->update([
                'pass' => password_hash($request->pass,PASSWORD_DEFAULT)
            ]);

            if($pass){
                 $token->delete();
                return redirect('home')->with('success','Se guardo la contraseña.');
            }

            $pass=Administrador::where('mail',$token->mail)
            ->update([
                'pass' => password_hash($request->pass,PASSWORD_DEFAULT)
            ]);

            if($pass){
                 $token->delete();
                return redirect('home')->with('success','Se guardo la contraseña.');
            }

            $pass=Vendedor::where('mail',$token->mail)
            ->update([
                'pass' => password_hash($request->pass,PASSWORD_DEFAULT)
            ]);

            if($pass){
                 $token->delete();
                return redirect('home')->with('success','Se guardo la contraseña.');
            }


            $pass=Recepcion::where('mail',$token->mail)
            ->update([
                'pass' => password_hash($request->pass,PASSWORD_DEFAULT)
            ]);

            if($pass){
                $token->delete();
                return redirect('home')->with('success','Se guardo la contraseña.');
            }

            
            $pass=Finanza::where('mail',$token->mail)
            ->update([
                'pass' => password_hash($request->pass,PASSWORD_DEFAULT)
            ]);


            if($pass){
                $token->delete();
                return redirect('home')->with('success','Se guardo la contraseña.');
            }

            $pass=Dosificador::where('mail',$token->mail)
            ->update([
                'pass' => password_hash($request->pass,PASSWORD_DEFAULT)
            ]);


            if($pass){
                $token->delete();
                return redirect('home')->with('success','Se guardo la contraseña.');
            }

            
            if($cliente=Cliente::where('mail',$token->mail)->first()){
                $cliente=Cliente::find($cliente->id);
                $cliente->pass=password_hash($request->pass,PASSWORD_DEFAULT);
                
                if($cliente->save()){
                    $token->delete();
                    return redirect('home')->with('success','Se guardo la contraseña.');
                }else{
                    return redirect('home')->with('Error','Error. No se pudo guardar la contraseña.');
                }
            }
        
            if($residente=Residente::where('mail',$token->mail)->first()){
                $residente=Residente::find($residente->id);
                $residente->pass=password_hash($request->pass,PASSWORD_DEFAULT);
                
                if($residente->save()){
                    $token->delete();
                    return redirect('home')->with('success','Se guardo la contraseña.');
                }else{
                    return redirect('home')->with('Error','Error. No se pudo guardar la contraseña.');
                }
            }

            if($transportista=Transportista::where('mail',$token->mail)->first()){
                $transportista=Transportista::find($transportista->id);
                $transportista->pass=password_hash($request->pass,PASSWORD_DEFAULT);
                
                if($transportista->save()){
                    $token->delete();
                    return redirect('home')->with('success','Se guardo la contraseña.');
                }else{
                    return redirect('home')->with('Error','Error. No se pudo guardar la contraseña.');
                }
            }
            
            
            
            
        }else{
            return redirect('home')->with('Error','Error. No se encontró la petición o ya se ultilizó el link anteriormente.');
        }
    }


    function RecuperarAdmin(Request $request){
        
        if(Director::where('mail',$request->mail)->first()){
            $token=TokenGen($request->mail);
            if($token){
                Notificar('Recuperar Contraseña','Recuperar contraseña.','','Por favor, para recuperar la contraseña de '.$request->mail.' de click en el siguiente enlace.',[$request->mail],'<a href="https://reci-track.mx/AdminPass/'.$token.'" class="btn btn-default  btn-outline-secondary">Recuperar Contraseña</a>');
            }
            return redirect('home')->with('success','Se envió un correo con las instrucciones para recuperar su contraseña.');
        }

        if(Administrador::where('mail',$request->mail)->first()){
            $token=TokenGen($request->mail);
            if($token){
                Notificar('Recuperar Contraseña','Recuperar contraseña.','','Por favor, para recuperar la contraseña de '.$request->mail.' de click en el siguiente enlace.',[$request->mail],'<a href="https://reci-track.mx/AdminPass/'.$token.'" class="btn btn-default  btn-outline-secondary">Recuperar Contraseña</a>');
            }
            return redirect('home')->with('success','Se envió un correo con las instrucciones para recuperar su contraseña.');
        }

        if(Vendedor::where('mail',$request->mail)->first()){
            $token=TokenGen($request->mail);
            if($token){
                Notificar('Recuperar Contraseña','Recuperar contraseña.','','Por favor, para recuperar la contraseña de '.$request->mail.' de click en el siguiente enlace.',[$request->mail],'<a href="https://reci-track.mx/AdminPass/'.$token.'" class="btn btn-default  btn-outline-secondary">Recuperar Contraseña</a>');
            }
            return redirect('home')->with('success','Se envió un correo con las instrucciones para recuperar su contraseña.');
        }

        

        if(Finazas::where('mail',$request->mail)->first()){
            $token=TokenGen($request->mail);
            if($token){
                Notificar('Recuperar Contraseña','Recuperar contraseña.','','Por favor, para recuperar la contraseña de '.$request->mail.' de click en el siguiente enlace.',[$request->mail],'<a href="https://reci-track.mx/AdminPass/'.$token.'" class="btn btn-default  btn-outline-secondary">Recuperar Contraseña</a>');
            }
            return redirect('home')->with('success','Se envió un correo con las instrucciones para recuperar su contraseña.');
        }

        

        if(Dosificador::where('mail',$request->mail)->first()){
            $token=TokenGen($request->mail);
            if($token){
                Notificar('Recuperar Contraseña','Recuperar contraseña.','','Por favor, para recuperar la contraseña de '.$request->mail.' de click en el siguiente enlace.',[$request->mail],'<a href="https://reci-track.mx/AdminPass/'.$token.'" class="btn btn-default  btn-outline-secondary">Recuperar Contraseña</a>');
            }
            return redirect('home')->with('success','Se envió un correo con las instrucciones para recuperar su contraseña.');
        }

        
    }
    

    function GuardarPassAdmin(Request $request,$id){
        //return $id;
        $token=Token::find($id);
        if($token){

            $pass=Director::where('mail',$token->mail)
            ->update([
                'pass' => password_hash($request->pass,PASSWORD_DEFAULT)
            ]);

            if($pass){
                 $token->delete();
                return redirect('home')->with('success','Se guardo la contraseña.');
            }

            $pass=Administrador::where('mail',$token->mail)
            ->update([
                'pass' => password_hash($request->pass,PASSWORD_DEFAULT)
            ]);

            if($pass){
                 $token->delete();
                return redirect('home')->with('success','Se guardo la contraseña.');
            }

            $pass=Vendedor::where('mail',$token->mail)
            ->update([
                'pass' => password_hash($request->pass,PASSWORD_DEFAULT)
            ]);

            if($pass){
                 $token->delete();
                return redirect('home')->with('success','Se guardo la contraseña.');
            }


            $pass=Recepcion::where('mail',$token->mail)
            ->update([
                'pass' => password_hash($request->pass,PASSWORD_DEFAULT)
            ]);

            if($pass){
                 $token->delete();
                return redirect('home')->with('success','Se guardo la contraseña.');
            }

            
            $pass=Finanza::where('mail',$token->mail)
            ->update([
                'pass' => password_hash($request->pass,PASSWORD_DEFAULT)
            ]);

            if($pass){
                 $token->delete();
                return redirect('home')->with('success','Se guardo la contraseña.');
            }

            $pass=Dosificador::where('mail',$token->mail)
            ->update([
                'pass' => password_hash($request->pass,PASSWORD_DEFAULT)
            ]);

            if($pass){
                 $token->delete();
                return redirect('home')->with('success','Se guardo la contraseña.');
            }


            return redirect('home')->with('Error','Error. No se pudo guardar la contraseña.');
           
          
        }else{
            return redirect('home')->with('Error','Error. No se encontró la petición o ya se ultilizó el link anteriormente.');
        }
    }
    //transportista 
   
    function authenticatetransportista(Request $request)
    {
        if(strlen($request->mail)==0 || strlen($request->pass)==0){
            return redirect('home')->with('error', '¡Campos vacios!');
        }
        
        $transportista = Transportista::where([
            'mail' => $request->mail
        ])->first();

        if($transportista){
            
            if(!password_verify($request->pass,$transportista->pass)){
                return redirect('home')->with('error', '¡Error de contraseña!');
            }
                
            Auth::guard('transportistas')->login($transportista);
          
            return redirect('empresas');
        }
        
        return redirect('home')->with('error', '¡Correo incorrecto!');
    }


    function Confirmacion($id){
        Cliente::where('id', '=', $id)
        ->where('confirmacion', 0)
        ->update([
            'confirmacion' => 1
        ]);
        return view('mails.confirmado');

    }

    function Confirmaciont($id){
        Transportista::where('id', '=', $id)
        ->where('confirmacion', 0)
        ->update([
            'confirmacion' => 1
        ]);
        return view('mails.confirmado');

    }

        
}
