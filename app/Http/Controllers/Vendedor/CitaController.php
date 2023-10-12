<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Cita;
use App\Models\MaterialObra;
use App\Models\Material;
use App\Models\Cliente;
use App\Models\Planta;
use App\Models\CondicionMaterial;
use App\Models\Configuracion;
use App\Models\Obra;
use App\Models\Administrador;
use Redirect;
class CitaController extends Controller
{

    public function __construct(){
        $this->middleware('vendedorlogged');
    }
    
    public function index(Request $filtros)
    {
        //return $filtros;
        /**
         * Demonio para verificar pasadas.
         */
       

    

        $citas = DB::table('citas')
        ->join('obras','obras.id','=','citas.id_obra')
        ->join('generadores','generadores.id','=','obras.id_generador')
        ->where('obras.id_planta','=',GetIdPlanta())
        ->where('obras.obra','like','%'.$filtros->obra.'%')        
        ->where('citas.folio','like','%'.$filtros->folio.'%')
        ->orderBy('citas.fechacita', 'desc')
        ->select('generadores.razonsocial','citas.id','citas.obra','citas.cantidad','citas.folio',
        'citas.precio',DB::raw("'Reciclaje' as tipo"),'citas.fechacita','citas.planta',
        'citas.confirmacion','citas.material as material','citas.matricula')
        ->paginate(10);


        return view('ventas.citas.citas',['citas'=>$citas,'filtros'=>$filtros]);
    }

    public function show($id)
    {
        $cita = DB::table('citas')
        ->where('id', $id)
        ->first();


        
        $obra=Obra::find($cita->id_obra);


        //Lista de precios con descuento
        $materialesobra=DB::table('materialesobra')
        ->orderBy('categoriamaterial', 'asc')
        ->orderBy('material', 'asc')
        ->where('id_obra','=',$cita->id_obra)
        ->get();

        
        //return view('formatos.cita', ['data'=>$cita]);
        for($i=0;$i<count($materialesobra);$i++){
            $materialesobra[$i]->precio=$materialesobra[$i]->precio-($materialesobra[$i]->precio*($obra->descuento/100));
        }


        //Material actual
        $materialobra=MaterialObra::find($cita->id_materialobra);
        $materialobra->precio=$materialobra->precio-($materialobra->precio*($obra->descuento/100));
        


        $cita->fechacita=str_replace("-","/",date('Y-m-d',strtotime($cita->fechacita)));
        $cita->qr=$id.'.png';
        
        $qrimage= ('images/qr/boleta/'.$cita->qr);
        \QRCode::text('reci-track.mx/boleta/'.$id)->setOutfile($qrimage)->png(); 

        return view('ventas.citas.show', ['cita'=>$cita,'materialobra'=>$materialobra,'materialesobra'=>$materialesobra]);
    
        
    }

    function update(Request $request,$id){
        $cita=Cita::find($id);
        $cita->cantidad=$request->cantidad; 
        
        if($request->material!=null){
            
            //return$cita->id_obra.' '.$request->material;
            $materialobra=DB::table('materialesobra')
            ->where('id_obra','=',$cita->id_obra)
            ->where('id',$request->material)
            ->first();
        
            if($materialobra){
                $obra=Obra::find($cita->id_obra);
                /**
                 * Se actualiza el material en la cita 
                 */
                //$materialobra->precio-($materialobra->precio*($obra->descuento/100));
                $cita->id_materialobra=$materialobra->id;
                $cita->material=$materialobra->material;
                $cita->precio=$materialobra->precio-($materialobra->precio*($obra->descuento/100));
                
            }
        }  


        if($cita->save()){
            return Redirect::back()->with('success', 'Datos guardados.');
        }else{
            return Redirect::back()->with('error', 'Error al guardar .');
        }
    }

}
