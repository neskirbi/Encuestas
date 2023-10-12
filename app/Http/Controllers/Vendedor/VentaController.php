<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Obra;
use App\Models\Residente;
use App\Models\Remision;
use App\Models\DetallePedido;
use App\Models\Configuracion;
use Illuminate\Support\Facades\DB;
use Auth;
use Redirect;

class VentaController extends Controller
{

    public function __construct(){
        $this->middleware('vendedorlogged');
    }

    public function index(Request $request)
    {

        $ventas = DB::table('obras')            
        ->join('pedidos', 'pedidos.id_obra', '=', 'obras.id')
        ->select('pedidos.id','pedidos.obra','pedidos.subtotal', 'pedidos.id_obra', 'pedidos.referencia','pedidos.folio',
        'pedidos.total','pedidos.created_at','pedidos.confirmacion',
        'pedidos.created_at','pedidos.fechaentrega',db::raw(" '' as detalle " ),
        DB::raw("(select concat(obras.calle,' ',obras.numeroext,' ',obras.numeroint,' Col.',obras.colonia,' CP.',obras.cp,' ',obras.municipio,' ',obras.entidad) from obras where id=pedidos.id_obra)  as obra_domicilio"))
        ->where('pedidos.id_planta',GetIdPlanta())
        ->where('obras.obra','like','%'.$request->obra.'%')
        ->orderby('created_at','desc')    
        ->paginate(10);

        for($i=0;count($ventas) > $i ; $i++){
            $ventas[$i]->detalle=DetallePedido::select('detallepedidos.id','detallepedidos.id_producto','detallepedidos.id_transporte','detallepedidos.producto','detallepedidos.precio','detallepedidos.cantidad','detallepedidos.unidades',
            DB::raw("concat('/images/productos/',detallepedidos.id_producto,detallepedidos.id_transporte,'0.jpg') as portada"))
            ->where('id_pedido',$ventas[$i]->id)->get();
        }


        
        //$ventas=Pedido::where('id_planta',Auth::guard('vendedores')->user()->id_planta)->orderby('created_at','desc')->paginate(10);
        
        return view('ventas.ventas.ventas',['ventas'=>$ventas,'request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $obras=Obra::where('id_planta',GetIdPlanta())->select('id','obra')->orderby('obra','asc')->get();
        return view('ventas.ventas.catalogo',['obras'=>$obras]);
        
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

        
        $productos = DetallePedido::select('detallepedidos.id','detallepedidos.id_producto',
        'detallepedidos.id_transporte','detallepedidos.producto','detallepedidos.descripcion','detallepedidos.precio',
        'detallepedidos.cantidad','detallepedidos.unidades','detallepedidos.carrito',db::raw(" '' as remisiones " ),
        DB::raw("detallepedidos.cantidad - (SELECT if(count(id)=0,0,sum(pedidos)) from remisiones where id_detallepedido = detallepedidos.id) as restantes"),
        DB::raw("(SELECT count(id) from remisiones where id_detallepedido = detallepedidos.id) as orden"),
        DB::raw('(SELECT foto from productofotos where orden=0 and (id_producto=detallepedidos.id_producto or id_producto=detallepedidos.id_transporte)) as portada'))
        ->where('id_pedido',$id)->get();


        for($i=0;count($productos) > $i ; $i++){
            $productos[$i]->remisiones=Remision::where('id_detallepedido',$productos[$i]->id)->orderby('orden','asc')->get();
        }
        
        
        $transportes=array();
        $pedido = DB::table('pedidos')  
        ->where('pedidos.id',$id)
        ->first();

        $obra=Obra::find($pedido->id_obra);


        return view('ventas.ventas.venta',['obra'=>$obra,'pedido'=>$pedido,'productos'=>$productos,'transportes'=>$transportes]);
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

    function GuardarPedido(Request $request,$id){
        $pedido=Pedido::find($id);
        
        $pedido->comentario=$request->comentario;
        if($pedido->save()){
            return redirect('ventas/'.$id)->with('success','Datos guardados correctamente.');
        }else{
            return redirect('ventas/'.$id)->with('error','Error al guardar.');
        }
    }

    function RechazarPedido(Request $request,$id){
        $pedido=Pedido::find($id);
        $pedido->confirmacion=0;
        $pedido->comentario=$request->comentario;
        if($pedido->save()){
            Historial('pedidos',$pedido->id,Auth::guard('vendedores')->user()->id,'Rechazó el pedido','Monto: '.$pedido->total);
            return redirect('ventas/'.$id)->with('success','Pedido aceptado.');
        }else{
            return redirect('ventas/'.$id)->with('error','Error al guardar.');
        }
    }
    function AceptarPedido(Request $request,$id){
        if(!TienePago($id)){
            //return Redirect::back()->with('error','El cliente tiene que generar la transferencia.');
        }
        $pedido=Pedido::find($id);
        $pedido->id_vendedor=GetId();
        $pedido->confirmacion=2;
        $pedido->comentario=$request->comentario;
        if($pedido->save()){
            Historial('pedidos',$pedido->id,Auth::guard('vendedores')->user()->id,'Aceptó el pedido','Monto: '.$pedido->total);
            return redirect('ventas/'.$id)->with('success','Pedido rechazado.');
        }else{
            return redirect('ventas/'.$id)->with('error','Error al guardar.');
        }
    }
 


    function Carritov($id){
        
        

        $productos = DetallePedido::select('detallepedidos.id','detallepedidos.id_producto',
        'detallepedidos.id_transporte','detallepedidos.producto','detallepedidos.precio','detallepedidos.cantidad','detallepedidos.unidades',
            DB::raw("concat('/images/productos/',detallepedidos.id_producto,detallepedidos.id_transporte,'0.jpg') as portada"))
            ->where('carrito',1)
            ->where('id_obra',$id)
            ->get();
        
      
            
        $transportes=array();

        $pedido = DB::table('detallepedidos')
        ->join('obras','obras.id','=','detallepedidos.id_obra')
        ->select('obras.id_planta','obras.id as id_obra')
        ->where('carrito',1)
        ->where('id_obra',$id)
        ->first();

        /**
         * Pone un iva en 0 por si no hay nada en el carrito
         */
        $configuraciones=json_decode('{"iva":0}');
        if($pedido){
            $configuraciones=Configuracion::where('id_planta',$pedido->id_planta)->first();
        }
        $obra=Obra::find($id);
        
        

       
        return view('ventas.ventas.carrito',['obra'=>$obra,
        'productos'=>$productos,
        'transportes'=>$transportes,
        'iva'=>$configuraciones->iva]);
    }


    
}
