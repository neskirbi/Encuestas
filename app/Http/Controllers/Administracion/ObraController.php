<?php

namespace App\Http\Controllers\Administracion;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Obra;
use App\Models\TipoObra;
use App\Models\Generador;
use App\Models\Cliente;
use App\Models\Chofer;
use App\Models\CategoriaMaterial;
use App\Models\Material;
use App\Models\MaterialObra;
use App\Models\Planta;
use App\Models\Entidad;
use App\Models\Productos;
use App\Models\Uia;
use App\Models\ProductoObra;
use App\Models\TransporteObra;
use Redirect;

class ObraController extends Controller
{
    public function __construct(){
        $this->middleware('administradorlogged');
    }

    
    public function index(Request $filtros)
    {
        $where="obras.id != ''";
        if(isset($filtros->publica) || isset($filtros->privada)){ 

            if(isset($filtros->publica) && !isset($filtros->privada)){
                $where="obras.publica = 1";
            }

            if(!isset($filtros->publica) && isset($filtros->privada)){
                $where="obras.publica = 0";
            }

        }
        //return $where;
        $obras = DB::table('generadores')
        ->join('obras', 'obras.id_generador', '=', 'generadores.id')
        ->where('id_planta','=',GetIdPlanta())
        ->where('obras.obra','like','%'.$filtros->obra.'%')
        ->where('generadores.razonsocial','like','%'.$filtros->generador.'%')
        ->whereraw($where)        
        ->select(DB::RAW("(SELECT concat(nombres,' ',apellidos) from clientes where id=generadores.id_cliente) as cliente "),'obras.id','obras.obra','obras.tipoobra','obras.nautorizacion','generadores.razonsocial','obras.publica',
        'obras.verificado','obras.transporte','obras.puedepospago','obras.created_at')
        ->orderby('obras.created_at','desc')
        ->paginate(10);
       
        $tipoobras=array();
        return view('administracion.obras.obras',['obras'=>$obras,'tipoobras'=>$tipoobras,'filtros'=>$filtros]);
    }

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
       
        $obra=DB::table('generadores')
        ->join('obras','obras.id_generador','=','generadores.id')
        ->where('id_planta','=',GetIdPlanta())
        ->where('obras.id',$id)
        ->select('obras.limite','obras.id_uia','obras.publica','obras.ncontrato','obras.contrato','obras.descuento','generadores.razonsocial','obras.contraramir',
        'obras.contrasindicato',
        'obras.id','obras.id_planta','obras.id_generador','obras.obra','obras.tipoobra','obras.distancia',
        'obras.subtipoobra','obras.cantidadobra','obras.calle','obras.numeroext','obras.numeroint',
        'obras.colonia','obras.municipio','obras.entidad','obras.cp','obras.latitud','obras.longitud',
        'obras.fechainicio','obras.fechafin','obras.superficie','obras.superunidades','obras.aplicaplan',
        'obras.transporte','obras.puedepospago','obras.nautorizacion','obras.vigenciaplan',
        'obras.declaratoria','obras.planmanejo','obras.contacto',
        'obras.telefono','obras.celular','obras.correo','obras.correo2','obras.verificado','obras.deshabilitada','obras.polizarc','obras.valorobra')
        ->first();

        $obra->tipoobra=json_decode($obra->tipoobra);        

        $obra->subtipoobra=json_decode($obra->subtipoobra);
        
        $tag=DB::table('tipoobras')->where('tipoobra',$obra->tipoobra)->first();

        $materiales=DB::table('obras')
        ->join('materialesobra','materialesobra.id_obra','=','obras.id')
        ->where('obras.id',$id)
        ->select('materialesobra.id_material','materialesobra.categoriamaterial','materialesobra.material','materialesobra.cantidad','materialesobra.unidades','materialesobra.precio')
        ->orderby('materialesobra.cantidad','desc')
        ->orderby('materialesobra.categoriamaterial','asc')
        ->orderby('materialesobra.material','asc')
        ->get();
        
        $productosobras=ProductoObra::where('id_obra',$id)
            ->orderby('categoria','asc')
            ->orderby('producto','asc')
            ->get();

        $productos=DB::table('productos')
            ->select('id as id_producto','categoria','producto','descripcion','precio','unidades',
            DB::raw('(select foto from productofotos where id_producto=productos.id and orden=0) as portada'))
            ->where('id_planta','=',GetIdPlanta())
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
            ->where('id_planta','=',GetIdPlanta())
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
        $entidades=Entidad::orderby('entidad','asc')->get();
        $tipoobras=TipoObra::select('tipoobra',DB::raw("group_concat(id,'::',subtipoobra SEPARATOR ';;') as subtipoobra"))->groupby('tipoobra')->get();
         
        //$categorias=CategoriaMaterial::where('id_planta','=',Auth::guard('vendedores')->user()->id_planta)->orderby('categoriamaterial','asc')->get();
        $categorias=DB::table('materiales')  
        ->select('materiales.categoria') 
        ->where('id_planta','=',GetIdPlanta())     
        ->orderBy('categoria','asc')
        ->groupby('categoria')
        ->get();
        $planta=Planta::find($obra->id_planta);        
        $plantas=Planta::all();

        if(!$obra){
            return redirect('obras')->with('error', 'No existen datos.');
        }

        $uias=Uia::all();
        $uia=Uia::find($obra->id_uia);
        



        return view('administracion.obras.obra',['obra'=>$obra,
        'materiales'=>$materiales,'poductosobra'=>$poductosobra,
        'transportesobra'=>$transportesobra,'tipoobras'=>$tipoobras,
        'entidades'=>$entidades,
        'categorias'=>$categorias,'materiales'=>$materiales,
        'planta'=>$planta,'plantas'=>$plantas,'tag'=>(isset($tag->tag) ? $tag->tag : 'Cantidad'),'uias'=>$uias,'uia'=>$uia]);
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
        
        
        $obra=Obra::find($id); 
        
        if($request->finalizacion!=null)
        if(!GuardarArchivos($request->finalizacion,'/documentos/clientes/finalizacion',$id.'.pdf')){
            return Redirect::back()->with('error', 'Error al cargar el archivo de la obra.');
        }else{
            $obra->terminada=true;
        }

        $obra->obra=$request->obra;   
        $obra->publica=$request->pp;
        $obra->ncontrato=isset($request->ncontrato) ? $request->ncontrato : '';
        $obra->nautorizacion=isset($request->nautorizacion) ? $request->nautorizacion : '';
        $obra->distancia=$request->distancia;     
        
        $obra->tipoobra=$request->tipoobra;

        $obra->subtipoobra=$request->subtipoobra;

        $obra->cantidadobra=$request->cantidadobra==null ? $obra->cantidadobra : $request->cantidadobra;
        $obra->descuento=$request->descuento;
        $obra->calle=$request->calle;
        $obra->numeroext=$request->numeroext;
        $obra->numeroint=$request->numeroint;
        $obra->colonia=$request->colonia;
        $obra->municipio=$request->municipio;
        $obra->entidad=$request->entidad;
        $obra->cp=$request->cp;
        $obra->latitud=$request->latitud;
        $obra->longitud=$request->longitud;
        $obra->fechainicio=$request->fechainicio;
        $obra->fechafin=$request->fechafin;
        
        $obra->contacto=$request->contacto;
        $obra->telefono=$request->telefono;
        $obra->celular=$request->celular;
        $obra->correo=$request->correo;
        $obra->correo2=$request->correo2;

        

        if($request->aplicaplan=='on'){
            $obra->aplicaplan=true;
        }else{
            $obra->aplicaplan=false;
        }
        
        
        if($request->transporte=='on'){
            $obra->transporte=true;
        }else{
            $obra->transporte=false;
        }

        if($request->contraramir=='on'){
            $obra->contraramir=true;
        }else{
            $obra->contraramir=false;
        }

        if($request->contrasindicato=='on'){
            $obra->contrasindicato=true;
        }else{
            $obra->contrasindicato=false;
        }

        if($request->puedepospago=='on'){
            $obra->puedepospago=true;
        }else{
            $obra->puedepospago=false;
        }

        
        if($request->polizarc=='on'){
            $obra->polizarc=true;
        }else{
            $obra->polizarc=false;
        }

        $obra->valorobra=isset($request->valorobra) ? $request->valorobra : 0;

        $obra->limite=$request->limite;

        $obra->superficie=isset($request->superficie) ? $request->superficie : 0;
        $obra->superunidades=$request->superunidades;
        $acumulado="";

        /**
         * Aqui se guardan los materiales agregados o se actializa si ya estaba 
         */

        //$this->MaterialesCero($id);
        $this->MaterialesNuevos($id);

         /**
          * Cargar los valores de la obra para cada material
          */
        if($request->material!=null){
            foreach($request->material as $index => $mate){           
                
                $mimaterial=MaterialObra::where('id_material',$mate)->where('id_obra',$id)->first();
                if($mimaterial){
                    $mimaterial->cantidad=$request->cantidad[$index];
                    $mimaterial->precio=$request->precio[$index];
                    $mimaterial->unidades=$request->superunidades;
                    if(!$mimaterial->save()){
                        return Redirect::back()->with('error', 'Error al guardar los materiales.');
                    }
                }else{
                    return$mate;
                }
                

                
            }
        }

        /**
         * Aqui se agrega los productos o se actualizan si ya estan
         */

         
        $this->ProductosNuevos($id);

        foreach($request->productos as  $i=>$producto){           
            
            $productoobra=ProductoObra::where('id_producto',$producto)->where('id_obra',$id)->first();
            $productoobra->precio=$request->preciop[$i];
            $productoobra->save();

            
        }


       

        /**
         * Aqui se agrega los trasportes o se actualizan si ya estan
         */
        if($request->transportes!=null){
            foreach($request->transportes as  $i=>$transporte){
                $transporteobra=TransporteObra::where('id_transporte',$transporte)->where('id_obra',$id)->first();
                if($transporteobra){
                    $transporteobra->precio=$request->preciot[$i];                
                    $transporteobra->cantidad=$request->cantidadt[$i];
                    $transporteobra->save();
                }else{
                    $transporteobra=new TransporteObra();
                    $transporteobra->id=GetUuid();
                    
                    $transporte=DB::table('transportes')
                        ->where('id','=',$transporte)
                        ->first();
                        
                    $transporteobra->id_obra=$id;
                    $transporteobra->id_transporte=$transporte->id;
                    $transporteobra->capacidad=$transporte->capacidad;
                    $transporteobra->sku=$transporte->sku;
                    $transporteobra->transporte=$transporte->transporte;
                    $transporteobra->descripcion=$transporte->descripcion;
                    $transporteobra->precio=$request->preciot[$i];                    
                    $transporteobra->cantidad=$request->cantidadt[$i];
                    $transporteobra->save();
                }
    
            }
        }
        

        

        if($obra->save()){
            $generador=Generador::find($obra->id_generador);
            $cliente=Cliente::find($generador->id_cliente);
            
            Historial('obras',$obra->id,GetId(),'Actualización de Obra','Obra: '.$obra->obra);
            return Redirect::back()->with('success', 'Datos guardados.');
        }else{
            return Redirect::back()->with('error', 'Error al guardar los datos.');
        }
        
       
    }

    function MaterialesCero($id){
        MaterialObra::where('id_obra','=',$id)
        ->update([
            'cantidad' => 0
        ]);
    }

    function MaterialesNuevos($id){
        $arreglos=DB::table('materialesobra')
        ->select('id_material')
        ->where('id_obra', '=', $id)
        ->get();
        $in=array();
        foreach($arreglos as $arreglo){
            $in[]=$arreglo->id_material;
        }

        //return$materiales=Material::whereNotIn('id', $in)->where('id_planta',GetIdPlanta())
        //->get();

        $materiales = DB::table('materiales')
            ->select('materiales.categoria','materiales.id','materiales.material','materiales.precio')
            ->where('materiales.id_planta',GetIdPlanta())
            ->whereNotIn('materiales.id', $in)
            ->get();

        foreach($materiales as $material){
            $materialesobra=new MaterialObra();
            $materialesobra->id=GetUuid();
            $materialesobra->id_obra=$id;
            $materialesobra->categoriamaterial=$material->categoria;
            $materialesobra->id_material=$material->id;
            $materialesobra->material=$material->material;
            $materialesobra->cantidad=0;
            $materialesobra->precio=$material->precio;
            $materialesobra->unidades='';
            $materialesobra->save();
            
        }
    }


 

    function ProductosNuevos($id){
        $arreglos=DB::table('productosobras')->select('id_producto')->where('id_obra', '=', $id)->get();
        $in=array();
        foreach($arreglos as $arreglo){
            $in[]=$arreglo->id_producto;
        }

        //return$materiales=Material::whereNotIn('id', $in)->where('id_planta',GetIdPlanta())
        //->get();

        $productos = DB::table('productos')
            ->where('productos.id_planta',GetIdPlanta())
            ->whereNotIn('productos.id', $in)
            ->get();

        foreach($productos as $producto){
            $productoobra=new ProductoObra();
            $productoobra->id=GetUuid();
            $productoobra->id_obra=$id;
            $productoobra->id_producto=$producto->id;
            $productoobra->categoria=$producto->categoria;
            
            $productoobra->sku=$producto->sku;
            $productoobra->producto=$producto->producto;
            $productoobra->descripcion=$producto->descripcion;
            $productoobra->precio=0;
            $productoobra->unidades=$producto->unidades;
            $productoobra->transporte=$producto->transporte;
            $productoobra->save();
            
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //
    }


    function CargarContrato(Request $request,$id){

        $contrato = $id.'.pdf';

        if(!GuardarArchivos($request->contrato,'/documentos/clientes/contratos',$contrato)){
            return Redirect::back()->with('error', 'Error al guardar el contrato de la obra.');
        }else{
            Obra::where('id',$id)
            ->update(['contrato' => 1]);
            return Redirect::back()->with('success', 'Se cargó el contrato.');
        }
    }
    function ValidarObra($id){
        $obra=Obra::find($id);
        $obra->verificado=1;
        if($obra->save()){
            $generador=Generador::find($obra->id_generador);
            $cliente=Cliente::find($generador->id_cliente);
            Notificar('Obra Confirmada','Obra Confirmada.','','Su información ha sido validada exitosamente, ya puede realizar sus citas de reciclaje.',[$cliente->mail],'<a href="https://reci-track.mx/" class="btn btn-default  btn-outline-secondary">Ir a Recitrack</a>');
            return Redirect::back()->with('success', 'Datos guardados.');
        }else{
            return Redirect::back()->with('error', 'Error al guardar los datos.');
        }
        
    }

    

    function PolizaRC($id){
        
        $obra=Obra::join('generadores','generadores.id','=','obras.id_generador')
        ->select('obras.id','obras.obra','generadores.razonsocial','generadores.nombresrepre','generadores.apellidosrepre','obras.contacto',
        'obras.telefono','obras.celular','obras.correo','obras.tipoobra','obras.valorobra','obras.id_planta','obras.fechainicio')
        ->where('obras.id',$id)
        ->first();

        $planta=Planta::find($obra->id_planta);
        return view('administracion.obras.polizarc',['planta'=>$planta,'obra'=>$obra]);
    }
}
