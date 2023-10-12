<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Cita;
use App\Models\Obra;
use App\Models\Material;
use App\Models\MaterialObra;
use App\Models\Cliente;
use App\Models\Planta;
use App\Models\Vehiculo;
use App\Models\CondicionMaterial;
use App\Models\Producto;
use App\Models\Agregado;
use App\Models\Residente;
use App\Models\Banner;
use Redirect;

class CitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    

    public function index(Request $request)
    {
        if($redirect=RevisarSesiones([0=>'clientes',1=>'residentes'])){
            return$redirect;
        }

        if(Auth::guard('clientes')->check()){
            return $this->CitasClientes($request);
        }

        if(Auth::guard('residentes')->check()){            
            return $this->CitasResidentes();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function CitaReciclaje(Request $request)
    {
        if($request->firmares==null){
            return Redirect::back()->with('error', 'Por favor firmar la cita.');
        }

        $cliente = DB::table('clientes')
        ->join('generadores', 'generadores.id_cliente', '=', 'clientes.id')
        ->join('obras', 'obras.id_generador', '=', 'generadores.id')
        ->where('obras.id',$request->obra) 
        ->select('clientes.id')       
        ->get();
        
        $generador = DB::table('generadores')
        ->join('obras', 'obras.id_generador', '=', 'generadores.id')
        ->select('generadores.razonsocial','generadores.calle','generadores.numeroext','generadores.colonia','generadores.municipio','generadores.cp')
        ->where('obras.id',$request->obra)        
        ->first();
        
         
        if(!$generador){
            return Redirect::back()->with('error', 'No puede generar citas, error de información.');
        }

        

        //Si cumple al tener sus datos actualizados

        $cita=new Cita();
        $abrecita = $cita->id = GetUuid();
        
        

        $cita->razonsocial = $generador->razonsocial;
        $cita->calleynumerofis = $generador->calle." ".$generador->numeroext;
        $cita->coloniafis = $generador->colonia;
        $cita->municipiofis = $generador->municipio;
        $cita->cpfis = $generador->cp;

        $obra = Obra::find($request->obra);
        $cita->id_obra = $obra->id;
        $cita->id_planta = $obra->id_planta;
        $cita->obra = $obra->obra;
        $cita->distancia = $obra->distancia;
        $cita->nautorizacion = $obra->nautorizacion;
        $cita->calleynumeroobr = $obra->calle." ".$obra->numeroext;
        $cita->coloniaobr = $obra->colonia;
        $cita->municipioobr = $obra->municipio;
        $cita->cpobr = $obra->cp;
        $cita->telefono = $obra->telefono;
        $cita->nombreres=Auth::guard('residentes')->check() ? Auth::guard('residentes')->user()->nombre : Auth::guard('clientes')->user()->nombres.' '.Auth::guard('clientes')->user()->apellidos;
        $cita->firmares=$request->firmares==null ? '' : $request->firmares; 
        $cita->iva = $iva = $obra->ivaobra;

        if(Auth::guard('residentes')->check()){
            $residente=Residente::find(GetIdCliente());
            $residente->firma=$request->firmares==null ? '' : $request->firmares;
            $residente->save();
        }


        $planta= Planta::find($obra->id_planta);
        if($planta->activa==0){
            return Redirect::back()->with('error', "No se puede solicitar citas en ".$planta->planta." por el momento.");
        }
        if($planta){
            $cita->planta = $planta->planta;
            $cita->direccionplanta=$planta->direccion;
            $cita->plantaauto=$planta->plantaauto;
        }
 
        
        $vehiculo=DB::table('vehiculos')
        ->join('empresastransporte','empresastransporte.id','=','vehiculos.id_empresatransporte')
        ->where('vehiculos.id',$request->vehiculo)
        ->select('empresastransporte.razonsocial','empresastransporte.domicilio','empresastransporte.telefono','empresastransporte.ramir','empresastransporte.regsct',
        'vehiculos.marca','vehiculos.modelo','vehiculos.matricula','vehiculos.combustible',
        'vehiculos.vehiculo')
        ->first();
         
        if(!$vehiculo){
            return Redirect::back()->with('error', 'El vehículo no esta en el catálogo.');
        }
        if($vehiculo){
            $cita->vehiculo = $vehiculo->vehiculo;
            $cita->marcaymodelo = $vehiculo->marca." ".$vehiculo->modelo;
            $cita->matricula = $vehiculo->matricula;
            $cita->ramir = $vehiculo->ramir;
            $cita->regsct = $vehiculo->regsct;
            $cita->nombrecompleto = '';
            $cita->razonvehiculo= $vehiculo->razonsocial;
            $cita->direccionvehiculo=$vehiculo->domicilio;            
            $cita->combustible=$vehiculo->combustible;
            $cita->telefonovehiculo='';
        }

        


        $material=MaterialObra::find($request->material);
        if($material){
            $precio=$material->precio-($material->precio*($obra->descuento/100));
            $monto = (($request->cantidad*$precio)+($request->cantidad*$precio*$iva/100));

            if(TieneLimite($obra->id,$request->cantidad)){
                return Redirect::back()->with('error', 'No puede generar citas, ya ha sobrepasado el limite mensual.');
            }

            if(!PuedeGastar($obra->id,$monto)){
                return Redirect::back()->with('error', 'No puede generar citas por falta de saldo.');
            }

            if(!TieneTransporte($obra->id,$request->cantidad)){
                return Redirect::back()->with('error', 'Primero tiene que solicitar transporte en la sección de pedidos.');
            }

           
            
            $cita->id_materialobra = $material->id;
            $cita->material = $material->material;
            $cita->cantidad = $request->cantidad;
            $cita->unidades = $material->unidades;
            $cita->precio = $precio;
        }

        $condicionmaterial=CondicionMaterial::find($request->condicionmaterial);
        if($condicionmaterial){
            $cita->condicionesmaterial = $condicionmaterial->condicion;
        }        

        $cita->fechacita = $request->fechacita." ".$request->horacita;
        
        //return $cita;
        if($cita->save()){
            return redirect('citas')->with('success', 'Cita guardada.');
        }
            
        


        

        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function Reciclaje(){
        if($redirect=RevisarSesiones([0=>'clientes',1=>'residentes'])){
            return$redirect;
        }

        if(Auth::guard('clientes')->check()){
            $obras = DB::table('clientes')
            ->select('obras.id','obras.obra','plantas.planta','obras.puedepospago')
            ->join('generadores', 'generadores.id_cliente', '=', 'clientes.id')
            ->join('obras', 'obras.id_generador', '=', 'generadores.id')
            ->join('plantas','plantas.id','=','obras.id_planta')
            ->where('clientes.id',GetIdCliente())        
            ->get();
            

            $residente=0;
       
        }

        if(Auth::guard('residentes')->check()){
            $obras = DB::table('residentes')
            ->select('obras.id','obras.obra','plantas.planta','obras.puedepospago')
            ->join('residentesobras','residentesobras.id_residente', '=', 'residentes.id')
            ->join('obras', 'obras.id', '=', 'residentesobras.id_obra')
            ->join('plantas','plantas.id','=','obras.id_planta')
            ->where('residentes.id',GetIdCliente())
            ->get(); 
            $residente=Residente::find(GetIdCliente());
        }
        
        
        $plantas= Planta::all();
        $condicionmateriales = CondicionMaterial::all();

        $bannercitas=Banner::where('tipo',1)->orderby('created_at' , 'desc')->first();

        
        return view('generales.citas.citareciclaje',['obras'=>$obras,'plantas'=>$plantas,'nombre'=>GetNombreClientes(),
        'condicionmateriales'=>$condicionmateriales,'residente'=>$residente,'bannercitas'=>$bannercitas]);
    }

    public function Recoleccion(){
        if($redirect=RevisarSesiones([0=>'clientes',1=>'residentes'])){
            return$redirect;
        }
        
        if(Auth::guard('clientes')->check()){
            $obras = DB::table('clientes')
            ->join('generadores', 'generadores.id_cliente', '=', 'clientes.id')
            ->join('obras', 'obras.id_generador', '=', 'generadores.id')
            ->where('clientes.id',GetIdCliente())
        
            ->get();
       
        }

        if(Auth::guard('residentes')->check()){
            $obras = DB::table('residentes')
            ->join('residentesobras','residentesobras.id_residente', '=', 'residentes.id')
            ->join('obras', 'obras.id', '=', 'residentesobras.id_obra')
            ->where('residentes.id',GetIdCliente())            
     
            ->get();
        }

        $agregados=DB::table('agregados')->get();
        
        
        $plantas= Planta::all();
        $condicionmateriales = CondicionMaterial::all();
        return view('generales.citas.citarecoleccion',['obras'=>$obras,'plantas'=>$plantas,'condicionmateriales'=>$condicionmateriales,'agregados'=>$agregados]);
    }

    

    public function CitasClientes($request){
        $citas_sitio_count = DB::table('clientes')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('obras','obras.id_generador','=','generadores.id')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('clientes.id',GetIdCliente())        
        ->where('citas.confirmacion',0)
        ->count();

        $citas_transito_count = DB::table('clientes')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('obras','obras.id_generador','=','generadores.id')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('clientes.id',GetIdCliente())
        ->where('citas.confirmacion',3)
        ->count();

        $citas_asistidas_count = DB::table('clientes')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('obras','obras.id_generador','=','generadores.id')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('clientes.id',GetIdCliente())
        ->where('citas.confirmacion',1)
        ->count();

        $citas_falta_count =DB::table('clientes')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('obras','obras.id_generador','=','generadores.id')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('clientes.id',GetIdCliente())
        ->where('citas.confirmacion',2)
        ->count();

        $citas = DB::table('clientes')
        ->join('generadores', 'generadores.id_cliente', '=', 'clientes.id')
        ->join('obras', 'obras.id_generador', '=', 'generadores.id')
        ->join('citas', 'citas.id_obra', '=', 'obras.id')
        ->where('clientes.id',GetIdCliente())
        ->select('obras.esalcaldia','citas.obra','citas.planta','citas.fechacita','citas.material','citas.cantidad',
        'citas.confirmacion','citas.id',DB::raw("'Reciclaje' as tipo"))
        ->orderby('citas.fechacita','desc')
        ->paginate(10);

        return view('generales.citas.citas',['citas'=>$citas,
        'citas_sitio_count'=>$citas_sitio_count,
        'citas_transito_count'=>$citas_transito_count,
        'citas_asistidas_count'=>$citas_asistidas_count,
        'citas_falta_count'=>$citas_falta_count]);
    }

    /**
     * Conteo de citas por cada recidente en base a sus obras asignadas
     */
    public function CitasResidentes(){

        $citas_sitio_count =  DB::table('residentes')
        ->join('residentesobras','residentesobras.id_residente', '=', 'residentes.id')
        ->join('obras', 'obras.id', '=', 'residentesobras.id_obra')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('residentes.id',GetIdCliente())
        ->where('citas.confirmacion',0)
        ->count();

        $citas_transito_count = DB::table('residentes')
        ->join('residentesobras','residentesobras.id_residente', '=', 'residentes.id')
        ->join('obras', 'obras.id', '=', 'residentesobras.id_obra')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('residentes.id',GetIdCliente())
        ->where('citas.confirmacion',3)
        ->count();

        $citas_asistidas_count =DB::table('residentes')
        ->join('residentesobras','residentesobras.id_residente', '=', 'residentes.id')
        ->join('obras', 'obras.id', '=', 'residentesobras.id_obra')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('residentes.id',GetIdCliente())
        ->where('citas.confirmacion',1)
        ->count();

        $citas_falta_count = DB::table('residentes')
        ->join('residentesobras','residentesobras.id_residente', '=', 'residentes.id')
        ->join('obras', 'obras.id', '=', 'residentesobras.id_obra')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('residentes.id',GetIdCliente())
        ->where('citas.confirmacion',2)
        ->count();

        $citas = DB::table('residentes')
        ->join('residentesobras','residentesobras.id_residente', '=', 'residentes.id')
        ->join('obras', 'obras.id', '=', 'residentesobras.id_obra')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('residentes.id',GetIdCliente())
        ->select('obras.esalcaldia','citas.obra','citas.planta','citas.fechacita','citas.material','citas.cantidad',
        'citas.confirmacion','citas.id',DB::raw("'Reciclaje' as tipo"))
        ->orderBy('citas.created_at', 'desc')
        ->paginate(10);

       

        return view('generales.citas.citas',['citas'=>$citas,
        'citas_sitio_count'=>$citas_sitio_count,
        'citas_transito_count'=>$citas_transito_count,
        'citas_asistidas_count'=>$citas_asistidas_count,
        'citas_falta_count'=>$citas_falta_count]);
    }
   

    function FirmaTransporte($id){
        $cita=Cita::find($id);
        return view('generales.citas.firma',['cita'=>$cita]);
    }

    function Entregar(Request $request,$id){
        $cita=Cita::find($id);
        $cita->nombrecompleto=$request->nombrecompleto;  
        $cita->firmachof=$request->firmachof;
        if($cita->confirmacion==0){
            $cita->confirmacion=3;
        }
        
        if($cita->save()){
            return redirect(url('citas'))->with('success', 'Recibió residuo para su transporte '.$request->nombrecompleto.'.')->with('abrecita',$id);;
        }else{
            return Redirect::back()->with('error', 'Error al guardar la firma.');
        }
    }
   
}
