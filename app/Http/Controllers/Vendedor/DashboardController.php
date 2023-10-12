<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteMensualVendedor;
use Redirect;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('vendedorlogged');
    }


    public function index()
    {
        return view('ventas.dashboard.dashboard');
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


    function GraficasMaterialMesVendedor(Request $request){
        /**
         * Datos para la grafica de citas
         */
        $year = isset($request->year) ? $request->year : date('Y');
        $month = isset($request->month) ? $request->month : date('m');

        $materialmes = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('obras.id_planta',Auth::guard('vendedores')->user()->id_planta)
        ->where('citas.confirmacion',1)
        ->whereraw('YEAR(citas.fechacita) = \''.$year.'\'')        
        ->whereraw('MONTH(citas.fechacita) = \''.$month.'\'')
        ->select('citas.material',DB::raw("sum(citas.precio*citas.cantidad) as cantidad"))
        ->groupby('citas.material')
        ->get();
     
        
        
        return view('ventas.dashboard.frames.materialmensual',['filtros'=>$request,'materialmes'=>$materialmes]);
    }

    function ReporteMensualvendedor($month,$year){
        return Excel::download(new ReporteMensualVendedor($month,$year), 'KPI-'.$month.' '.$year.'.xlsx');
    }
}
