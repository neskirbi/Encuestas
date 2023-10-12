<?php

namespace App\Http\Controllers\Sap;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Generador;
use App\Models\Pago;
use App\Models\Obra;
use App\Models\Cita;

class ServiciosController extends Controller
{
    function ClientesSAP(Request $request){

        $json=array('success'=>true,'message'=>"");
        if(isset($request->date_created_from) && !isset($request->date_created_to)){
            $json['data'] = Cliente::select('id','nombres','apellidos','mail','accept','pass','confirmacion','remember_token','created_at','updated_at')->whereraw("created_at >= '".$request->date_created_from."'")->get();
        }
        if(isset($request->date_created_from) && isset($request->date_created_to)){
            $json['data'] = Cliente::select('id','nombres','apellidos','mail','accept','pass','confirmacion','remember_token','created_at','updated_at')->whereraw("created_at >= '".$request->date_created_from."' and created_at <= '".$request->date_created_to."'" )->get();
        }
        if(isset($request->date_updated_from) && !isset($request->date_updated_to)){
            $json['data'] = Cliente::select('id','nombres','apellidos','mail','accept','pass','confirmacion','remember_token','created_at','updated_at')->whereraw("updated_at >= '".$request->date_updated_from."'")->get();
        }
        if( isset($request->date_updated_from) && isset($request->date_updated_to)){
            $json['data'] = Cliente::select('id','nombres','apellidos','mail','accept','pass','confirmacion','remember_token','created_at','updated_at')->whereraw("created_at >= '".$request->date_updated_from."' and created_at <= '".$request->date_updated_to."'" )->get();
        }
        if(!isset($request->date_updated_from) && !isset($request->date_updated_to) && !isset($request->date_created_from) && !isset($request->date_created_to)){
            $json['success']=false;
            $json['message']="Faltan los parametros!!";
        }

        return $json;
    }

    function GeneradoresSAP(Request $request){
        
        $json=array('success'=>true,'message'=>"");
        if(isset($request->date_created_from) && !isset($request->date_created_to)){
            $json['data'] = Generador::whereraw("created_at >= '".$request->date_created_from."'")->get();
        }
        if(isset($request->date_created_from) && isset($request->date_created_to)){
            $json['data'] = Generador::whereraw("created_at >= '".$request->date_created_from."' and created_at <= '".$request->date_created_to."'" )->get();
        }
        if(isset($request->date_updated_from) && !isset($request->date_updated_to)){
            $json['data'] = Generador::whereraw("updated_at >= '".$request->date_updated_from."'")->get();
        }
        if( isset($request->date_updated_from) && isset($request->date_updated_to)){
            $json['data'] = Generador::whereraw("created_at >= '".$request->date_updated_from."' and created_at <= '".$request->date_updated_to."'" )->get();
        }
        if(!isset($request->date_updated_from) && !isset($request->date_updated_to) && !isset($request->date_created_from) && !isset($request->date_created_to)){
            $json['success']=false;
            $json['message']="Faltan los parametros!!";
        }

        return $json;
    }


    function PagosSAP(Request $request){
        
        $json=array('success'=>true,'message'=>"");
        if(isset($request->date_created_from) && !isset($request->date_created_to)){
            $json['data'] = Pago::whereraw("created_at >= '".$request->date_created_from."'")->get();
        }
        if(isset($request->date_created_from) && isset($request->date_created_to)){
            $json['data'] = Pago::whereraw("created_at >= '".$request->date_created_from."' and created_at <= '".$request->date_created_to."'" )->get();
        }
        if(isset($request->date_updated_from) && !isset($request->date_updated_to)){
            $json['data'] = Pago::whereraw("updated_at >= '".$request->date_updated_from."'")->get();
        }
        if( isset($request->date_updated_from) && isset($request->date_updated_to)){
            $json['data'] = Pago::whereraw("created_at >= '".$request->date_updated_from."' and created_at <= '".$request->date_updated_to."'" )->get();
        }
        if(!isset($request->date_updated_from) && !isset($request->date_updated_to) && !isset($request->date_created_from) && !isset($request->date_created_to)){
            $json['success']=false;
            $json['message']="Faltan los parametros!!";
        }

        return $json;
    }

    function CitasSAP(Request $request){
        
        $json=array('success'=>true,'message'=>"");
        if(isset($request->date_created_from) && !isset($request->date_created_to)){
            $json['data'] = Cita::select('id','id_obra','planta','plantaauto','direccionplanta','fechacita','nautorizacion','razonsocial','calleynumerofis','coloniafis','municipiofis','cpfis','obra','calleynumeroobr','coloniaobr','municipioobr','cpobr','telefono','nombreres','id_materialobra','material','unidades','precio','cantidad','iva','vehiculo','marcaymodelo','matricula','ramir','regsct','razonvehiculo','direccionvehiculo','telefonovehiculo','nombrecompleto','condicionesmaterial','observacion','recibio','cargo','folio','borrado','CodigoSAP','ProcesadoSAP','created_at','updated_at')->whereraw("created_at >= '".$request->date_created_from."'")->get();
        }
        if(isset($request->date_created_from) && isset($request->date_created_to)){
            $json['data'] = Cita::select('id','id_obra','planta','plantaauto','direccionplanta','fechacita','nautorizacion','razonsocial','calleynumerofis','coloniafis','municipiofis','cpfis','obra','calleynumeroobr','coloniaobr','municipioobr','cpobr','telefono','nombreres','id_materialobra','material','unidades','precio','cantidad','iva','vehiculo','marcaymodelo','matricula','ramir','regsct','razonvehiculo','direccionvehiculo','telefonovehiculo','nombrecompleto','condicionesmaterial','observacion','recibio','cargo','folio','borrado','CodigoSAP','ProcesadoSAP','created_at','updated_at')->whereraw("created_at >= '".$request->date_created_from."' and created_at <= '".$request->date_created_to."'" )->get();
        }
        if(isset($request->date_updated_from) && !isset($request->date_updated_to)){
            $json['data'] = Cita::select('id','id_obra','planta','plantaauto','direccionplanta','fechacita','nautorizacion','razonsocial','calleynumerofis','coloniafis','municipiofis','cpfis','obra','calleynumeroobr','coloniaobr','municipioobr','cpobr','telefono','nombreres','id_materialobra','material','unidades','precio','cantidad','iva','vehiculo','marcaymodelo','matricula','ramir','regsct','razonvehiculo','direccionvehiculo','telefonovehiculo','nombrecompleto','condicionesmaterial','observacion','recibio','cargo','folio','borrado','CodigoSAP','ProcesadoSAP','created_at','updated_at')->whereraw("updated_at >= '".$request->date_updated_from."'")->get();
        }
        if( isset($request->date_updated_from) && isset($request->date_updated_to)){
            $json['data'] = Cita::select('id','id_obra','planta','plantaauto','direccionplanta','fechacita','nautorizacion','razonsocial','calleynumerofis','coloniafis','municipiofis','cpfis','obra','calleynumeroobr','coloniaobr','municipioobr','cpobr','telefono','nombreres','id_materialobra','material','unidades','precio','cantidad','iva','vehiculo','marcaymodelo','matricula','ramir','regsct','razonvehiculo','direccionvehiculo','telefonovehiculo','nombrecompleto','condicionesmaterial','observacion','recibio','cargo','folio','borrado','CodigoSAP','ProcesadoSAP','created_at','updated_at')->whereraw("created_at >= '".$request->date_updated_from."' and created_at <= '".$request->date_updated_to."'" )->get();
        }
        if(!isset($request->date_updated_from) && !isset($request->date_updated_to) && !isset($request->date_created_from) && !isset($request->date_created_to)){
            $json['success']=false;
            $json['message']="Faltan los parametros!!";
        }

        return $json;
    }


    function ObrasSAP(Request $request){
        
        $json=array('success'=>true,'message'=>"");
        if(isset($request->date_created_from) && !isset($request->date_created_to)){
            $json['data'] = Obra::whereraw("created_at >= '".$request->date_created_from."'")->get();
        }
        if(isset($request->date_created_from) && isset($request->date_created_to)){
            $json['data'] = Obra::whereraw("created_at >= '".$request->date_created_from."' and created_at <= '".$request->date_created_to."'" )->get();
        }
        if(isset($request->date_updated_from) && !isset($request->date_updated_to)){
            $json['data'] = Obra::whereraw("updated_at >= '".$request->date_updated_from."'")->get();
        }
        if( isset($request->date_updated_from) && isset($request->date_updated_to)){
            $json['data'] = Obra::whereraw("created_at >= '".$request->date_updated_from."' and created_at <= '".$request->date_updated_to."'" )->get();
        }
        if(!isset($request->date_updated_from) && !isset($request->date_updated_to) && !isset($request->date_created_from) && !isset($request->date_created_to)){
            $json['success']=false;
            $json['message']="Faltan los parametros!!";
        }

        return $json;
    }
}
