<?php

namespace App\Http\Controllers\Dependencias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\MaterialObra;
use App\Models\Obra;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class ObraController extends Controller
{
    public function index(Request $filtros)
    {
        $generador= $filtros->generador==null ? '' :$filtros->generador;
        $obra=$filtros->obra==null ? '' : $filtros->obra;
        $planta= $filtros->planta==null ? '' :$filtros->planta;
        
        $conections=config('database.connections');
        $obrasarray=array();
        $merged=array();
        foreach($conections as $conection){
            if(VerificarConexion($conection['name'])){
                continue;
            }
            $obras = DB::connection($conection['name'])->table('generadores')
            ->join('obras', 'obras.id_generador', '=', 'generadores.id')
            ->join('plantas','plantas.id','obras.id_planta')        
            ->select('obras.latitud','obras.longitud','obras.id','obras.obra','plantas.planta','obras.tipoobra','obras.nautorizacion',
            'generadores.razonsocial','obras.verificado','obras.nautorizacion',
            'obras.vigenciaplan','obras.declaratoria','obras.planmanejo','obras.created_at','obras.aplicaplan',
            'obras.superficie','obras.fechainicio','obras.fechafin',  
            DB::raw("(SELECT unidades from materialesobra where id_obra=obras.id limit 1 ) as unidades"),
            DB::raw("(SELECT sum(cantidad) from materialesobra where id_obra=obras.id ) as declarado"),
            DB::raw('(SELECT if(isnull(SUM(cantidad)),0,SUM(cantidad)) FROM citas WHERE id_obra = obras.id and confirmacion=1) as entregado'),
            DB::raw('datediff(obras.fechafin,obras.fechainicio) as dias'),
            DB::raw('if(datediff(obras.fechafin,now())<0,0,datediff(obras.fechafin,now())) as restante'),
            DB::raw("(((SELECT if(isnull(SUM(cantidad)),0,SUM(cantidad)) FROM citas WHERE id_obra = obras.id and confirmacion=1)/(SELECT sum(cantidad) from materialesobra where id_obra=obras.id )*100)-(100-(if(datediff(obras.fechafin,now())<0,0,datediff(obras.fechafin,now()))/datediff(obras.fechafin,obras.fechainicio)*100))) as status"),
            DB::raw("'".$conection['name']."' as con"))
            ->where('obras.verificado',1)
            ->where('generadores.razonsocial','like','%'.$generador.'%')
            ->where('obras.obra','like','%'.$obra.'%')   
            ->where('obras.deshabilitada',0)    
            ->whereraw("obras.municipio = (select municipio from municipios where id='".Auth::guard('dependencias')->user()->id_municipio."')")         
            ->where('plantas.planta','like','%'.$planta.'%')
            ->orderby('status','asc')
            ->get();
            if(count($merged)==0){
                $merged=$obras;
            }else{
                $merged = $merged->merge($obras);
            }
        }
        $merged = $merged->sortBy('status');
        $obrastodas=$merged;
        /**
         * Aplicando filtros para los status
         */
        if(isset($_GET['exelente']) || isset($_GET['correcto']) || isset($_GET['patrasado']) || isset($_GET['atrasado']) || isset($_GET['matrasado'])){
            $bandera=true;
            foreach($merged as $key=>$merg){
                if(isset($_GET['exelente']) && $_GET['exelente']=='on'){
                    if($merg->status >= -20){
                        $bandera=false;
                    }
                }
                if(isset($_GET['correcto']) && $_GET['correcto']=='on'){
                    if($merg->status < -20 && $merg->status >= -40){
                       $bandera=false;
                    }
                }
                if(isset($_GET['patrasado']) && $_GET['patrasado']=='on'){
                    if($merg->status < -40 && $merg->status >= -60){
                        $bandera=false;
                    }
                }

                if(isset($_GET['atrasado']) && $_GET['atrasado']=='on'){
                    if($merg->status < -60 && $merg->status >= -80){
                        $bandera=false;
                    }
                }

                if(isset($_GET['matrasado']) && $_GET['matrasado']=='on'){
                    if($merg->status < -80){
                        $bandera=false;
                    }
                }

                if($bandera){
                    unset($merged[$key]);                    
                }
                $bandera=true;
            }
        }
       
        $page=0;
        $filas=10;
        if(isset($_GET['page'])){
            $page=$_GET['page'];
        }
        $links = new Paginator($merged, $merged->count(), $filas, $page);
        $links->setPath('');
        $obras = $merged->forPage( $page, $filas); //Filter the page var


        /**
         * $obrastodas saca los marcadores de todad y para mostrar ubicaciones por pagina en el mapa cambiar por $obras
         */
        $marcadores=array();
        foreach($obrastodas as $obra){
            $temp=array();
            $temp['id']=$obra->id;            
            $temp['con']=$obra->con;
            $temp['latitud']=$obra->latitud;
            $temp['longitud']=$obra->longitud;
            $temp['obra']=str_replace('"','',$obra->obra);  

            
            if ($obra->restante < $obra->dias){
                if($obra->status >= -20)
                    $temp['pointer']='pointersuccess.png';
                if($obra->status < -20 && $obra->status >= -40)
                    $temp['pointer']='pointersuccessb.png';
                if($obra->status < -40 && $obra->status >= -60)
                    $temp['pointer']='pointerwarning.png';
                if($obra->status < -60 && $obra->status >= -80)
                    $temp['pointer']='pointerwarningb.png';
                if($obra->status < -80)      
                    $temp['pointer']='pointerdanger.png';
            } else {
                    $temp['pointer']='pointernegro.png';
            
            }
            $marcadores[]=$temp;
            
            
            
        }
        $marcadores=(json_encode($marcadores,true));
        //return json_decode($marcadores);
       
        return view('dependencias.obras.obras',['obras'=>$obras,'links'=>$links,'filtros'=>$filtros,'marcadores'=>$marcadores]);
    }

    function show($id){
        $obras= DB::table('clientes')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('obras','obras.id_generador','=','generadores.id')        
        ->join('plantas','plantas.id','obras.id_planta') 
        ->where('obras.id',$id)
        ->select('generadores.id as id_generador','plantas.planta','generadores.razonsocial','obras.id','obras.obra','obras.superficie','obras.superunidades',
        'obras.tipoobra','obras.calle','obras.numeroext','obras.numeroint','obras.colonia','obras.municipio',
        'obras.entidad','obras.fechainicio','obras.fechafin','obras.nautorizacion')
        ->orderby('obras.obra','asc')
        ->get();
        
        $materialesobra=DB::table('citas')
        ->join('materialesobra','citas.id_materialobra','=','materialesobra.id')
        ->where('citas.id_obra','=',$id)
        ->where('citas.confirmacion','=',1)
        ->select('citas.id as id_cita','materialesobra.material','materialesobra.cantidad as volumen','materialesobra.unidades',
        'citas.cantidad','citas.fechacita')        
        ->orderby('fechacita','desc')
        ->get();    
        
        $acumulados=DB::table('materialesobra')
        ->leftjoin('citas','citas.id_materialobra','=','materialesobra.id')
        ->select('materialesobra.material','materialesobra.unidades','materialesobra.cantidad as volumen',
        DB::raw('sum(citas.cantidad) as cantidad'),DB::raw('count(citas.cantidad) as nentregas'))
        ->groupby('materialesobra.material','volumen','materialesobra.unidades')
        ->orderby('cantidad','desc')
        ->where('materialesobra.id_obra','=',$id)
        ->where('citas.confirmacion','=',1)
        ->get(); 

        return view('dependencias.obras.obra',['obras'=>$obras,'materialesobra'=>$materialesobra,'acumulados'=>$acumulados]);
    }
}
