<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Pago;
use App\Models\Vendedor;
use App\Models\Planta;
use App\Models\Obra;
use App\Models\Remision;
use App\Models\Configuracion;
use App\Models\ProductoObra;
use App\Models\DetallePedido;
use Redirect;

class FormatosController extends Controller
{
    function Contrato($id_obra){
        //Redirige al archivo del contrato por que se carga el archivo
        return redirect('documentos/clientes/contratos/'.$id_obra.'.pdf');
        $obra=DB::table('obras')
        ->join('generadores','generadores.id','obras.id_generador','=','generador')
        ->where('obras.id',$id_obra)
        ->select('generadores.razonsocial as generador','obras.id','obras.calle','obras.numeroext','obras.colonia','obras.municipio','obras.cp','obras.entidad','obras.fechainicio','obras.fechafin','obras.obra','obras.obra')
        ->get();
        
        $costo=DB::table('obras')
        ->join('materialesobra','materialesobra.id_obra','=','obras.id')
        ->where('obras.id',$id_obra)
        ->where('materialesobra.cantidad','!=',0)
        //->select( DB::raw('SUM(pagos.monto) as monto'))
        ->select('obras.id',DB::raw('SUM(materialesobra.cantidad * materialesobra.precio) as costo'))
        ->groupby('obras.id')
        ->get();
        $id=$obra[0]->id;
        $generador=$obra[0]->generador;
        $total=$costo[0]->costo;
        $fechaini=$obra[0]->fechainicio;
        $fechafin=$obra[0]->fechafin;
        $direccion=$obra[0]->calle.", ".$obra[0]->numeroext.", ".$obra[0]->colonia.", ".$obra[0]->municipio.", C.P. ".$obra[0]->cp.", ".$obra[0]->entidad;

        $qrimage= public_path('images/qr/contrato/'.$id.'.png');
        \QRCode::text('reci-track.mx/contrato/'.$id)->setOutfile($qrimage)->png(); 


        /**
         * Solo html
         */
        
        return view('formatos.terminosycondiciones',['id'=>$id,'direccion'=>$direccion,
        'fechaini'=>$fechaini,'fechafin'=>$fechafin,
        'generador'=>$generador,'total'=>$total]);

        /**
         * Para pdf
         */

        $pdf = \PDF::loadView('formatos.terminosycondiciones',['id'=>$id,'direccion'=>$direccion,
        'fechaini'=>$fechaini,'fechafin'=>$fechafin,
        'generador'=>$generador,'total'=>$total]);
    
        return $pdf->setPaper('A4', 'portrait')->download($obra[0]->obra.'.pdf');
        
    }

    public function Transferencia($id){
        $pago=Pago::find($id);
        
        $configuracion=DB::table('configuraciones')
        ->where('id_planta','=',$pago->id_planta)
        ->first();
        

        return view('formatos.banco.transferencia',['pago'=>$pago,'configuracion'=>$configuracion]);
        
        $pdf = \PDF::loadView('formatos.banco.transferencia',['pago'=>$pago,'configuracion'=>$configuracion]);
    
        return $pdf->setPaper('A4', 'portrait')->download($pago->referencia.'.pdf');
    }
/*
    public function ContratoRC($id){
        $obra = Obra::find($id);
        $configuracion=Configuracion::where('id_planta',$obra->id_planta)->first();

        $generador = DB::table('obras')
        ->join('generadores','generadores.id','=','obras.id_generador')
        ->where('obras.id','=',$id)
        ->select('generadores.rfc','generadores.razonsocial','generadores.numeroactacont','generadores.fechaconst','generadores.notario','obras.obra','obras.fechainicio','obras.fechafin',
        'generadores.fisicaomoral','generadores.nombresrepre','generadores.apellidosrepre','generadores.nacionalidadfisica','generadores.nombresfisica','generadores.apellidosfisica',
        'generadores.calle','generadores.numeroint','generadores.numeroext','generadores.colonia','generadores.municipio','generadores.entidad','generadores.cp')
        ->first();        
        

        $materiales = DB::table('materialesobra')
        ->where('id_obra','=',$id)
        ->select('materialesobra.categoriamaterial','material','precio','cantidad','unidades'
        ,DB::raw("(select count(categoriamaterial) from materialesobra as mat where mat.categoriamaterial=materialesobra.categoriamaterial and mat.id_obra='".$id."' ) as filas"))
        ->orderby('categoriamaterial','asc')
        ->orderby('material','asc')
        ->get();

        $productos=DB::table('productosobras')->where('id_obra',$obra->id)->where('precio','!=',0)
        ->select('id','categoria','producto','precio',DB::raw("(select count(categoria) from productosobras as cat where cat.categoria=productosobras.categoria and cat.id_obra='".$id."' and cat.precio!=0 ) as filas"))
        ->orderby('categoria','asc')->orderby('producto','asc')->get();
        
        
        $total=DB::table('materialesobra')
        ->select(DB::raw("(select sum(cantidad*precio)+(sum(cantidad*precio)*(".$obra->ivaobra."/100)) from materialesobra where id_obra='".$id."') as total"))->first();
        $total=$total->total-($total->total*($obra->descuento/100));
        

        $qrimage= public_path('images/qr/contrato/'.$id.'.png');
        \QRCode::text('reci-track.mx/contrato/'.$id)->setOutfile($qrimage)->png(); 
        
        //return view('formatos.contratos.ContratoRC',['materiales'=>$materiales,'generador'=>$generador,'obra'=>$obra,'productos'=>$productos,'configuracion'=>$configuracion,'total'=>$total->total,'id'=>$id]);

        $pdf = \PDF::loadView('formatos.contratos.ContratoRC',['materiales'=>$materiales,'generador'=>$generador,'obra'=>$obra,'productos'=>$productos,'configuracion'=>$configuracion,'total'=>$total,'id'=>$id]);
    
        return $pdf->setPaper('A4', 'portrait')->download('Contrato_'.str_replace(' ','_',$generador->obra).'.pdf');
    }*/

    public function ContratoRC($id){
        $obra = Obra::find($id);
        $configuracion=Configuracion::where('id_planta',$obra->id_planta)->first();

        $generador = DB::table('obras')
        ->join('generadores','generadores.id','=','obras.id_generador')
        ->where('obras.id','=',$id)
        ->select('generadores.rfc','generadores.razonsocial','generadores.numeroactacont','generadores.fechaconst','generadores.notario','obras.obra','obras.fechainicio','obras.fechafin',
        'generadores.fisicaomoral','generadores.nombresrepre','generadores.apellidosrepre','generadores.nacionalidadfisica','generadores.nombresfisica','generadores.apellidosfisica',
        'generadores.calle','generadores.numeroint','generadores.numeroext','generadores.colonia','generadores.municipio','generadores.entidad','generadores.cp')
        ->first();        
        

        $materiales = DB::table('materialesobra')
        ->where('id_obra','=',$id)
        ->select('materialesobra.categoriamaterial','material','precio','cantidad','unidades'
        ,DB::raw("(select count(categoriamaterial) from materialesobra as mat where mat.categoriamaterial=materialesobra.categoriamaterial and mat.id_obra='".$id."' ) as filas"))
        ->orderby('categoriamaterial','asc')
        ->orderby('material','asc')
        ->get();

        $productos=DB::table('productosobras')->where('id_obra',$obra->id)->where('precio','!=',0)
        ->select('id','categoria','producto','precio',DB::raw("(select count(categoria) from productosobras as cat where cat.categoria=productosobras.categoria and cat.id_obra='".$id."' and cat.precio!=0 ) as filas"))
        ->orderby('categoria','asc')->orderby('producto','asc')->get();

        $transportes=DB::table('transporteobras')->where('id_obra',$obra->id)->where('precio','!=',0)
        ->select('id','transporte','precio','capacidad','cantidad')
        ->orderby('transporte','asc')->get();

        
        
        $totalm=DB::table('materialesobra')
        ->select(DB::raw("(select sum(cantidad*precio)+(sum(cantidad*precio)*(".$obra->ivaobra."/100)) from materialesobra where id_obra='".$id."') as total"))->first();
        
        $total_cantidad=DB::table('materialesobra')
        ->select(DB::raw("(select sum(cantidad) from materialesobra where id_obra='".$id."') as total_cantidad"))->first();

        if(count($transportes)){
            $viajes=round($total_cantidad->total_cantidad/$transportes[0]->capacidad);
            $totalt=$transportes[0]->precio*$viajes+($transportes[0]->precio*$viajes*($obra->ivaobra/100));
        }else{
            $viajes=0;
            $totalt=0;
        }
        
        
        $total=$totalm->total-($totalm->total*($obra->descuento/100))+$totalt;
        $total=intval($total*100)/100;

        $qrimage= public_path('images/qr/contrato/'.$id.'.png');
        \QRCode::text('reci-track.mx/contrato/'.$id)->setOutfile($qrimage)->png(); 
        
        //return view('formatos.contratos.ContratoRCT',['materiales'=>$materiales,'generador'=>$generador,'obra'=>$obra,'transportes'=>$transportes,'productos'=>$productos,'configuracion'=>$configuracion,'total'=>$total->total,'id'=>$id,'viajes'=>$viajes]);


        $pdf = \PDF::loadView('formatos.contratos.'.GetIdPlanta(),['materiales'=>$materiales,
        'generador'=>$generador,'obra'=>$obra,'transportes'=>$transportes,
        'productos'=>$productos,'configuracion'=>$configuracion,
        'total'=>$total,'id'=>$id,'viajes'=>$viajes]);

        

        
    
        return $pdf->setPaper('A4', 'portrait')->download('Contrato_'.str_replace(' ','_',$generador->obra).'.pdf');
    }
    
    public function manifiestoalcaldia($id){
        $cita = DB::table('clientes')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('obras','obras.id_generador','=','generadores.id')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('citas.id', $id)
        ->select('citas.folio','generadores.razonsocial','generadores.fisicaomoral','generadores.telefono','generadores.calle','generadores.numeroext','generadores.numeroint','generadores.colonia','generadores.municipio','generadores.cp',
        'obras.telefono as obrtelefono','obras.calle as obrcalle','obras.numeroext as obrnumeroext','obras.nautorizacion','obras.numeroint as obrnumeroint','obras.colonia as obrcolonia','obras.municipio as obrmunicipio','obras.cp as obrcp','obras.tipoobra','obras.superficie',
        'citas.id_materialobra','citas.confirmacion','citas.recibio','citas.firmachof','citas.firmarecibio','citas.cargo','citas.material','citas.nombrecompleto','citas.observacion','citas.fechacita','citas.unidades','citas.cantidad','citas.razonvehiculo','citas.direccionvehiculo','citas.telefonovehiculo','citas.ramir','citas.regsct','citas.vehiculo','citas.marcaymodelo','citas.matricula','citas.condicionesmaterial','citas.planta','citas.plantaauto','citas.direccionplanta')
        ->first();

       // return view('formatos.manifiestoalcaldias.manifiestoalcaldia',['cita'=>$cita, ]);

        $pdf = \PDF::loadView('formatos.manifiestoalcaldias.manifiestoalcaldia',['cita'=>$cita]);
        
        return $pdf ->setPaper('A4', 'portrait')->download('manifiestoalcaldia'.($cita->folio==0 ? '' : $cita->folio).'.pdf');
       
    }

    function Remision($id){
        $remision=Remision::find($id);
        $data=Planta::join('obras','obras.id_planta','=','plantas.id')
        ->join('detallepedidos','detallepedidos.id_obra','=','obras.id')
        ->select('plantas.telefono','plantas.mail','plantas.web','plantas.siglas','plantas.logo','plantas.direccion','obras.obra')
        ->where('detallepedidos.id',$remision->id_detallepedido)
        ->first();
        $detalle=DetallePedido::select(DB::RAW("(select sku from productos where id= detallepedidos.id_producto) as sku"),'producto','descripcion')->find($remision->id_detallepedido);

        //return $remision->id_vendedor;
        $vendedor=Vendedor::find($remision->id_vendedor);
        return view('formatos.ventas.remision',['vendedor'=>$vendedor,'data'=>$data,'remision'=>$remision,'detalle'=>$detalle]);
    }
}
