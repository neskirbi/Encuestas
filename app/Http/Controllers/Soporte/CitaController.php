<?php

namespace App\Http\Controllers\Soporte;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Generador;
use App\Models\Cita;
use App\Models\Planta;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plantas=Planta::all();
        return view('soporte.citas.editar',['plantas'=>$plantas]);
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
        
        
        $folios=explode(',',$request->folios);
        
        $planta=Planta::find($request->planta);

        foreach($folios as $folio){
            //return $folio;
            Cita::where('folio',$folio)
            ->where("planta",$planta->planta)
            ->update([
                'fechacita' => $request->fechacita
            ]);
    
            
        }

        return redirect('citassoporte')->with('success','Todo bien');
    }

    function Cita($folio){
        $cita=Cita::where('folio',$folio)->first();
        
        return view('soporte.citas.editar',['cita'=>$cita]);
    }
}
