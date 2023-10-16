<?php

date_default_timezone_set('America/Mexico_City');
use App\Mail\Notificaciones;
use App\Mail\Correos;

use App\Models\Director;
use App\Models\Administrador;
use App\Models\Recepcion;
use App\Models\Vendedor;
use App\Models\Uia;
use App\Models\Cliente;
use App\Models\Dosificador;
use App\Models\Sedema;
use App\Models\Finanza;
use App\Models\Transportista;
use App\Models\Token;
use App\Models\Historial;
use App\Models\Cita;
use App\Models\PagoChofer;
use App\Models\Planta;
use App\Models\Vehiculo;
use App\Models\Municipio;
use App\Models\DetallePedido;
use App\Models\Pago;
use App\Models\Pedido;
use App\Models\Inspector;
use App\Models\Remision;
use App\Models\Logueo;
use App\Models\Orden;
use App\Models\Configuracion;
use App\Models\Relacion;
use Kreait\Firebase\Factory;
use Twilio\Rest\Client;
use App\Models\Solicitud;

use Illuminate\Pagination\LengthAwarePaginator as Paginator;

function Memoria(){
    set_time_limit(0);
    ini_set('memory_limit', '-1');
    ini_set('max_execution_time', 0); 
    ini_set('post_max_size', '30G');
}

function Version(){
    return 236;
}



function GetCabecera(){
    if(Auth::guard('directores')->check()){
        return('directores.header');
    }  
    
    if(Auth::guard('administradores')->check()){
        return('administracion.header');
    }  
    
    if(Auth::guard('finanzas')->check()){
        return('finanzas.header');
    }
    
    if(Auth::guard('vendedores')->check()){
        return('ventas.header');
    } 
    
    if(Auth::guard('dosificadores')->check()){
        return('dosificadores.header');
    } 
    
    if(Auth::guard('recepciones')->check()){
        return('recepcion.header');
    }  

    if(Auth::guard('soportes')->check()){
        return('soportes.header');
    }
    
}

function GetNavigation(){
    if(Auth::guard('directores')->check()){
        return('directores.navigations.navigation');
    }  
    
    if(Auth::guard('administradores')->check()){
        return('administracion.navigations.navigation');
    }  
    
    if(Auth::guard('finanzas')->check()){
        return('finanzas.navigations.navigation');
    }
    
    if(Auth::guard('vendedores')->check()){
        return('ventas.navigations.navigation');
    }  
    
    if(Auth::guard('dosificadores')->check()){
        return('dosificadores.navigations.navigation');
    }  
    
    if(Auth::guard('recepciones')->check()){
        return('recepcion.navigations.navigation');
    }  

    if(Auth::guard('soportes')->check()){
        return('soportes.navigations.navigation');
    }  

    
}


function GetSideBar(){
    if(Auth::guard('directores')->check()){
        return('directores.sidebars.sidebar');
    }  
    
    if(Auth::guard('administradores')->check()){
        return('administracion.sidebars.sidebar');
    }  
    
    if(Auth::guard('finanzas')->check()){
        return('finanzas.sidebars.sidebar');
    }
    
    if(Auth::guard('vendedores')->check()){
        return('ventas.sidebars.sidebar');
    }        
    
    if(Auth::guard('dosificadores')->check()){
        return('dosificadores.sidebars.sidebar');
    }        
    
    if(Auth::guard('recepciones')->check()){
        return('recepcion.sidebars.sidebar');
    } 

    if(Auth::guard('soportes')->check()){
        return('soportes.sidebars.sidebar');
    }  

    
}




function MasIva($cantidad,$iva){
    $total=array('subtotal'=>0,'total'=>0);

    return $cantidad+($cantidad*($iva/100));
}



function GetSolicitudes(){
    return Solicitud::where('id_planta',GetIdPlanta())->where('status',1)->count();
}

function GetCitasaEnViaje(){
    return  DB::table('citas')
    ->where('citas.id_planta','=',GetIdPlanta())
            ->where('citas.confirmacion',3)
                ->count();
}




function GetId(){
    
    if(Auth::guard('directores')->check()){
        return Auth::guard('directores')->user()->id;
    }  
    
    if(Auth::guard('administradores')->check()){
        return Auth::guard('administradores')->user()->id;
    }  

    if(Auth::guard('uias')->check()){
        return Auth::guard('uias')->user()->id;
    } 

    if(Auth::guard('inspectores')->check()){
        return Auth::guard('inspectores')->user()->id;
    } 
    
}

function ValidarMail($mail){
    
    if(Director::where('mail',$mail)->first()){
        return true;
    }
    
    if(Administrador::where('mail',$mail)->first()){
        return true;
    }
    
    if(Uia::where('mail',$mail)->first()){
        return true;
    }
    
    if(Inspector::where('mail',$mail)->first()){
        return true;
    }
    
    return false;
}


function CambiaPlanta($request){
    
    if(Auth::guard('directores')->check()){
        $director=Director::find(GetId());
        $director->id_planta=$request->planta;
        $director->save();
    }  
    
    if(Auth::guard('administradores')->check()){
        $admin=Administrador::find(GetId());
        $admin->id_planta=$request->planta;
        $admin->save();
    }  

    if(Auth::guard('recepciones')->check()){
        $recepcion=Recepcion::find(GetId());
        $recepcion->id_planta=$request->planta;
        $recepcion->save();
    }  

    if(Auth::guard('vendedores')->check()){
        $admin=Vendedor::find(GetId());
        $admin->id_planta=$request->planta;
        $admin->save();
    }  
    
    if(Auth::guard('finanzas')->check()){
        $finanza=Finanza::find(GetId());
        $finanza->id_planta=$request->planta;
        $finanza->save();
    }      

    if(Auth::guard('clientes')->check()){
        
    }  
    
    if(Auth::guard('dosificadores')->check()){
        
    } 
}

function GetIdPlanta(){
    
    if(Auth::guard('directores')->check()){
        return Auth::guard('directores')->user()->id_planta;
    }  
    
    if(Auth::guard('administradores')->check()){
        return Auth::guard('administradores')->user()->id_planta;
    }  
    
    if(Auth::guard('finanzas')->check()){
        return Auth::guard('finanzas')->user()->id_planta;
    }  

    
    if(Auth::guard('vendedores')->check()){
        return Auth::guard('vendedores')->user()->id_planta;
    }   

    if(Auth::guard('recepciones')->check()){
        return Auth::guard('recepciones')->user()->id_planta;
    }      

    if(Auth::guard('dosificadores')->check()){
        return Auth::guard('dosificadores')->user()->id_planta;
    }   
}

function GetNombre(){
    
    if(Auth::guard('directores')->check()){
        return Auth::guard('directores')->user()->director;
    }  
    
    if(Auth::guard('administradores')->check()){
        return Auth::guard('administradores')->user()->administrador;
    }  
    
    if(Auth::guard('finanzas')->check()){
        return Auth::guard('finanzas')->user()->nombre;
    }  

    
    if(Auth::guard('vendedores')->check()){
        return Auth::guard('vendedores')->user()->vendedor;
    }   

    if(Auth::guard('clientes')->check()){
        return Auth::guard('clientes')->user()->nombres;
    }  

    if(Auth::guard('recepciones')->check()){
        return Auth::guard('recepciones')->user()->nombre;
    } 
    
    if(Auth::guard('dependencias')->check()){
        return Auth::guard('dependencias')->user()->nombre;
    }   
    
    if(Auth::guard('dosificadores')->check()){
        return Auth::guard('dosificadores')->user()->dosificador;
    }   
    
    if(Auth::guard('publicidades')->check()){
        return Auth::guard('publicidades')->user()->nombre;
    }   
    
    if(Auth::guard('uias')->check()){
        return Auth::guard('uias')->user()->nombre;
    }     
    
    if(Auth::guard('inspectores')->check()){
        return Auth::guard('inspectores')->user()->inspector;
    }  

    
}

function GetSaldosPorObras($filtros){
    $clientessaldos=array();
    $saldo="";
        if(boolval($filtros->correcto)){
            $saldo="where (pagos-(tot.reciclaje+tot.pedidos))>0";
        }

        if(boolval($filtros->atrasado)){
            $saldo="where (pagos-(tot.reciclaje+tot.pedidos))<0";
        }



        $clientegastos=DB::select("
            select id,obra,reciclaje,pedidos,pagos,(pagos-(tot.reciclaje+tot.pedidos)) as saldo,condonado from  (select obr.id,obr.obra,
            ifnull(sum((cit.cantidad*cit.precio)+(cit.cantidad*cit.precio*(cit.iva/100))),0) as reciclaje,
            ifnull((select sum(total) from pedidos where id_obra =obr.id  and confirmacion=2),0) as pedidos,
            ifnull((SELECT sum(monto) from pagos where status=2 and id_obra=obr.id  ),0) as pagos,
            ifnull((SELECT sum(monto) from condonaciones where id_obra=obr.id  ),0) as condonado
            from  obras as obr  
            left join citas as cit on cit.id_obra=obr.id and cit.confirmacion!=2
            where obr.id_planta='".GetIdPlanta()."' and obr.obra like '%".$filtros->obra."%'
            GROUP by obr.id,obr.obra
            order by obr.obra asc) as tot ".$saldo.";
        ");

        
        $merged = collect($clientegastos);
        $filas=15;
        $page=0;
        if(isset($_GET['page'])){
            $page=$_GET['page'];
        }
        $links = new Paginator($merged, $merged->count(), $filas, $page);
        $links->setPath('');
        $clientegastos = $merged->forPage( $page, $filas); //Filter the page var*/
        $clientessaldos['saldos'] = $clientegastos;
        $clientessaldos['links'] = $links;
        return $clientessaldos;
}

function GetSaldosPorCliente($filtros){
    $clientessaldos=array();
    $saldo="";
        if(boolval($filtros->correcto)){
            $saldo="where (pagos-(tot.reciclaje+tot.pedidos))>0";
        }

        if(boolval($filtros->atrasado)){
            $saldo="where (pagos-(tot.reciclaje+tot.pedidos))<0";
        }



        $clientegastos=DB::select("
        select id,razonsocial,reciclaje,pedidos,pagos,(pagos-(tot.reciclaje+tot.pedidos)) as saldo,condonado from  (select gen.id,gen.razonsocial,
        ifnull(sum((cit.cantidad*cit.precio)+(cit.cantidad*cit.precio*(cit.iva/100))),0) as reciclaje,
        ifnull((select sum(total) from pedidos where id_obra in (select id from obras where id_generador = gen.id and id_planta='".GetIdPlanta()."') and confirmacion=2 ),0) as pedidos,
        ifnull((SELECT sum(monto) from pagos where status=2 and id_obra in (select id from obras where id_generador = gen.id and id_planta='".GetIdPlanta()."')),0) as pagos,
        ifnull((SELECT sum(monto) from condonaciones where id_obra in (select id from obras where id_generador = gen.id and id_planta='".GetIdPlanta()."')),0) as condonado
        from  generadores as gen  
        join obras as obr on obr.id_generador = gen.id
        left join citas as cit on cit.id_obra=obr.id and cit.confirmacion=1
        where obr.id_planta='".GetIdPlanta()."' and gen.razonsocial like '%".$filtros->generador."%'
        GROUP by gen.id,gen.razonsocial
        order by gen.razonsocial asc) as tot ".$saldo.";
    ");

        
        $merged = collect($clientegastos);
        $filas=15;
        $page=0;
        if(isset($_GET['page'])){
            $page=$_GET['page'];
        }
        $links = new Paginator($merged, $merged->count(), $filas, $page);
        $links->setPath('');
        $clientegastos = $merged->forPage( $page, $filas); //Filter the page var*/
        $clientessaldos['saldos'] = $clientegastos;
        $clientessaldos['links'] = $links;
        return $clientessaldos;
}


function GetSaldosPlanta($id_planta){

    $saldo=array();
     /**
     * Datos de los pagos 
     */
    $pago=DB::table('pagos')
    ->where('id_planta','=',$id_planta)
    ->where('status','=',2)
    ->select(DB::raw('sum(monto) as montot'))
    ->first();

    

    /**
     * Aqui se calcula mas iva por que no tiene iva contemplado
     */
    $citas=DB::table('citas')
    ->join('obras','obras.id','=','citas.id_obra')
    ->select(DB::raw('sum((citas.cantidad*citas.precio)+(citas.cantidad*citas.precio*(citas.iva/100))) as consumo'))
    ->where('obras.id_planta','=',$id_planta)        
    ->where('obras.esalcaldia',0)
    ->where('citas.confirmacion',1)
    ->first();

    /**
     * Aqui solo se calcula la suma de la columna total, porque ya viene el iva
     */
    $pedidos = DB::table('pedidos')  
    ->where('id_planta',$id_planta)
    ->where('confirmacion','=',2)
    ->select( DB::raw('SUM((total)) as monto'))
    ->first();

    $consumo=$citas->consumo+$pedidos->monto;


    $condonado=DB::table('condonaciones')
    ->where('id_planta','=',$id_planta)
    ->select(DB::raw('sum(monto) as monto'))
    ->first();

    $saldo['pago']=$pago->montot;
    $saldo['consumo']=$consumo;
    $saldo['saldo']=$pago->montot-$consumo;
    $saldo['condonado']=$condonado->monto;
    $saldo['total']=($saldo['pago']+$saldo['condonado'])-$saldo['consumo'];
    return $saldo;
}


function GetPlantaActual(){
    return Relacion::where('id_planta',GetIdPlanta())->first();
}

function GetPlantas(){
    return Relacion::where('id_administrador',GetId())->get();
}

function GetMunicipio(){
    if(Auth::guard('dependencias')->check()){
        $municipio=Municipio::find(Auth::guard('dependencias')->user()->id_municipio);
        return $municipio->municipio;
    } 
}

function GetNombreClientes(){
    
   

    if(Auth::guard('clientes')->check()){
        return Auth::guard('clientes')->user()->nombres.' '.Auth::guard('clientes')->user()->apellidos;
    }  

    
    if(Auth::guard('residentes')->check()){
        return Auth::guard('residentes')->user()->nombre;
    }  
}

function GetIdCliente(){
    
   

    if(Auth::guard('clientes')->check()){
        return Auth::guard('clientes')->user()->id;
    }  

    
    if(Auth::guard('residentes')->check()){
        return Auth::guard('residentes')->user()->id;
    }  
}


function GetCargo(){
    
    if(Auth::guard('directores')->check()){
        return "Director";
    }  
    
    if(Auth::guard('administradores')->check()){
        return Auth::guard('administradores')->user()->cargo;
    }  
    
    if(Auth::guard('finanzas')->check()){
        return Auth::guard('finanzas')->user()->cargo;
    } 
    
    if(Auth::guard('vendedores')->check()){
        return 'Vendedor';
    } 
    
    if(Auth::guard('dosificadores')->check()){
        return Auth::guard('dosificadores')->user()->cargo;
    }  
}

function GetMail(){
    
    if(Auth::guard('directores')->check()){
        return Auth::guard('directores')->user()->mail;
    }  
    
    if(Auth::guard('administradores')->check()){
        return Auth::guard('administradores')->user()->mail;
    }  
    
    if(Auth::guard('finanzas')->check()){
        return Auth::guard('finanzas')->user()->mail;
    }  

    
    if(Auth::guard('vendedores')->check()){
        return Auth::guard('vendedores')->user()->mail;
    }  
}

function EnviarMensaje($telefonos,$mensaje){

    $instasentClient = new Instasent\SmsClient("8b7953a5fe24c0c838830616ae4dc24db98a8945");
    $response = $instasentClient->sendUnicodeSms('Recitrack', $telefonos, $mensaje);
    //return $response['response_code'];
    if(intval($response['response_code'])>=199 && intval($response['response_code'])<=300){
        return 1;
    }else{
        return 0;
    }
    
}

function RevisarSesiones($sesiones){
    $abiertas=0;
    foreach($sesiones as $sesion){
        if(Auth::guard($sesion)->check()){
            $abiertas++;
        }
    }
    if($abiertas>0){
        return false;
    }
    return redirect('home')->with('warning','Sesión finalizada.');
}

function GetUuid(){
    $data = random_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); 
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); 
    return str_replace("-","",vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4)));
}


function GetDateTimeNow(){
    return date('Y-m-d H:i:s');
}


function CrearRuta($ruta){
    $ruta=public_path().'/'.$ruta;
    if(!is_dir($ruta))
        mkdir($ruta, 0777,true);
        return $ruta;
}

function GuardarArchivos($file,$ruta,$nombre){


    $ruta=public_path().$ruta;
    if(!is_dir($ruta))
        mkdir($ruta, 0777,true);

    if(file_exists($ruta.'/'.$nombre))             
        unlink($ruta.'/'.$nombre);

    if($file->move($ruta, $nombre)){
        return true;
    }else{
        return false;
    }

}

function CargarArchivos($file,$ruta,$nombre,$opcion){
    switch($opcion){
        //Archivo desde un form
        case 1:
            $ruta=public_path().$ruta;
            if(!is_dir($ruta))
                mkdir($ruta, 0777,true);

            if(file_exists($ruta.'/'.$nombre))             
                unlink($ruta.'/'.$nombre);

            if($file->move($ruta, $nombre)){
                return true;
            }else{
                return false;
            }
        break;
    }
}


function GuardarArchivosBase64($imagen,$ruta,$nombre){
    

    $afoto=explode(',',$imagen);
            
    $file = base64_decode($afoto[1]);

    $ruta=public_path().$ruta;
    if(!is_dir($ruta))
        mkdir($ruta, 0777,true);

    if(file_exists($ruta.'/'.$nombre))             
        unlink($ruta.'/'.$nombre);


        
    if(file_put_contents($ruta.'/'.$nombre,$file)){
        return true;
    }else{
        return false;
    }
    
}

function MesesEspanol($fecha){
    $fecha=explode("/",$fecha);
    $mes=$fecha[1];
    $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    
    $fecha[1]=$meses[$mes-1];
    return implode("/",$fecha);
}

function MesEspanol($mes){
    
    $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    
    $mes=$meses[$mes-1];
    return $mes;
}

function FechaFormateada($fecha){
       
    $dias=['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
    $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    $anio=date('Y',strtotime($fecha));
    $mes=$meses[date('m',strtotime($fecha))-1];
    $dia=date('d',strtotime($fecha));
    $diasemana=$dias[date('w',strtotime($fecha))];
    
    return $diasemana.' '.$dia.' '.$mes.' '.$anio;
}

function FechaFormateadaTiempo($fecha){
       
    $dias=['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
    $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    $anio=date('Y',strtotime($fecha));
    $mes=$meses[date('m',strtotime($fecha))-1];
    $dia=date('d',strtotime($fecha));
    $diasemana=$dias[date('w',strtotime($fecha))];
    
    return $diasemana.' '.$dia.' '.$mes.' '.$anio.' '.date('H:i',strtotime($fecha));
}

function TiempoFormateado($fecha){
       
    
    
    return date('H:i:s',strtotime($fecha));
}

function FechaFormateadaContratos($fecha){
       
    $dias=['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
    $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    $anio=date('Y',strtotime($fecha));
    $mes=$meses[date('m',strtotime($fecha))-1];
    $dia=date('d',strtotime($fecha));
    $diasemana=$dias[date('w',strtotime($fecha))];
    
    return $diasemana.' '.$dia.' de '.$mes.' del '.$anio;
}

function GetEstatusCitas($confirmacion){
    switch($confirmacion){
        case 0:
            return '<small class="badge badge-info"><i class="fa fa-exclamation" aria-hidden="true"></i> En sitio</small>';
        break;
        case 1:
            return '<small class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i>  Confirmado</small>';
        break;
        case 2:
            return '<small class="badge badge-danger"><i class="fa fa-check" aria-hidden="true"></i>  Falta</small>';
        break;
        case 3:
            return '<small class="badge badge-warning"><i class="fa fa-check" aria-hidden="true"></i>  En Transito</small>';
        break;
    }
}


function GetEstatusPedidos($confirmacion){
    switch($confirmacion){
        case 0:
            return '<small class="badge badge-danger"><i class="fa fa-check" aria-hidden="true"></i>  Rechazado</small>';
        break;
        case 1:
            return '<small class="badge badge-warning"><i class="fa fa-check" aria-hidden="true"></i> Pendiente</small>';
        break;
        case 2:
            return '<small class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i>  Confirmado</small>';
        break;
        case 3:
            return '<small class="badge badge-info"><i class="fa fa-check" aria-hidden="true"></i>  Validando Pago</small>';
        break;
      
        
    }
}


/**
 * 
 * Revisa el monto por planta , revisa el gasto de reciclaje y el gasto 
 * de pedidos y calcula si puede agregar el gasto nuevo son pasarse del monto de saldo disponible
 * y revisa si el cliente puede generar gastos sin saldo
 */
function PuedeGastar($id_obra,$monto){

    
  
    /**
     * Si puede pospago regresas true, para que revisas si le alcansa o no jejejejej
     */
    //return GastoPedidos($cliente->id_cliente,$cliente->id_planta);
    if(PuedePospago($id_obra)){
        return true;
    }

    $pago = PagoPorObra($id_obra);
    $reciclaje = GastoReciclajeObra($id_obra);
    $pedidos = GastoPedidosObra($id_obra);
    
    if(($pago-$reciclaje-$monto-$pedidos)<-2){
        return false;
    }else{
        return true;
    }
    
    
    
}


function PagoPorObra($id_obra){
    $pago = DB::table('pagos')
        ->where('pagos.id_obra',$id_obra)       
        ->where('pagos.status',2)
        ->select(DB::raw('SUM(pagos.monto) as monto'))
        ->first();
    return $pago->monto;

}

function GastoReciclajeObra($id_obra){
    $citas = DB::table('obras')
        ->leftjoin('citas','citas.id_obra','=','obras.id')
        ->where('obras.id',$id_obra) 
        ->where('citas.confirmacion','!=',2)
        ->select( DB::raw('SUM((citas.precio*citas.cantidad)+((citas.precio*citas.cantidad)*citas.iva/100)) as monto'))
        ->first();
    

    $gasto=$citas->monto;
    /**
     * Ya viene con descuento al agregar la obra
     */
    
    return $gasto;
    

}

function SaldoObra($id_obra){
    $pago = PagoPorObra($id_obra);
    $reciclaje = GastoReciclajeObra($id_obra);
    $pedidos = GastoPedidosObra($id_obra);

    return $pago-$reciclaje-$pedidos;
}


function GastoPedidosObra($id_obra){
    $pedidos = DB::table('obras')
        ->leftjoin('pedidos','pedidos.id_obra','=','obras.id')
        ->where('obras.id',$id_obra)
        ->where('pedidos.confirmacion','=',2)
        ->select( DB::raw('SUM((pedidos.total)) as monto'))
        ->first();
    

    return $pedidos->monto;    
    

}





function TieneLimite($id_obra,$cantidad){

    $citas = DB::table('obras')
    ->where('obras.id',$id_obra)
    ->select('obras.limite', DB::raw("(select sum(cantidad) from citas where id_obra='".$id_obra."' and month(created_at)=month(now())  and confirmacion!=2) as cantidad"))
    ->first();

    
    //return $cantidad."<<<>>>".$citas->cantidad."<<<>>>".$citas->limite;


    if($citas->limite==0){
        return false;
    }
    
    if(($citas->cantidad+$cantidad)<=$citas->limite)
    {
        return false;
    }

    if(($citas->cantidad+$cantidad)>=$citas->limite)
    {
        return true;
    }

    
}

function TieneLimite2($id_obra){

    $citas = DB::table('obras')
    ->where('obras.id',$id_obra)
    ->select('obras.limite', DB::raw("(select sum(cantidad) from citas where id_obra='".$id_obra."' and month(created_at)=month(now())  and confirmacion!=2) as cantidad"))
    ->first();

    
    return "Acumulado: ".$citas->cantidad." Limite".$citas->limite;


    
}

/**
 * Valida si tiene transporte disponible en sus pedidos
 */

function TieneTransporte($id_obra){
    $transporte=DB::table('obras')
        ->where('id',$id_obra)
        ->where('transporte',1)
        ->get();
    
    if(count($transporte)){
        $pedido=DB::table('pedidos')
            ->join('detallepedidos','detallepedidos.id_pedido','=','pedidos.id')
            ->select('detallepedidos.id','detallepedidos.disponible')
            ->where('detallepedidos.id_obra',$id_obra)
            ->where('detallepedidos.disponible',1)  
            ->where('pedidos.confirmacion',2)
            ->first();

        if($pedido){
            /**
             * No es el id del pedido, se esta usando el id del detalle
             */
            DB::table('detallepedidos')
            ->where('id', $pedido->id)
            ->update([
                'disponible' => 0
            ]);     
            return true;
        }else{
            return false;
        }
        
    }

    return true;
} 

/**
 * Pagos por cliente, no importa que planta 
 */
function Pago($id_cliente){
    $pago = DB::table('clientes')
        ->join('pagos','pagos.id_cliente','=','clientes.id')
        ->where('clientes.id',$id_cliente)        
        ->where('pagos.status',2)
        ->select(DB::raw('SUM(pagos.monto) as monto'))
        ->first();
    return $pago->monto;

}

/**
 * Pago por cliente en cada planta 
 */
function PagoPorPlanta($id_cliente,$id_planta){
    $pago = DB::table('clientes')
        ->join('pagos','pagos.id_cliente','=','clientes.id')
        ->where('clientes.id',$id_cliente) 
        ->where('pagos.id_planta',$id_planta)       
        ->where('pagos.status',2)
        ->select(DB::raw('SUM(pagos.monto) as monto'))
        ->first();
    return $pago->monto;

}




/**
 * Citas a reciclaje por cliente , no importa que planta 
 */
function Reciclaje($id_cliente){
    $citas = DB::table('clientes')
        ->leftjoin('generadores','generadores.id_cliente','=','clientes.id')
        ->leftjoin('obras','obras.id_generador','=','generadores.id')
        ->leftjoin('citas','citas.id_obra','=','obras.id')
        ->where('clientes.id',$id_cliente)     
        ->where('citas.confirmacion','!=',2)
        ->select( DB::raw('SUM((citas.precio*citas.cantidad)+((citas.precio*citas.cantidad)*citas.iva/100)) as monto'))
        ->first();
    

    return $citas->monto;

}

function Compenzado($id_cliente){
    $citas = DB::table('clientes')
        ->leftjoin('generadores','generadores.id_cliente','=','clientes.id')
        ->leftjoin('obras','obras.id_generador','=','generadores.id')
        ->leftjoin('citas','citas.id_obra','=','obras.id')
        ->where('clientes.id',$id_cliente)     
        ->where('citas.confirmacion','!=',2)
        ->where('obras.esalcaldia','=',1)
        ->select( DB::raw('SUM((citas.precio*citas.cantidad)+((citas.precio*citas.cantidad)*citas.iva/100)) as monto'))
        ->first();
    

    return $citas->monto;

}

/**
 * Citas a reciclaje por cliente y por planta
 */
function GastoReciclaje($id_cliente,$id_planta){
    $citas = DB::table('clientes')
        ->leftjoin('generadores','generadores.id_cliente','=','clientes.id')
        ->leftjoin('obras','obras.id_generador','=','generadores.id')
        ->leftjoin('citas','citas.id_obra','=','obras.id')
        ->where('clientes.id',$id_cliente)
        ->where('obras.id_planta',$id_planta)
        ->where('obras.contrato',1)   
        ->where('citas.confirmacion','!=',2)
        ->select( DB::raw('SUM((citas.precio*citas.cantidad)+((citas.precio*citas.cantidad)*citas.iva/100)) as monto'))
        ->first();
    

    $gasto=$citas->monto;
    /**
     * Ya viene con descuento al agregar la obra
     */
    
    return $gasto;
    

}


function Pedidos($id_cliente){
    $pedidos = DB::table('clientes')
        ->leftjoin('generadores','generadores.id_cliente','=','clientes.id')
        ->leftjoin('obras','obras.id_generador','=','generadores.id')
        ->leftjoin('pedidos','pedidos.id_obra','=','obras.id')
        ->where('clientes.id',$id_cliente)     
        ->whereraw('pedidos.confirmacion = 2')
        ->select( DB::raw('SUM((pedidos.total)) as monto'))
        ->first();
    

    return $pedidos->monto;

}

/**
 * Plantas del cliente
 */


 function PlantasCliente($id_cliente){
    $plantas = DB::table('clientes')
    ->leftjoin('generadores','generadores.id_cliente','=','clientes.id')
    ->leftjoin('obras','obras.id_generador','=','generadores.id')
    ->join('plantas','plantas.id','=','obras.id_planta')
    ->where('clientes.id',$id_cliente)
    ->where('obras.verificado',1)
    ->select('plantas.id','plantas.planta','plantas.siglas')
    ->groupby('plantas.id','plantas.planta','plantas.siglas')
    ->get();
    return $plantas;
 }

/**
 * Gasto cliente y por planta de pedidos de productos(incluye transporte)
 */
function GastoPedidos($id_cliente,$id_planta){
    $pedidos = DB::table('clientes')
        ->leftjoin('generadores','generadores.id_cliente','=','clientes.id')
        ->leftjoin('obras','obras.id_generador','=','generadores.id')
        ->leftjoin('pedidos','pedidos.id_obra','=','obras.id')
        ->where('clientes.id',$id_cliente)
        ->where('obras.id_planta',$id_planta)
        ->where('obras.contrato',1)
        ->where('pedidos.confirmacion','!=',0)
        ->select( DB::raw('SUM((pedidos.total)) as monto'))
        ->first();
    

    return $pedidos->monto;    
    

}

function GastosMesaMes($id_cliente,$year){
    return $gastos=DB::table('clientes')
        ->leftjoin('generadores','generadores.id_cliente','=','clientes.id')
        ->leftjoin('obras','obras.id_generador','=','generadores.id')
        ->leftjoin('citas','citas.id_obra','=','obras.id')
        ->where('clientes.id',$id_cliente)        
        ->where('citas.confirmacion','!=',2)
        ->whereraw('YEAR(citas.created_at) = \''.$year.'\'')
        //->select('clientes.id as cli','obras.id as idobra','citas.id as idddd','materialesobra.id as mate', 'materialesobra.precio','materialesobra.cantidad')
        ->select(DB::raw('YEAR(citas.created_at) year, MONTH(citas.created_at) month'), DB::raw('SUM((citas.precio*citas.cantidad)+((citas.precio*citas.cantidad)*citas.iva/100)) as monto'))
        ->groupby('year','month')
        ->get();    

}

function PedidosMesaMes($id_cliente,$year){
    return $gastos=DB::table('clientes')
        ->leftjoin('generadores','generadores.id_cliente','=','clientes.id')
        ->leftjoin('obras','obras.id_generador','=','generadores.id')
        ->leftjoin('pedidos','pedidos.id_obra','=','obras.id')
        ->where('clientes.id',$id_cliente)        
        ->where('pedidos.confirmacion','!=',0)
        ->whereraw('YEAR(pedidos.created_at) = \''.$year.'\'')
        //->select('clientes.id as cli','obras.id as idobra','pedidos.id as idddd','materialesobra.id as mate', 'materialesobra.precio','materialesobra.cantidad')
        ->select(DB::raw('YEAR(pedidos.created_at) year, MONTH(pedidos.created_at) month'), DB::raw('SUM(pedidos.total) as monto'))
        ->groupby('year','month')
        ->get();
    

}

function Descuento($monto,$id_cliente){
    
    $descuento = DB::table('descuentos')
        ->where('id_cliente',$id_cliente)
        ->first();

    if($descuento){
        return ($monto-($monto*(($descuento->porcentaje)/100)));
    }else{
        return $monto;
    }
}

function PuedePosPago($id_obra){
    
    $obra = DB::table('obras')
        ->where('id',$id_obra)
        ->select('puedepospago')
        ->first();

    if($obra)
    {
        return $obra->puedepospago;
    }else{
        return false;
    }
    
}

function CantidadLetras($numero){
    $formatterES = new NumberFormatter("Es", NumberFormatter::SPELLOUT);
    return $formatterES->format($numero);
} 

function SumarDias($fecha,$dias){
    
    return date('Y-m-d',strtotime ( '+'.($dias).' days' , strtotime ($fecha) ));
}

function Notificar($subject,$title,$subtitle,$body,$correos,$links){
    $correo=new Notificaciones($subject,$title,$subtitle,$body,$links);
    Mail::to($correos)->queue($correo);
}

function MandarCorreo($subject,$title,$body,$correos,$links=''){
    $correo=new Correos($subject,$title,$body,$links);
    Mail::to($correos)->queue($correo);
}

function TokenGen($mail){
    $id=GetUuid();
    $token=Token::where('mail',$mail)->first();
    
   
    if($token){
        $token=Token::find($token->id);
        $token->delete();
    }
    
    $token=new Token();        
    $token->id=$id;
    $token->token=password_hash($id,PASSWORD_DEFAULT);
    $token->mail=$mail;
    if($token->save()){
        return $id;      
    }else{
        return false;
    }


}

function Historial($tabla,$id_referencia,$id_adminsitrador,$movimiento,$detalle){
    $historial=new Historial();
    $historial->id=GetUuid();
    $historial->tabla=$tabla;
    $historial->id_referencia=$id_referencia;
    $historial->id_administrador=$id_adminsitrador;
    $historial->movimiento=$movimiento;
    $historial->detalle=$detalle;
    $historial->save();
}

/**Este metodo regrasa false si esta bien la conexion y si esta mal regresa true */
function VerificarConexion($conectionName){
    // Test database connection
    try {
        DB::connection($conectionName)->getPdo();
    } catch (\Exception $e) {
        return true;
    }
    return false;
}

function TieneObrasAdmin(){
    $plantas=DB::table('plantas')
        ->select('plantas.id')
        ->where('plantas.id',Auth::guard('administradores')->user()->id_planta)
        ->where('plantas.tipo',1)
        ->get();
    return count($plantas);
}


function TieneNegociosAdmin(){
    $plantas=DB::table('plantas')
        ->select('plantas.id')
        ->where('plantas.id',Auth::guard('administradores')->user()->id_planta)
        ->where('plantas.tipo',2)
        ->get();
    return count($plantas);
}
function TieneObras(){

    $obras=DB::table('clientes')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('obras','obras.id_generador','=','generadores.id')
        ->select('obras.id')
        ->where('clientes.id',Auth::guard('clientes')->user()->id)
        ->get();
        return count($obras);
   
}

function TieneNegocios(){

    $negocios=DB::table('clientes')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('negocios','negocios.id_generador','=','generadores.id')
        ->select('negocios.id')
        ->where('clientes.id',Auth::guard('clientes')->user()->id)
        ->get();
    return count($negocios);
   
}

function Entregado($cita){
    $citan=new Cita();
    $citan->id=$cita->id;
    $file=public_path("key/recitrack-a87ef-firebase-adminsdk-smctc-1f5c9b7255.json");
    if(file_exists($file)){
        $firebase= (new Factory)->withServiceAccount($file); 
        $db=$firebase->createDatabase();
        $reference = $db->getReference("Citas/Confirmadas/".$citan->id);
        
        $reference->set($citan);
        return true;
    }else{
        return false;
    } 
   
}

function ViajeEntregado($id){
    $remision=new Remision();
    $remision->id=$id;
    $file=public_path("key/recitrack-a87ef-firebase-adminsdk-smctc-1f5c9b7255.json");
    if(file_exists($file)){
        $firebase= (new Factory)->withServiceAccount($file); 
        $db=$firebase->createDatabase();
        $reference = $db->getReference("Remisiones/Confirmadas/".$remision->id);
        
        $reference->set($remision);
        return true;
    }else{
        return false;
    } 
   
}

function QuitarTema(){
    $file=public_path("key/recitrack-a87ef-firebase-adminsdk-smctc-1f5c9b7255.json");
    if(file_exists($file)){
        $firebase= (new Factory)->withServiceAccount($file); 
        $db=$firebase->createDatabase();
        $reference = $db->getReference("Remisiones/Traking/fd50045ce6924eb89034325f95e2144d");
        
        $reference->set("");
        return true;
    }else{
        return false;
    } 
   
}

function Orden1Cliente($id){
    $or=new Orden();
    $orden=new Orden();
    $orden->orden=1;   
    $or->orden=0;
    

    $cliente=DB::table('clientes')
    ->select('clientes.id')
    ->join('generadores','generadores.id_cliente','=','clientes.id')
    ->join('obras','obras.id_generador','=','generadores.id')            
    ->join('pedidos','pedidos.id_obra','=','obras.id')           
    ->join('detallepedidos','detallepedidos.id_pedido','=','pedidos.id')
    ->join('remisiones','remisiones.id_detallepedido','=','detallepedidos.id')
    ->whereraw("remisiones.id = '".$id."'  ")
    ->first();

    //$orden->id=GetUuid();
    //return $orden;
    $file=public_path("key/recitrack-a87ef-firebase-adminsdk-smctc-1f5c9b7255.json");
    if(file_exists($file)){
        $firebase= (new Factory)->withServiceAccount($file); 
        $db=$firebase->createDatabase();
        $reference = $db->getReference("Ordenes/Recitrack/".$cliente->id);
        
        
        $reference->set($or);
        $reference->set($orden);
        return true;
    }else{
        return false;
    } 
   
}

function GeneraQR($path,$texto){
    
    if(!is_dir(public_path().'/'.$path))
        mkdir(public_path().'/'.$path, 0777,true);
        
$nombre=GetUuid().'.png';


$url= ($path.$nombre);
\QRCode::text($texto)->setOutfile($url)->png(); 
return $url;

}

function TipoPlanta(){
    $planta=Planta::where('id',Auth::guard('administradores')->user()->id_planta)->first();
    return $planta->tipo;
}


function GetLatMexico(){
    return 20.248882446801847;
}


function GetLonMexico(){
    return -101.45472227050904;
}

function RevisaDatosVehiculos($request,$id){

    $vehiculos=Vehiculo::join('empresastransporte','empresastransporte.id','=','vehiculos.id_empresatransporte')
    ->where('empresastransporte.id','=',$id)
    ->get();
    foreach($vehiculos as $vehiculo){
        Cita::where('matricula', $vehiculo->matricula)
        ->update([
            'razonvehiculo' => $request->razonsocial,
            'ramir' => $request->ramir,
            'direccionvehiculo' => $request->domicilio
        ]);
    }
    


}


function RevisaDatosVehiculo($matriculaant,$matricula){

    $vehiculos=Vehiculo::join('empresastransporte','empresastransporte.id','=','vehiculos.id_empresatransporte')
    ->where('vehiculos.matricula','=',$matricula)
    ->get();
    foreach($vehiculos as $vehiculo){
        Cita::where('matricula', $matriculaant)
        ->update([
            'razonvehiculo' => $vehiculo->razonsocial,
            'ramir' => $vehiculo->ramir,
            'direccionvehiculo' => $vehiculo->domicilio,
            'matricula' => $vehiculo->matricula
        ]);
    }
    


}

function Carrito(){
    $id_usuario = Auth::guard('clientes')->check()==false ? Auth::guard('residentes')->user()->id : Auth::guard('clientes')->user()->id;
    return $cart = DetallePedido::where('id_usuario',$id_usuario)->get()->where('carrito',1)->count();
}

function GetSaldo(){
    
    $pago = Pago(Auth::guard('clientes')->user()->id);
    $reciclaje=Reciclaje(Auth::guard('clientes')->user()->id);
    
    $compenzado=Compenzado(Auth::guard('clientes')->user()->id);
    $pedido=Pedidos(Auth::guard('clientes')->user()->id);
    $gasto=$reciclaje+$pedido;
    
    
    $saldo=$pago-$gasto+$compenzado;
    return $saldo;
}

function GetObrasPago(){
    return $obras= DB::table('clientes')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('obras','obras.id_generador','=','generadores.id')
        ->where('clientes.id',Auth::guard('clientes')->user()->id)
        ->select('obras.id','obras.obra','obras.superficie','obras.id_planta',
        DB::RAW("(select planta from plantas where id=obras.id_planta) as planta"))
        ->orderby('obras.obra','asc')
        ->get();
        
}

function GetPlantasPago($obras){

    $id_plantas=array();
    foreach($obras as $obra){
        $id_plantas[]=$obra->id_planta;
    }

    return $plantas=Planta::wherein('id',$id_plantas)->orderby('planta','asc')->get();
}



function VerificarPago($id)
{
    $pago=Pago::find($id);
    if($pago){
        $pago->id_administrador=GetId();
        $pago->status=2;
        if($pago->save()){ 
            if($pago->id_pedido!='' && Auth::guard('vendedores')->check()){
                $pedido=Pedido::find($pago->id_pedido);
                $pedido->id_vendedor=GetId();
                $pedido->confirmacion=2;
                $pedido->save();
            }

            Historial('pagos',$pago->id,GetId(),'Autorización de Pago','Pago autorizado Monto: '.$pago->monto);
            return true;
        }else{
            return false;
        }

        
        
    }

    
}

function CancelarPago($request, $id)
{        
    $pago=Pago::find($id);
    if($pago){
        $pago->id_administrador=GetId();
        $pago->status=0;
        $pago->detalle=$request->detalle;
        if($pago->save()){
            if($pago->id_pedido!=''){
                $pedido=Pedido::find($pago->id_pedido);
                $pedido->confirmacion=3;
                $pedido->save();
            }
            Historial('pagos',$pago->id,GetId(),'Cancelación de Pago',$request->detalle.'  Monto: '.$pago->monto);
            return true;
        }else{
            return false;
        }
    }

    
}

function Logueo($id_usuario){
    $log=new Logueo();
    $log->id=GetUuid();
    $log->id_usuario=$id_usuario;
    $log->save();    
}

function CodificaTipoObra($tipo){
    $to=array();

    if(gettype(json_decode($tipo))=='array'){
        $tipo=json_decode($tipo);
        for($i=0 ; count($tipo) >$i ; $i++){
            if(gettype($tipo[$i])!='NULL'){
                $to[]=json_decode($tipo[$i])->tipo;
            }
            
        }
        return implode(', ',$to);
    }
    return $tipo;
}

function DescargaFotosBase64png($url){
    $data = file_get_contents($url);
    return 'data:image/png;base64,' . base64_encode($data);
}

function DescargaFotosBase64jpg($url){
    $data = file_get_contents($url);
    return 'data:image/jpg;base64,' . base64_encode($data);
}

function GetReferencia($id_planta){

    $configuracion=Configuracion::where('id_planta','=',$id_planta)
    ->first();


    $number1 = Pago::count();
    $length = 4;
    $number1 = substr(str_repeat(0, $length).$number1, - $length);

    $number2 = rand(1,9999);
    $length = 4;
    $number2 = substr(str_repeat(0, $length).$number2, - $length);
    return $configuracion->referencia.'-'.$number1.'-'.$number2;
}

    function CambiaStatusPedido($id){
        $pedido=Pedido::find($id);
        $pedido->confirmacion=3;
        $pedido->save();
        return $pedido->referencia;
    }

    function GetSiglas($opcion){
        switch ($opcion){
            case 0:
                return 'AMRCD';
            break;

           
        }
    }

    function TienePago($id){
        //return Pago::where('id_pedido',$id)->first();
        if(Pago::where('id_pedido',$id)->where('status',2)->first()){return true;}else{return false;}
    }



    


    function PostmanAndroid($request){
        
        if(isset($request->android)){
            $request=$request->android;
        }else{
            $request=str_replace("\"",'"',json_encode($request->all()));
        }
        if(gettype(json_decode($request))==='object'){

            $arreglo=array();
            $arreglo[]=json_decode($request);

            return json_decode(json_encode($arreglo),1); 
            
        }
        return json_decode($request,1);
    }


    function RespuestaAndroid($status,$msn,$datos=array()){
        $respuesta=array();
        if($status){
            $respuesta[]=array('status'=>$status,'msn'=>$msn,'datos'=>$datos);
        }else{
            $respuesta[]=array('status'=>$status,'msn'=>$msn);
        }
        
        return $respuesta;
    }

    function ChecaPlanta($id_planta,$id_usuario){
        $relacion=Relacion::where('id_planta',$id_planta)->where('id_administrador',$id_usuario)->count();
        if($relacion){
            return 'checked';
        }else{
            return'';
        }
    }


    function TwilioSMS($request){

       
        
        $twilio = new Client('AC119830ca10b3f6b845f036f468fb3276', '5f2036227337e7c18a37413b6d168a74');

        // Use the client to do fun stuff like send text messages!

        


        $telefono="+52".$request->telefono;
       



        $twilio->messages->create(
            // the number you'd like to send the message to
            $telefono,
            [
                // A Twilio phone number you purchased at twilio.com/console
                'from' => '+15005550006',
                // the body of the text message you'd like to send
                'body' => 'Prueba exitosa'
            ]
        );
        return 1;
    }


    function PagoChofer($cita){
        if($cita->id_chofer==''){
            return '';
        }
        if(PagoChofer::where('id_cita',$cita->id)->first()){
            return '';
        }
        $planta=Planta::find(GetIdPlanta());
        $pago=new PagoChofer();
        $pago->id=GetUuid();        
        $pago->id_planta=GetIdPlanta();
        $pago->id_cita=$cita->id;
        $pago->id_chofer=$cita->id_chofer;
        $pago->precio=$planta->recompensa;
        $pago->cantidad=$cita->cantidad;
        $pago->save();
        return '';
    }



    function ReemplazarTags($mail,$objeto){
        
        if(isset($objeto->id) && isset($objeto->nombres) && isset($objeto->apellidos) && isset($objeto->mail)){   
                    
            $mail=str_replace('@idcliente',$objeto->id,$mail);
            $mail=str_replace('@cliente',$objeto->nombres.' '.$objeto->apellidos,$mail);
            $mail=str_replace('@mail',$objeto->mail,$mail);
        }

        return $mail;
    }


    function Comentarios(){
        //Escribir simpre arriba de esta funcion las nuevas funciones.
        //No dejar tanto puto espacio aqui abajo por que si no vale puritita verga la libreria de exportar a excel, PINCHE MAMADA!!!!
    }
?>