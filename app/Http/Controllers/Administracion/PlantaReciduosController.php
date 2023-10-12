<?php


namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Administrador;
use App\Models\Recolector;

use Redirect;

class PlantaReciduosController extends Controller
{
    function index(){
        $planta = DB::table('plantas')
        ->where('id',Auth::guard('administradores')->user()->id_planta)
        ->first();

        $administradores=DB::table('administradores')
        ->where('id_planta',$planta->id)
        ->orderby('created_at','asc')
        ->get();

     
        return view('administracion.plantars.plantars',['planta'=>$planta,'administradores'=>$administradores]);
        
    }

    function show($id){
        $planta = DB::table('plantas')
        ->select('id','planta','direccion','plantaauto')
        ->where('id',$id)
        ->first();

        $recolectores=DB::table('recolectores')
        ->where('id_planta',$planta->id)
        ->orderby('administrador','asc')
        ->get();

        return view('administracion.plantas.planta',['planta'=>$planta,'recolectores'=>$recolectores]);
    }

   
}
