<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ProductoCategoria;
use App\Models\Producto;
use App\Models\ProductoFoto;
use Auth;
use Redirect;

class ProductoController extends Controller
{

        
    
    public function __construct(){
        $this->middleware('vendedorlogged');
    }

    function index(){
        $productos=DB::table('productos')
        ->select('id','categoria','producto','descripcion',
        DB::raw(" concat('/images/productos/',productos.id,'0.jpg') as portada"))
        ->where('id_planta','=',Auth::guard('vendedores')->user()->id_planta)
        ->orderby('categoria','asc')
        ->orderby('producto','asc')
        ->get();
        return view('ventas.productos.productos',['productos'=>$productos]);
    }

    function show($id){
        $categorias=Producto::where('id_planta',Auth::guard('vendedores')
        ->user()->id_planta)->select('categoria')
        ->groupby('categoria')->get();

        $producto=Producto::find($id);
        return view('ventas.productos.editar',['categorias'=>$categorias,'producto'=>$producto]);
    }

    function store(Request $request){
        $id=GetUuid();
        $producto=new Producto();
        $producto->id=$id;
        $producto->id_planta=Auth::guard('vendedores')->user()->id_planta;
        if($request->categoria==null){
            $producto->categoria=$request->categoriatexto;
        }else{
            $producto->categoria=$request->categoria;
        }
        
        $producto->sku=$request->sku;
        $producto->producto=$request->producto;
        $producto->descripcion=$request->descripcion;
        $producto->precio=$request->precio;
        $producto->unidades=$request->unidades;
        $producto->transporte=boolval($request->transporte);
        if($producto->save()){
            return redirect('productos')->with('success','Producto guardado.');
        }else{
            return redirect('productos')->with('error','Error al guardar el producto.');
        }
    }

    function update(Request $request,$id){
        $producto=Producto::find($id);
        
        if($request->categoria==null){
            $producto->categoria=$request->categoriatexto;
        }else{
            $producto->categoria=$request->categoria;
        }
        $producto->sku=$request->sku;
        $producto->producto=$request->producto;
        $producto->descripcion=$request->descripcion;
        $producto->precio=$request->precio;
        $producto->transporte=boolval($request->transporte);
        if($producto->save()){
            return redirect('productos/'.$id)->with('success','Producto guardado.');
        }else{
            return redirect('productos/'.$id)->with('error','Error al guardar el producto.');
        }
    }

    function destroy($id){
        $producto=Producto::find($id);
        if($producto->delete()){
            return redirect('productos')->with('success','Producto Borrado.');
        }else{
            return redirect('productos')->with('error','Error al borrar el producto.');
        }
    }

    function Agregar(){        
        $categorias=Producto::where('id_planta',Auth::guard('vendedores')
        ->user()->id_planta)->select('categoria')
        ->groupby('categoria')->get();

        return view('ventas.productos.create',['categorias'=>$categorias]);
    }

    function FotosProductos($id){
        $fotos=ProductoFoto::where('id_producto',$id)->get();
        $arrfotos=array();
        foreach($fotos as $foto){
            $arrfotos[$foto->orden]=$foto->foto;
        }     
        return view('ventas.productos.agregarfotos',['id'=>$id,'fotos'=>$arrfotos]);
    }
}
