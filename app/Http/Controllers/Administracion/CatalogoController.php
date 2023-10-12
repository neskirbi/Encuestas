<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;
use App\Models\Obra;
use App\Models\MaterialObra;
use App\Models\Planta;
use App\Models\TipoObra;
use App\Models\SubtipoObra;
use App\Models\CategoriaMaterial;
use App\Models\Material;
use App\Models\CondicionMaterial;

class CatalogoController extends Controller
{
    

    public function index()
    {
        $categoriasmateriales=DB::table('categoriasmaterial')   
        ->where('id_planta','=',GetIdPlanta())     
        ->orderBy('categoriamaterial','asc')
        ->get();
        $materiales=DB::table('materiales')
        ->join('categoriasmaterial','categoriasmaterial.id','=','materiales.id_categoriamaterial')
        ->where('id_planta','=',GetIdPlanta()) 
        ->orderBy('categoriasmaterial.categoriamaterial','asc')
        ->select('categoriasmaterial.categoriamaterial','materiales.id','materiales.id_categoriamaterial','materiales.material','materiales.precio')
        ->get();
        
        
        
        return view('administracion.catalogos.catalogos',['materiales'=>$materiales
        ,'categoriasmateriales'=>$categoriasmateriales]);
    }


   


    /**Guardan los catalogos desde la interface de administrador */

   

    function GuardarPlanta(Request $request){
        
        $planta=new Planta();
        $planta->id=GetUuid();
        $planta->planta=$request->planta;
        $planta->direccion=$request->direccion;
        $planta->codigo=$request->codigo;
        $planta->plantaauto=$request->plantaauto;
        if($planta->save()){
            return Redirect::back()->with('success', 'Catalogo Actualizado.');
        }else{
            return Redirect::back()->with('error', 'Error al guardar.');
        }

    }



    function GuardarTipoObra(Request $request){
        
        $tipoobra=new TipoObra();
        $tipoobra->id=GetUuid();
        $tipoobra->tipoobra=$request->tipoobra;
        if($tipoobra->save()){
            return Redirect::back()->with('success', 'Catalogo Actualizado.');
        }else{
            return Redirect::back()->with('error', 'Error al guardar.');
        }

    }

    function BorrarTipoObra($id){
       

        $tipoobra=TipoObra::find($id);        
        if($tipoobra->delete()){
            return Redirect::back()->with('success', 'Tipo Obra borrada.');
        }else{
            return Redirect::back()->with('error', 'Error al borrar.');
        }

    }

    
    function GuardarSubtipoObra(Request $request){
        

        $tipoobra=TipoObra::find($request->tipoobra);  
        if(!$tipoobra){
            return Redirect::back()->with('error', 'La opción (Tipo de Obra) no se encuentra en los catalogos.');
        }
        $subtipoobra=new SubtipoObra();
        $subtipoobra->id=GetUuid();
        $subtipoobra->id_tipoobra=$tipoobra->id;
        $subtipoobra->subtipoobra=$request->subtipoobra;
        if($subtipoobra->save()){
            return Redirect::back()->with('success', 'Catalogo Actualizado.');
        }else{
            return Redirect::back()->with('error', 'Error al guardar.');
        }

    }

    function BorrarSubtipoObra($id){
        

        $subtipoobra=SubtipoObra::find($id);        
        if($subtipoobra->delete()){
            return Redirect::back()->with('success', 'Subtipo Obra borrada.');
        }else{
            return Redirect::back()->with('error', 'Error al borrar.');
        }

    }

    
    function GuardarCategoriaMaterial(Request $request){
       
        $categoriamaterial=new CategoriaMaterial();
        $categoriamaterial->id=GetUuid();
        $categoriamaterial->id_planta=GetIdPlanta();
        $categoriamaterial->categoriamaterial=$request->categoriamaterial;
        if($categoriamaterial->save()){
            return Redirect::back()->with('success', 'Catalogo Actualizado.');
        }else{
            return Redirect::back()->with('error', 'Error al guardar.');
        }

    }

    function BorrarCategoriaMaterial($id){
        

        $materiales=Material::where('id_categoriamaterial','=',$id)->get();
        foreach($materiales as $material){
            $material=Material::find($material->id);
            $material->delete(); 
        }

        $categoriamaterial=CategoriaMaterial::find($id); 

        if($categoriamaterial->delete()){
            return Redirect::back()->with('success', 'Categoria Material borrada.');
        }else{
            return Redirect::back()->with('error', 'Error al borrar.');
        }

    }

    
    
    function GuardarCondicion(Request $request){
        
        $condicion=new CondicionMaterial();
        $condicion->id=GetUuid();
        $condicion->condicion=$request->condicion;
        if($condicion->save()){
            return Redirect::back()->with('success', 'Catalogo Actualizado.');
        }else{
            return Redirect::back()->with('error', 'Error al guardar.');
        }

    }

    function BorrarCondicion($id){
        

        $condicion=CondicionMaterial::find($id);        
        if($condicion->delete()){
            return Redirect::back()->with('success', 'Condición borrada.');
        }else{
            return Redirect::back()->with('error', 'Error al borrar.');
        }

    }


    function GuardarAgregado(Request $request){
        $agregado=new Agregado();
        $agregado->id=GetUuid();
        $agregado->agregado=$request->agregado;
        $agregado->precio=$request->precio;
        $agregado->descripcion=$request->descripcion;
        if($agregado->save()){
            return redirect('catalogos')->with('success', 'Se guardó el agregado.');
        }else{
            return redirect('catalogos')->with('error', 'Error el guardar el agregado.');
        }
    }
    

    function GuardarCategoriaProducto(Request $request){
        
        $categoria=new CategoriaProducto();
        $categoria->id=GetUuid();
        $categoria->categoriaproducto=$request->categoriaproducto;
        if($categoria->save()){
            return Redirect::back()->with('success', 'Catalogo Actualizado.');
        }else{
            return Redirect::back()->with('error', 'Error al guardar.');
        }
    }
    function GuardarProductoServicio(Request $request){
        
        $categoria=CategoriaProducto::find($request->categoriaproducto);
        if(!$categoria){
            return Redirect::back()->with('error', 'La opción (Categoría Material) no se encuentra en los catalogos.');
        }

        $producto=new ProductoServicio();
        $producto->id=GetUuid();
        $producto->id_categoriaproducto=$categoria->id;
        $producto->productoservicio=$request->productoservicio;        
        $producto->precio=$request->precio;
        $producto->detalle=$request->detalle;

        if($producto->save()){
            return Redirect::back()->with('success', 'Producto guardado.');
        }else{
            return Redirect::back()->with('error', 'Error al guardar.');
        }
    }
}
