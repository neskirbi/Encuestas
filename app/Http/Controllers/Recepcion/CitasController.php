<?php

namespace App\Http\Controllers\Recepcion;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Cita;
use App\Models\Fuera;
use App\Models\MaterialObra;
use App\Models\Material;
use App\Models\Cliente;
use App\Models\Planta;
use App\Models\CondicionMaterial;
use App\Models\Configuracion;
use App\Models\Obra;
use App\Models\Recepcion;
use Redirect;

class CitasController extends Controller
{

    
    public function __construct(){
        //$this->middleware('administradorlogged');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $filtros)
    {
        //return $filtros;
        /**
         * Demonio para verificar pasadas.
         */
        Cita::whereRaw('DATEDIFF(NOW(),fechacita)>0')
        ->where('confirmacion', 0)
        ->update([
            'confirmacion' => 2
        ]);

        $citas_count = DB::table('citas')
        ->join('obras','obras.id','=','citas.id_obra')
        ->where('obras.id_planta','=',Auth::guard('recepciones')->user()->id_planta)
        ->where('citas.borrado',1)
        ->count();

        $citas_pendientes_count = DB::table('citas')
        ->join('obras','obras.id','=','citas.id_obra')
        ->where('obras.id_planta','=',Auth::guard('recepciones')->user()->id_planta)
            ->where('citas.borrado',1)
                ->where('citas.confirmacion',0)
                    ->count();

        $citas_asistidas_count = DB::table('citas')
        ->join('obras','obras.id','=','citas.id_obra')
        ->where('obras.id_planta','=',Auth::guard('recepciones')->user()->id_planta)
            ->where('citas.borrado',1)
                ->where('citas.confirmacion',1)
                    ->count();

        $citas_falta_count = DB::table('citas')
        ->join('obras','obras.id','=','citas.id_obra')
        ->where('obras.id_planta','=',Auth::guard('recepciones')->user()->id_planta)
            ->where('citas.borrado',1)
                ->where('citas.confirmacion',2)
                    ->count();

        $citas = DB::table('citas')
        ->join('obras','obras.id','=','citas.id_obra')
        ->join('generadores','generadores.id','=','obras.id_generador')
        ->where('obras.id_planta','=',Auth::guard('recepciones')->user()->id_planta)
        ->where('obras.obra','like','%'.$filtros->obra.'%')
        ->orderBy('citas.fechacita', 'desc')
        ->select('generadores.razonsocial','citas.id','citas.obra',DB::raw("'Reciclaje' as tipo"),'citas.fechacita','citas.planta','citas.confirmacion','citas.material as material','citas.matricula')
        ->paginate(10);


        return view('recepcion.citas.citas',['citas'=>$citas,
        'citas_count'=>$citas_count,
        'citas_pendientes_count'=>$citas_pendientes_count,
        'citas_asistidas_count'=>$citas_asistidas_count,
        'citas_falta_count'=>$citas_falta_count,'filtros'=>$filtros]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cita = DB::table('citas')
        ->where('id', $id)
        ->first();

        $materialesobra=DB::table('materialesobra')
        ->orderBy('material', 'asc')
        ->where('id_obra','=',$cita->id_obra)
        ->get();

        $obra=Obra::find($cita->id_obra);

        $materialobra=MaterialObra::find($cita->id_materialobra);
        //return view('formatos.cita', ['data'=>$cita]);
        for($i=0;$i<count($materialesobra);$i++){
            $materialesobra[$i]->precio=$materialesobra[$i]->precio-($materialesobra[$i]->precio*($obra->descuento/100));
        }
        $materialobra->precio=$materialobra->precio-($materialobra->precio*($obra->descuento/100));
        


        $cita->fechacita=str_replace("-","/",date('Y-m-d',strtotime($cita->fechacita)));
        $cita->qr=$id.'.png';
        
        $qrimage= ('images/qr/boleta/'.$cita->qr);
        \QRCode::text('reci-track.mx/boleta/'.$id)->setOutfile($qrimage)->png(); 

        return view('recepcion.citas.citarev', ['cita'=>$cita,'materialobra'=>$materialobra,'materialesobra'=>$materialesobra]);
    
        
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
    public function update(Request $request, $id){ 
        
       

        if(Auth::guard('recepciones')->user()->firma==''){            
            return Redirect::back()->with('error', 'Error al guardar, no ha guardado su firma de administrador, la puede guardar en Configuración -> Cuenta.');
        }
        


        //Confirma las citas dependiendo la configuracion de la planta 
        $planta=Planta::find(GetIdPlanta());
        if($planta->restriccion==1 && $planta->tiempo>0){
            $cita=Cita::select('id')->where('id',$id)->whereRaw('DATEDIFF(NOW(),fechacita)>'.($planta->tiempo/24))->where('confirmacion','!=',1)->first();
            if($cita){            
                return Redirect::back()->with('error', 'No puedes validar citas tan atrasadas, maximo  '.$planta->tiempo.' horas.');
            }
        }

        

        $planta=Planta::where('id',GetIdPlanta())->first();

        if(strlen($planta->latitud)>0){  
            if($planta->latitud >= $request->latitud && $planta->latitud2 <= $request->latitud && $planta->longitud <= $request->longitud && $planta->longitud2 >= $request->longitud){
                $fuera=new Fuera();
                $fuera->id=GetUuid();
                $fuera->id_cita=$id;
                $fuera->latitud=$request->latitud;
                $fuera->longitud=$request->longitud;
                $fuera->fuera=0;
                $fuera->save();
                
            }else{
                $fuera=new Fuera();
                $fuera->id=GetUuid();
                $fuera->id_cita=$id;
                $fuera->latitud=$request->latitud;
                $fuera->longitud=$request->longitud;
                $fuera->fuera=1;
                $fuera->save();
                //return Redirect::back()->with('error', 'No puedes validar citas fuera de la planta.');
            }
                   
            
        }

        
        $recepcion=Recepcion::find(Auth::guard('recepciones')->user()->id);
        $cita=Cita::find($id);
        $cita->recibio=$recepcion->nombre;
        $cita->firmarecibio=$recepcion->firma;
        $cita->cargo=$recepcion->cargo;
        $cita->nombrecompleto=$request->nombrecompleto;
        $cita->firmachof=$request->firmachof;

        /**
         * Busco en los materiales de la obra para cmbiarlo, si no lo registraron se va a gregar a la obra
         */
        if($request->material!=null){
            $materialobra=DB::table('materialesobra')
            ->where('id_obra','=',$cita->id_obra)
            ->where('id_material',$request->material)->first();
        
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

        
        $cita->cantidad=$request->cantidad;
        $cita->observacion=isset($request->observacion) ? $request->observacion : '' ;
        if(strlen($cita->recibio)==0){
            $cita->recibio=Auth::guard('recepciones')->user()->administrador;
        }
        if(strlen($cita->cargo)==0){
            $cita->cargo=Auth::guard('recepciones')->user()->cargo;
        }


        $obra=Obra::find($cita->id_obra);
        //DB::raw('(SELECT SUM(cantidad) FROM citas WHERE id_obra = obras.id and confirmacion=1) as entregado')

        if($cita->confirmacion==0 || $cita->folio==0){
            $configuracion=Configuracion::where('id_planta','=',$obra->id_planta)->first();
            $configuracion->folio=$configuracion->folio+1;
            $cita->folio=$configuracion->folio;
            $configuracion->save();
        }
        
        $cita->latitud=$request->latitud;
        $cita->longitud=$request->longitud;
        $cita->confirmacion=1;
        
        
        if($cita->save()){
            Entregado($cita);
            PagoChofer($cita);
            Historial('citas',$cita->id,Auth::guard('recepciones')->user()->id,'Confirmación de Cita','');

            //Actualizando status obra 
            $actual=DB::table('obras')
            ->select('obras.obra',
            DB::raw('(SELECT SUM(cantidad) FROM citas WHERE id_obra = obras.id and confirmacion=1) as entregado'),
            DB::raw("(((SELECT if(isnull(SUM(cantidad)),0,SUM(cantidad)) FROM citas WHERE id_obra = obras.id and confirmacion=1)/(SELECT sum(cantidad) from materialesobra where id_obra=obras.id )*100)-(100-(if(datediff(obras.fechafin,now())<0,0,datediff(obras.fechafin,now()))/datediff(obras.fechafin,obras.fechainicio)*100))) as status"))
            ->where('id',$cita->id_obra)->first();
            $obra->entregado=$actual->entregado;
            $obra->status=$actual->status;
            $obra->save();
            return Redirect::back()->with('success', 'Cita confirmada.');
        }else{
            return Redirect::back()->with('error', 'Error al guardar.');
        }

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

    

    
    
}
