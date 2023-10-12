<?php

namespace App\Http\Controllers\Director;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Obra;
use App\Models\TipoObra;
use App\Models\Generador;
use App\Models\Chofer;
use App\Models\CategoriaMaterial;
use App\Models\Material;
use App\Models\MaterialObra;
use App\Models\Planta;
use App\Models\ProductoObra;
use App\Models\TransporteObra;
use Redirect;

class ObraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('directores');
    }

    public function index(Request $filtros)
    {

        $where="";
        if(($filtros->puedepospago)){
            $where.=" and obras.puedepospago = 1";
        }else if(($filtros->nopuedepospago)){
            $where.=" and obras.puedepospago = 0";
        }

        if(($filtros->transporte)){
            $where.=" and obras.transporte = 1";
        }else if(($filtros->notransporte)){
            $where.=" and obras.transporte = 0";
        }

        if(($filtros->contrato)){
            $where.=" and obras.contrato = 1";
        }else if(($filtros->nocontrato)){
            $where.=" and obras.contrato = 0";
        }
        //return $where;
        

        
        $obras = DB::table('obras')
        ->whereraw("id_planta = '".GetIdPlanta()."' ". $where)
        ->orderby('obras.created_at','desc')
        ->select('obras.id','obras.obra','obras.tipoobra',
        'obras.transporte as trans','obras.puedepospago','obras.contrato',DB::raw(" 0 as materiales"),
        DB::raw(" 0 as transporte"))
        ->get();

        
        $sinfirmar=0;
        for($i=0;$i<count($obras);$i++){
            $transporte=DB::select(DB::raw("select (precio*cantidad) as transporte from transporteobras where id_obra='".$obras[$i]->id."' and cantidad>0 "));
            $material=DB::select(DB::raw("select sum(cantidad*precio) as material from materialesobra where id_obra='".$obras[$i]->id."'"));
            if(isset($transporte[0]))
            $obras[$i]->transporte=$transporte[0]->transporte;

            if(isset($material[0]))
            $obras[$i]->materiales=$material[0]->material;

        }
       // return $obras;
       
        $tipoobras=array();
        return view('directores.obras.obras',['obras'=>$obras,'tipoobras'=>$tipoobras,'filtros'=>$filtros]);
    }


    public function show($id){
        $obra=DB::table('generadores')
        ->join('obras','obras.id_generador','=','generadores.id')
        ->where('id_planta','=',Auth::guard('directores')->user()->id_planta)
        ->where('obras.id',$id)
        ->select('generadores.razonsocial','obras.id','obras.id_planta','obras.id_generador','obras.obra','obras.tipoobra','obras.subtipoobra','obras.cantidadobra','obras.calle','obras.numeroext','obras.numeroint','obras.colonia','obras.municipio','obras.entidad','obras.cp','obras.latitud','obras.longitud','obras.fechainicio','obras.fechafin','obras.superficie','obras.superunidades','obras.aplicaplan','obras.nautorizacion','obras.vigenciaplan','obras.declaratoria','obras.planmanejo','obras.telefono','obras.celular','obras.correo','obras.correo2','obras.verificado')
        ->first();
        
        $tag=DB::table('tipoobras')->where('tipoobra',$obra->tipoobra)->first();

        $materiales=DB::table('obras')
        ->join('materialesobra','materialesobra.id_obra','=','obras.id')
        ->where('obras.id',$id)
        ->where('materialesobra.cantidad','!=',0)
        ->select('materialesobra.id_material','materialesobra.categoriamaterial','materialesobra.material','materialesobra.cantidad','materialesobra.unidades','materialesobra.precio')
        ->orderby('materialesobra.categoriamaterial','asc')
        ->orderby('materialesobra.material','asc')
        ->get();
        
        $productosobras=ProductoObra::where('id_obra',$id)
            ->orderby('categoria','asc')
            ->orderby('producto','asc')
            ->get();

        $productos=DB::table('productos')
            ->select('id as id_producto','categoria','producto','descripcion','precio',
            DB::raw('(select foto from productofotos where id_producto=productos.id and orden=0) as portada'))
            ->where('id_planta','=',Auth::guard('directores')->user()->id_planta)
            ->orderby('categoria','asc')
            ->orderby('producto','asc')
            ->get();
        
        
        //Verifica si la obra ya tiene cada producto y si no se lo agrega  (ojo no quita uno existente)
        $poductosobra=array();
        foreach($productos as $producto){
            $noesta=true;
            foreach($productosobras as $productosobra){
                if($productosobra->id_producto==$producto->id_producto){
                    $productosobra->portada=$producto->portada;
                    $noesta=false;
                    break;
                }
            }
            if($noesta){
                $poductosobra[]=$producto;
            }else{
                $poductosobra[]=$productosobra;
            }
        }
        //return $poductosobra;


        
        $transportesobras=TransporteObra::where('id_obra',$id)
            ->orderby('transporte','asc')
            ->get();

        $transportes=DB::table('transportes')
            ->select('id as id_transporte','transporte','descripcion','precio',DB::raw("0 as cantidad"),
            DB::raw('(select foto from productofotos where id_producto=transportes.id and orden=0) as portada'))
            ->where('id_planta','=',Auth::guard('directores')->user()->id_planta)
            ->orderby('transporte','asc')
            ->get();
        //Verifica si la obra ya tiene cada transporte y si no se lo agrega  (ojo no quita uno existente)
        $transportesobra=array();
        foreach($transportes as $transporte){
            $noesta=true;
            foreach($transportesobras as $transporteobra){
                if($transporteobra->id_transporte==$transporte->id_transporte){
                    $transporteobra->portada=$transporte->portada;
                    $noesta=false;
                    break;
                }
            }
            if($noesta){
                $transportesobra[]=$transporte;
            }else{
                $transportesobra[]=$transporteobra;
            }
        }
        //return $transportesobra;

        $tipoobras=TipoObra::select('tipoobra','tag')->distinct()->get();
        $subtipoobras=TipoObra::all();
         
        $categorias=CategoriaMaterial::where('id_planta','=',Auth::guard('directores')->user()->id_planta)->orderby('categoriamaterial','asc')->get();
        $planta=Planta::find($obra->id_planta);        
        $plantas=Planta::all();

        if(!$obra){
            return redirect('obras')->with('error', 'No existen datos.');
        }
        return view('directores.obras.obra',['obra'=>$obra,'materiales'=>$materiales,'poductosobra'=>$poductosobra,'transportesobra'=>$transportesobra,'tipoobras'=>$tipoobras,'subtipoobras'=>$subtipoobras,
        'categorias'=>$categorias,'materiales'=>$materiales,'planta'=>$planta,'plantas'=>$plantas,'tag'=>(isset($tag->tag) ? $tag->tag : 'Cantidad')]);
    }
    
}
