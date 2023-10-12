<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\MaterialObra;
use App\Models\Obra;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class AlertaController extends Controller
{

    public function __construct(){
        $this->middleware('administradorlogged');
    }

    
    public function ObrasRetrasadas(Request $filtros)
    {
        $generador= $filtros->generador==null ? '' :$filtros->generador;
        $obra=$filtros->obra==null ? '' : $filtros->obra;        
        $planta= GetIdPlanta();
        
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
        $obras = DB::table('generadores')
        ->join('obras', 'obras.id_generador', '=', 'generadores.id')
        ->join('plantas','plantas.id','obras.id_planta')        
        ->select('obras.latitud','obras.longitud','obras.id','obras.obra','plantas.planta','obras.tipoobra','obras.nautorizacion','obras.deshabilitada',
        'generadores.razonsocial','obras.verificado','obras.terminada',
        'obras.vigenciaplan','obras.declaratoria','obras.planmanejo','obras.created_at','obras.aplicaplan',
        'obras.superficie','obras.fechainicio','obras.fechafin',  
        DB::raw("(SELECT unidades from materialesobra where id_obra=obras.id limit 1 ) as unidades"),
        DB::raw("(SELECT sum(cantidad) from materialesobra where id_obra=obras.id ) as declarado"),
        'obras.entregado',
        DB::raw('datediff(obras.fechafin,obras.fechainicio) as dias'),
        DB::raw('if(datediff(obras.fechafin,now())<0,0,datediff(obras.fechafin,now())) as restante'),
        'obras.status')
        ->whereraw("obras.verificado = 1 and generadores.razonsocial like '%".$generador."%' and obras.obra like '%".$obra."%' and plantas.id like '%".$planta."%' ".$status)    
        ->orderby('status','asc')
        ->get();
        //return "obras.verificado = 1 and generadores.razonsocial like '%".$generador."%' and obras.obra like '%".$obra."%' and plantas.planta like '%".$planta."%' ".$status;
        
        if(count($merged)==0){
            $merged=$obras;
        }else{
            $merged = $merged->merge($obras);
        }
        $marcadores=array();
        foreach($merged as $key=>$merg){
            

            /**
             * Aplicando filtros para los status
             */
            $temp=array();
                $temp['id']=$merg->id;    
                $temp['latitud']=$merg->latitud;
                $temp['longitud']=$merg->longitud;
                $temp['obra']=str_replace('"','',$merg->obra);  

                
                if ($merg->restante < $merg->dias){
                    if($merg->status >= -20)
                        $temp['pointer']='pointersuccess.png';
                    if($merg->status < -20 && $merg->status >= -40)
                        $temp['pointer']='pointersuccessb.png';
                    if($merg->status < -40 && $merg->status >= -60)
                        $temp['pointer']='pointerwarning.png';
                    if($merg->status < -60 && $merg->status >= -80)
                        $temp['pointer']='pointerwarningb.png';
                    if($merg->status < -80)      
                        $temp['pointer']='pointerdanger.png';
                }else {
                    $temp['pointer']='pointernegro.png';            
                }
                $marcadores[]=$temp;
        }

       
        

        $filas=10;
        $page=0;
        if(isset($_GET['page'])){
            $page=$_GET['page'];
        }
        $links = new Paginator($merged, $merged->count(), $filas, $page);
        $links->setPath('');
        $obras = $merged->forPage( $page, $filas); //Filter the page var*/
        
        //$obras = $merged;

       
        
        $marcadores=(json_encode($marcadores,true));
        //return json_decode($marcadores);
       
        return view('administracion.atrasados.obrasretrasadas',['obras'=>$obras,'filtros'=>$filtros,'marcadores'=>$marcadores,'links'=>$links]);
    }
}
