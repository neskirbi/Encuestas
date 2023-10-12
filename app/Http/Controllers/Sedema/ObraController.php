<?php
namespace App\Http\Controllers\Sedema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\MaterialObra;
use App\Models\Obra;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class ObraController extends Controller
{
    public function __construct(){
        $this->middleware('sedemalogged');
    }
    
    public function index(Request $filtros)
    {
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
        ->whereraw("obras.verificado = 1 and obras.deshabilitada=0  and generadores.razonsocial like '%".$generador."%' ".$finalizada." and obras.obra like '%".$obra."%'  ".$status." ".$publicaoprivada)
        ->orderby('status','asc')
        ->get();
        
        if(count($merged)==0){
            $merged=$obras;
        }else{
            $merged = $merged->merge($obras);
        }
        $marcadores=array();
        foreach($merged as $key=>$merg){
           

            /**
             * Poniendo punteros de color 
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
       
       
        return view('sedema.obras.obras',['obras'=>$obras,'filtros'=>$filtros,'marcadores'=>$marcadores,'links'=>$links]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {        

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

        return view('sedema.obras.obra',['obras'=>$obras,'materialesobra'=>$materialesobra,'acumulados'=>$acumulados]);
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
        //
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


    public function Reporte($id)
    {      

        $obra= DB::table('clientes')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('obras','obras.id_generador','=','generadores.id')      
        ->join('plantas','plantas.id','obras.id_planta') 
        ->where('obras.id',$id)
        ->select('plantas.planta','generadores.razonsocial','obras.id','obras.obra','obras.superficie','obras.superunidades','obras.tipoobra','obras.calle','obras.numeroext','obras.numeroint','obras.colonia','obras.municipio','obras.entidad','obras.fechainicio','obras.fechafin','obras.nautorizacion')
        ->orderby('obras.obra','asc')
        ->first();
        
        $materialesobra=DB::table('citas')
        ->join('materialesobra','citas.id_materialobra','=','materialesobra.id')
        ->where('citas.id_obra','=',$id)
        ->where('citas.confirmacion','=',1)
        ->select('materialesobra.id','materialesobra.material','materialesobra.cantidad as volumen','materialesobra.unidades','citas.cantidad','citas.fechacita','citas.vehiculo','citas.matricula','citas.obra','citas.material')
        ->orderby('cantidad','desc')
        ->get();

        $acumulados=DB::table('citas')
        ->join('materialesobra','citas.id_materialobra','=','materialesobra.id')
        ->where('citas.id_obra','=',$id)
        ->where('citas.confirmacion','=',1)
        ->select('materialesobra.material','materialesobra.unidades','materialesobra.cantidad as volumen',DB::raw('sum(citas.cantidad) as cantidad'),DB::raw('count(citas.cantidad) as nentregas'))
        ->groupby('materialesobra.material','volumen','materialesobra.unidades')
        ->orderby('cantidad','desc')
        ->get(); 
        /**
         * Se calcula las emiciones de CO2  7Kg por cada 1m3
         */
        $total=0;
        foreach($materialesobra as $materialobra){
            $total+=($materialobra->cantidad*1);
        }  
        $total=$total*7;      

        return view('formatos.sedema.reporte',['obra'=>$obra,'materialesobra'=>$materialesobra,'total'=>$total,'acumulados'=>$acumulados]);

        /*$pdf = \PDF::loadView('formatos.sedema.reporte',['obras'=>$obras,'materialesobra'=>$materialesobra]);

        return $pdf->setPaper('Legal', 'portrait')->download('Reporte.pdf');*/
    }

    function Informe($id){
        $obra=Obra::select('obras.id','obras.obra','obras.calle','obras.numeroext','obras.fechainicio','obras.fechafin',
        'obras.numeroint', 'obras.colonia', 'obras.cp', 'obras.municipio', 'obras.entidad',
        db::raw("(select razonsocial from generadores  where id = obras.id_generador) as razonsocial"),
        db::raw("(select concat(nombresrepre,' ',apellidosrepre,' ',nombresfisica,' ',apellidosfisica ) from generadores  where id = obras.id_generador) as repre"))
        ->where('obras.id',$id)
        ->first();
        return view('sedema.obras.createinforme',['obra'=>$obra]);
    }
}
