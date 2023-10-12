<?php

namespace App\Http\Controllers\General\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\MaterialObra;
use App\Models\Obra;

class EstimacionController extends Controller
{
    public function index(Request $filtros){
        $generador= $filtros->generador==null ? '' :$filtros->generador;
        $obra=$filtros->obra==null ? '' : $filtros->obra;
        
        $obrasarray=array();
        $merged=array();


        

        $status=" ";
        $bandera=false;
        if(isset($_GET['exelente']) || isset($_GET['correcto']) || isset($_GET['patrasado']) || isset($_GET['atrasado']) || isset($_GET['matrasado'])){

            $status="and ( ";
            if(isset($_GET['exelente']) && $_GET['exelente']=='on'){
                $status.="  (status >= -20) ";
                //if($merg->status >= -20){
                    $bandera=true;
                 
            }
            if(isset($_GET['correcto']) && $_GET['correcto']=='on'){
                if($bandera){
                    $status.=" or "; 
                }
                $status.="  (status < -20 and status >= -40)";
                //if($merg->status < -20 && $merg->status >= -40){
                    $bandera=true;
                 
            }
            if(isset($_GET['patrasado']) && $_GET['patrasado']=='on'){
                if($bandera){
                    $status.=" or "; 
                }
                $status.="  (status < -40 and status >= -60)";
                //if($merg->status < -40 && $merg->status >= -60){
                    $bandera=true;
                    
            }

            if(isset($_GET['atrasado']) && $_GET['atrasado']=='on'){
                if($bandera){
                    $status.=" or "; 
                }
                $status.="  (status < -60 and status >= -80)";
                //if($merg->status < -60 && $merg->status >= -80){
                    $bandera=true;
                   
            }

            if(isset($_GET['matrasado']) && $_GET['matrasado']=='on'){
                if($bandera){
                    $status.=" or ";  
                }
                $status.="  status < -80";
                //if($merg->status < -80){
                    $bandera=true;
                   
            }

            $status.=" )";
            
            
        }

        $publicaoprivada="  ";
        if(isset($_GET['publica']) && $_GET['publica']=='on'){
            $publicaoprivada="  and publica=1 ";
            
             
        }

        if(isset($_GET['privada']) && $_GET['privada']=='on'){
            $publicaoprivada="  and publica=0 ";
            
             
        }

        if(isset($_GET['publica']) && isset($_GET['privada'])){
            $publicaoprivada="  ";
            
             
        }


        $finalizada=' and obras.terminada=0';
        if(isset($_GET['terminada']) && $_GET['terminada']=='on'){
            $finalizada="  and terminada=1 ";
            
             
        }

        if(isset($_GET['curso']) && $_GET['curso']=='on'){
            $finalizada="  and terminada=0 ";
            
             
        }

        

        $obras = DB::table('generadores')
        ->join('obras', 'obras.id_generador', '=', 'generadores.id')
        ->join('plantas','plantas.id','obras.id_planta')        
        ->select('obras.latitud','obras.longitud','obras.id','obras.obra','plantas.planta','obras.tipoobra','obras.correo','obras.correo2',
        'obras.nautorizacion','obras.deshabilitada',
        'generadores.razonsocial','obras.verificado','obras.terminada',
        'obras.vigenciaplan','obras.declaratoria','obras.planmanejo','obras.created_at','obras.aplicaplan',
        'obras.contacto','obras.telefono','obras.celular',
        'obras.superficie','obras.fechainicio','obras.fechafin','obras.ivaobra',          
        DB::raw("(SELECT sum(cantidad*precio) from materialesobra where id_obra=obras.id ) as lana"),
        DB::raw("(SELECT sum(cantidad) from materialesobra where id_obra=obras.id ) as declarado"),
        'obras.entregado',
        DB::raw('datediff(obras.fechafin,obras.fechainicio) as dias'),
        DB::raw('if(datediff(obras.fechafin,now())<0,0,datediff(obras.fechafin,now())) as restante'),
        'obras.status')
        ->whereraw("obras.verificado = 1 and obras.deshabilitada=0 and obras.id_planta = '".GetIdPlanta()."'  
        and generadores.razonsocial like '%".$generador."%' ".$finalizada." and obras.obra like '%".$obra."%'  ".$status." ".$publicaoprivada)
        ->orderby('status','asc')
        ->get();
        
        if(count($merged)==0){
            $merged=$obras;
        }else{
            $merged = $merged->merge($obras);
        }
        

       
        
       
        $filas=20;
        $page=0;
        if(isset($_GET['page'])){
            $page=$_GET['page'];
        }
        $links = new Paginator($merged, $merged->count(), $filas, $page);
        $links->setPath('');
        $obras = $merged->forPage( $page, $filas); //Filter the page var*/
        
        //$obras = $merged;

        //return$factor=$obra->declarado == 0 ? 0 : ( $obra->lana/$obra->declarado);

       
        //return MasIva(5000,16);
        return view('GeneralAdministracion.estimaciones.estimaciones',['obras'=>$obras,'filtros'=>$filtros,'links'=>$links]);
    }


    
}
