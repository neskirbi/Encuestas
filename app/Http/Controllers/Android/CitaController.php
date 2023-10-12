<?php

namespace App\Http\Controllers\Android;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Administrador;
use App\Models\MaterialObra;
use App\Models\Obra;
use App\Models\Configuracion;
use Redirect;
class CitaController extends Controller
{
    function BoletaQr(Request $request){
        return Cita::find($request->id);
    }
    

    public function CitaRev($id,$admin)
    {
        $admin=Administrador::find($admin);

        $cita = Cita::where('citas.id', $id)
        ->select('citas.id','citas.id_obra','citas.planta','citas.plantaauto','citas.direccionplanta','citas.fechacita','citas.nautorizacion','citas.razonsocial','citas.calleynumerofis','citas.coloniafis','citas.municipiofis','citas.cpfis','citas.obra','citas.calleynumeroobr','citas.coloniaobr','citas.municipioobr','citas.cpobr','citas.telefono','citas.id_materialobra','citas.material','citas.unidades','citas.precio','citas.cantidad','citas.iva','citas.vehiculo','citas.marcaymodelo','citas.matricula','citas.ramir','citas.regsct','citas.razonvehiculo','citas.direccionvehiculo','citas.telefonovehiculo','citas.nombrecompleto','citas.condicionesmaterial','citas.observacion','citas.recibio','citas.cargo','citas.folio','citas.confirmacion','citas.borrado')
        ->where('obras.id_planta', $admin->id_planta)
        ->join('obras','obras.id','=','citas.id_obra')
        ->first();

        if($cita->confirmacion==1){
            return view('android.citas.citaconfirmada');
        }

        $materialesobra=MaterialObra::orderBy('material', 'asc')
        ->where('id_obra','=',$cita->id_obra)
        ->get();

        $materialobra=MaterialObra::find($cita->id_materialobra);
        //return view('formatos.cita', ['data'=>$cita]);
        
        

        $cita->fechacita=str_replace("-","/",date('Y-m-d',strtotime($cita->fechacita)));
        $cita->qr=$id.'.png';
        
        $qrimage= ('images/qr/boleta/'.$cita->qr);
        \QRCode::text('reci-track.mx/boleta/'.$id)->setOutfile($qrimage)->png(); 

        return view('android.citas.citarevA', ['cita'=>$cita,'materialobra'=>$materialobra,'materialesobra'=>$materialesobra,'admin'=>$admin]);
    
        
    }

    public function CitaConfirmacion(Request $request, $id,$admin)
    {        
        $admin=Administrador::find($admin);
        if(!$admin){
            return view('android.citas.erroradmin');
        }

        $cita=Cita::find($id);

        /**
         * Busco en los materiales de la obra para cmbiarlo, si no lo registraron se va a gregar a la obra
         */
        if($request->material!=null){
            $materialobra=DB::table('materialesobra')
            ->where('id_obra','=',$cita->id_obra)
            ->where('id_material',$request->material)->first();
        
            if($materialobra){
                /**
                 * Se actualiza el material en la cita si es que ya esta como material de obra, si no lo busca para agregarlo abajo en el else
                 */
                
                $cita->id_materialobra=$materialobra->id;
                $cita->material=$materialobra->material;
                $cita->precio=$materialobra->precio;
                
            }
        }        

        
        $cita->cantidad=$request->cantidad;
        $cita->observacion=$request->observacion;
        if(strlen($cita->recibio)==0){
            $cita->recibio=$admin->administrador;
        }
        if(strlen($cita->cargo)==0){
            $cita->cargo=$admin->cargo;
        }
        $obra=Obra::find($cita->id_obra);
        if($cita->confirmacion==0 || $cita->folio==0){
            $configuracion=Configuracion::where('id_planta','=',$obra->id_planta)->first();
            $configuracion->folio=$configuracion->folio+1;
            $cita->folio=$configuracion->folio;
            $configuracion->save();
        }
        

        $cita->confirmacion=1;
        
        
        if($cita->save()){
            return redirect('citarev/'.$id.'/'.$admin->id)->with('success', 'Cita confirmada.');
        }else{
            return redirect('citarev/'.$id.'/'.$admin->id)->with('error', 'Error al guardar.');
        }

    }
}
