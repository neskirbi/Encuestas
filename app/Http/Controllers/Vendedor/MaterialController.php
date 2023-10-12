<?php

namespace App\Http\Controllers\Vendedor;

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

class MaterialController extends Controller
{
    
    

    public function __construct(){
        $this->middleware('vendedorlogged');
    }

    
    public function index()
    {
        $categoriasmateriales=DB::table('materiales')  
        ->select('materiales.categoria') 
        ->where('id_planta','=',Auth::guard('vendedores')->user()->id_planta)     
        ->orderBy('categoria','asc')
        ->groupby('categoria')
        ->get();
        $materiales=DB::table('materiales')
        ->where('materiales.id_planta','=',Auth::guard('vendedores')->user()->id_planta) 
        ->orderBy('materiales.categoria','asc')         
        ->orderBy('materiales.material','asc')
        ->get();
        
        return view('ventas.catalogos.catalogos',['materiales'=>$materiales
        ,'categoriasmateriales'=>$categoriasmateriales]);
    }


    /**Guardan los catalogos desde la interface de administrador */


    function create(){
        $categoriasmateriales=DB::table('materiales')  
        ->select('materiales.categoria') 
        ->where('id_planta','=',Auth::guard('vendedores')->user()->id_planta)     
        ->orderBy('categoria','asc')
        ->groupby('categoria')
        ->get();
        return view('ventas.catalogos.create',['categoriasmateriales'=>$categoriasmateriales]);
    }

    function show($id){
        $categorias=DB::table('materiales')  
        ->select('materiales.categoria') 
        ->where('id_planta','=',Auth::guard('vendedores')->user()->id_planta)     
        ->orderBy('categoria','asc')
        ->groupby('categoria')
        ->get();
        $material=Material::find($id);
        return view('ventas.catalogos.show',['material'=>$material,'categorias'=>$categorias]);
    }

    function update(Request $request,$id){
        
        $material=Material::find($id);
        $material->categoria=isset($request->categoria) ? $request->categoria : $request->categoriatext ;
        $material->material=$request->material;
        
        $material->precio=$request->precio;
        
        if($material->save()){
            return Redirect::back()->with('success', 'Material guardado.');
        }else{
            return Redirect::back()->with('error', 'Error al guardar.');
        }
    }
    
    
    function GuardarMaterial(Request $request){
        if(!Auth::guard('vendedores')->check()){
            return Redirect::back()->with('error', 'No eres admin.');
        }
        

        $material=new Material();
        $material->id=GetUuid();
        
        $material->categoria=isset($request->categoria) ? $request->categoria : $request->categoriatext ;

        $material->material=$request->material;
        
        $material->precio=$request->precio;

        $material->id_planta=GetIdPlanta();

        if($material->save()){
            return Redirect::back()->with('success', 'Material guardado.');
        }else{
            return Redirect::back()->with('error', 'Error al guardar.');
        }

    }

    function ActualizaMaterial(Request $request,$id){
        if(!Auth::guard('vendedores')->check()){
            return Redirect::back()->with('error', 'No eres admin.');
        }
        $categoriamaterial=CategoriaMaterial::find($request->categoriamaterial);
        if(!$categoriamaterial){
            return Redirect::back()->with('error', 'La opción (Categoría Material) no se encuentra en los catalogos.');
        }

        $material= Material::find($id);
        $material->id_categoriamaterial=$categoriamaterial->id;
        $material->material=$request->material;
        
        $material->precio=$request->precio;

        if($material->save()){
            return Redirect::back()->with('success', 'Material Actualizado.')->with('warning', 'Los cambios solo se reflejan en nuevos registros.');
        }else{
            return Redirect::back()->with('error', 'Error al guardar.');
        }

    }

    function ActualizaCategoriaMaterial(Request $request,$id){
        if(!Auth::guard('vendedores')->check()){
            return Redirect::back()->with('error', 'No eres admin.');
        }
        $categoriamaterial=CategoriaMaterial::find($id);
        

        $categoriamaterial->categoriamaterial=$request->categoriamaterial;

        if($categoriamaterial->save()){
            return Redirect::back()->with('success', 'Categoria Actualizado.')->with('warning', 'Los cambios solo se reflejan en nuevos registros.');
        }else{
            return Redirect::back()->with('error', 'Error al guardar.');
        }

    }

    function BorrarMaterial($id){
        if(!Auth::guard('vendedores')->check()){
            return Redirect::back()->with('error', 'No eres admin.');
        }

        $material=Material::find($id);        
        if($material->delete()){
            return Redirect::back()->with('success', 'Material borrada.');
        }else{
            return Redirect::back()->with('error', 'Error al borrar.');
        }

    }

    
}
