<?php
use App\Http\Controllers\FormatosController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmacionMail;
use App\Models\Token;
use App\Models\TipoObra;
use Illuminate\Http\Request;
use App\Exports\Random\ReporteValorObras;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**
 * Redirecciona del home al panel si es que ya esta logueado
 */
Route::get('/', function () {
    return redirect('home');
})->name('home');


/**
 * Redirecciona del home al panel si es que ya esta logueado
 */
Route::get('home', function () {

    if(Auth::guard('soportes')->check()){
        return redirect('vehiculossoporte');
    }  


    if(Auth::guard('directores')->check()){
        return redirect('graficas');
    }   

    if(Auth::guard('administradores')->check()){
        return redirect('obra');
    }  

    if(Auth::guard('vendedores')->check()){
        return redirect('ventas');
    } 

    if(Auth::guard('recepciones')->check()){
        return redirect('cita');
    } 

    if(Auth::guard('finanzas')->check()){
        return redirect('saldosfi');
    }  

    if(Auth::guard('dosificadores')->check()){
        return redirect('pedidosd');
    }     

    if(Auth::guard('clientes')->check()){
        return redirect('dashboard');
    }  

    if(Auth::guard('residentes')->check()){
        return redirect('citas');
    }  
    
    if(Auth::guard('transportistas')->check()){
        return redirect('empresas');
    }  

    if(Auth::guard('sedemas')->check()){
        return redirect('sedemao');
    }  

    if(Auth::guard('uias')->check()){
        return redirect('inspectores');
    } 

    if(Auth::guard('inspectores')->check()){
        return redirect('encuestas');
    } 
    
    if(Auth::guard('dependencias')->check()){
        return redirect('obrasd');
    } 
    
    if(Auth::guard('publicidades')->check()){
        return redirect('banners');
    } 
    
    return view('home');
});



/**
 * registro de clientes
 */
Route::resource('clientes', 'App\Http\Controllers\ClienteController');

/**
 * Logins
 */


 Route::post('cambiaplanta',function(Request $request){
    CambiaPlanta($request);
    return Redirect::back()->with('succes', 'Cambio de planta.');
 });


Route::get('acceso',function(){
    return view('asociados.login.login');
});

Route::get('soporte',function(){

    if(Auth::guard('soportes')->check()){
        return redirect('vehiculossoporte');
    }  

    return view('soporte.login.login');
});


Route::get('PassReset',function(){
    return view('login.passreset.passreset');
});

Route::post('Recuperar','App\Http\Controllers\LoginController@Recuperar');
Route::get('Recuperar/{id}',function($id){
    $token=Token::find($id);
    if($token){
        return view('login.passreset.pass',['id'=>$id]);
    }else{
        return redirect('home')->with('error','No se encontró la petición o ya se ultilizó el link anteriormente.');
    }
});
Route::post('GuardarPass/{id}','App\Http\Controllers\LoginController@GuardarPass');
 
Route::post('loginasociado', 'App\Http\Controllers\LoginController@authenticateasociado');
Route::post('loginadmin', 'App\Http\Controllers\LoginController@authenticateadmin');

Route::post('loginsedema', 'App\Http\Controllers\LoginController@AuthenticateSedema');

Route::get('loginpage',function(){
    return view('loginpage');
});

Route::get('registropage', function () {
    return view('registro');
});


Route::post('Registro', 'App\Http\Controllers\RegistroController@Registro');

Route::post('Login', 'App\Http\Controllers\LoginController@Login');
Route::post('login2', 'App\Http\Controllers\LoginController@authenticate');

Route::post('loginresidentes', 'App\Http\Controllers\LoginController@authenticateresidentes');

Route::post('logintransport', 'App\Http\Controllers\LoginController@authenticatetransportista');

Route::get('logout', 'App\Http\Controllers\LoginController@logout');


//Rutas transportistas


Route::resource('vehiculo', 'App\Http\Controllers\Transportista\VehiculoController');
Route::resource('chofer', 'App\Http\Controllers\Transportista\ChoferController');

Route::resource('empresas', 'App\Http\Controllers\Transportista\EmpresaController');

Route::resource('transportista','App\Http\Controllers\Transportista\TransportistaController');

Route::resource('ubicacion','App\Http\Controllers\Transportista\UbicacionController');
Route::resource('viajes','App\Http\Controllers\Transportista\ViajeController');



Route::get('mapa','App\Http\Controllers\Transportista\UbicacionController@Mapa');
Route::get('ruta','App\Http\Controllers\Transportista\UbicacionController@Ruta');


//Ruta centros de acopio


/**
 * Rutas Soporte
 */
Route::post('loginsoporte','App\Http\Controllers\LoginController@LoginSoporte');

Route::resource('transportistas', 'App\Http\Controllers\Soporte\TransportistaController');

Route::resource('vehiculossoporte', 'App\Http\Controllers\Soporte\VehiculoController');

Route::resource('entidades', 'App\Http\Controllers\Soporte\EntidadesController');
Route::resource('municipios', 'App\Http\Controllers\Soporte\MunicipiosController');

Route::resource('dependencias', 'App\Http\Controllers\Soporte\DependenciaController');

Route::resource('pagoschofer', 'App\Http\Controllers\Soporte\PagoChoferController');


Route::resource('links', 'App\Http\Controllers\Soporte\LinkController');

Route::resource('obrassoporte', 'App\Http\Controllers\Soporte\ObraController');


Route::resource('choferes', 'App\Http\Controllers\Soporte\ChoferController');

Route::put('ConfirmaChofer/{id}', 'App\Http\Controllers\Soporte\ChoferController@ConfirmaChofer');

Route::put('SuspendeChofer/{id}', 'App\Http\Controllers\Soporte\ChoferController@SuspendeChofer');



Route::resource('ModoDios', 'App\Http\Controllers\Soporte\ModoDiosController');
Route::post('LoginMD','App\Http\Controllers\Soporte\ModoDiosController@LoginMD');



Route::get('citasoporte/{id}', 'App\Http\Controllers\Soporte\CitaController@Cita');
Route::resource('citassoporte', 'App\Http\Controllers\Soporte\CitaController');


/**
 * Rutas para clientes
 */


Route::resource('dashboard', 'App\Http\Controllers\Cliente\DashboardController');

Route::get('GraficasPagosCliente','App\Http\Controllers\Cliente\DashboardController@GraficasPagosCliente');
Route::get('GraficasSaldoPlanta','App\Http\Controllers\Cliente\DashboardController@GraficasSaldoPlanta');
Route::get('GraficasSaldoObras','App\Http\Controllers\Cliente\DashboardController@GraficasSaldoObras');

Route::resource('generadores', 'App\Http\Controllers\Cliente\GeneradoresController');

Route::get('registrogenerador','App\Http\Controllers\RegistroGeneradoresController@index');
Route::get('registroobra','App\Http\Controllers\Cliente\ObraController@RegistroObra');


Route::resource('obras','App\Http\Controllers\Cliente\ObraController');
Route::put('cargarplan/{id}', 'App\Http\Controllers\Cliente\ObraController@CargarPlan');

Route::put('AsignarUia/{id}', 'App\Http\Controllers\Cliente\ObraController@AsignarUia');


Route::resource('campamentos', 'App\Http\Controllers\Cliente\CampamentoController');

Route::resource('vehiculos', 'App\Http\Controllers\VehiculosController');

Route::resource('citas', 'App\Http\Controllers\CitasController');


Route::get('reciclaje', 'App\Http\Controllers\CitasController@Reciclaje');
Route::post('citareciclaje', 'App\Http\Controllers\CitasController@CitaReciclaje');

Route::post('citarecoleccion', 'App\Http\Controllers\CitasController@CitaRecoleccion');
Route::get('recoleccion', 'App\Http\Controllers\CitasController@Recoleccion');


Route::get('terminos/{direccion}/{fechaini}/{fechafin}/{generador}/{total}', 'App\Http\Controllers\TerminosyCondicionesController@terminosycondiciones');

Route::get('terminosycondiciones',function(){
    return view('formatos.terminosycondiciones');
});

Route::get('/prueba', function () {
    return 'Administradores:'.Auth::guard('administradores')->check().'<br>Clientes: '. Auth::guard('clientes')->check();;
});


Route::resource('negocios','App\Http\Controllers\Cliente\NegocioController');
Route::get('negocio/cedula/{id}','App\Http\Controllers\Cliente\NegocioController@Cedula');

/***Ruta Manifiesto alcaldia */
Route::get('manifiestoalcaldia/{id}',[FormatosController::class,'manifiestoalcaldia']);


/**
 * Rutas Asociacion
 */
Route::resource('generadorasoc', 'App\Http\Controllers\Asociacion\GeneradorController');
Route::resource('catalogosasoc', 'App\Http\Controllers\Asociacion\CatalogosController');
Route::resource('obrasasoc', 'App\Http\Controllers\Asociacion\ObraController');
Route::resource('citasasoc', 'App\Http\Controllers\Asociacion\CitasController');

Route::resource('plantasasoc','App\Http\Controllers\Asociacion\PlantaController');



Route::post('plantareg','App\Http\Controllers\Asociacion\PlantaController@PlantaReg');


Route::resource('sedemas', 'App\Http\Controllers\Asociacion\SedemaController');
Route::get('quitarsedema/{id}','App\Http\Controllers\Asociacion\SedemaController@QuitarSedema');

Route::resource('unidadesia', 'App\Http\Controllers\Asociacion\UiaController');
Route::get('eliminaruia/{id}','App\Http\Controllers\Asociacion\UiaController@EliminarUia');



/**Rutas para Directores */

Route::resource('graficas', 'App\Http\Controllers\Director\DashboardController');

Route::resource('pagosd', 'App\Http\Controllers\Director\PagoController');

Route::resource('contratosdetalle','App\Http\Controllers\Director\ObraController');
Route::get('pagosdirector','App\Http\Controllers\Director\DashboardController@Pagos');

Route::get('GraficaPagosDiretor','App\Http\Controllers\Director\DashboardController@GraficaPagosDiretor');
Route::get('GraficasCitasDirector','App\Http\Controllers\Director\DashboardController@GraficasCitasDirector');
Route::get('GraficasMaterialMesDirector','App\Http\Controllers\Director\DashboardController@GraficasMaterialMesDirector');

Route::get('citasdirector','App\Http\Controllers\Director\DashboardController@Citas');
Route::get('saldosdirector','App\Http\Controllers\Director\DashboardController@Saldos');






Route::resource('reportesdir','App\Http\Controllers\Director\ReporteController');
Route::get('StatusObrasDirector/{id_planta}', 'App\Http\Controllers\Director\ReporteController@StatusObrasDirector');





/**
 * Rutas para administradores
 */

 
Route::resource('solicitudes','App\Http\Controllers\Administracion\PagosChofController');


Route::resource('planta','App\Http\Controllers\Administracion\PlantaController');
Route::post('AltaAdmin','App\Http\Controllers\Administracion\PlantaController@AltaAdmin');
Route::post('EditarAdmin/{id}','App\Http\Controllers\Administracion\PlantaController@EditarAdmin');
Route::get('BorrarAdmin/{id}','App\Http\Controllers\Administracion\PlantaController@BorrarAdmin');


Route::resource('pagos', 'App\Http\Controllers\Administracion\PagoController');

Route::resource('saldos','App\Http\Controllers\Administracion\SaldoController');
Route::resource('condonaciones','App\Http\Controllers\Administracion\CondonacionController');

Route::resource('catalogos', 'App\Http\Controllers\Administracion\CatalogoController');



Route::get('obrasretrasadas', 'App\Http\Controllers\Administracion\AlertaController@ObrasRetrasadas');
Route::resource('generador', 'App\Http\Controllers\Administracion\GeneradorController');

Route::resource('obra', 'App\Http\Controllers\Administracion\ObraController');
Route::post('CargarContrato/{id}', 'App\Http\Controllers\Administracion\ObraController@CargarContrato');
Route::get('ValidarObra/{id}', 'App\Http\Controllers\Administracion\ObraController@ValidarObra');

Route::get('PolizaRC/{id}', 'App\Http\Controllers\Administracion\ObraController@PolizaRC');


Route::resource('citasadmin', 'App\Http\Controllers\Administracion\CitasController');

Route::resource('citasfecha', 'App\Http\Controllers\Administracion\CitasFechaController');

Route::resource('configuracion', 'App\Http\Controllers\Administracion\ConfiguracionController');

Route::post('configuracioncuenta', 'App\Http\Controllers\Administracion\ConfiguracionController@ConfiguracionCuenta');
Route::post('configuracionbanco', 'App\Http\Controllers\Administracion\ConfiguracionController@ConfiguracionBanco');
Route::post('configuracionboleta', 'App\Http\Controllers\Administracion\ConfiguracionController@ConfiguracionBoleta');
Route::post('CambioPass/{id}', 'App\Http\Controllers\Administracion\ConfiguracionController@CambioPass');
Route::post('Horarios/{id}', 'App\Http\Controllers\Administracion\ConfiguracionController@Horarios');
Route::post('ConfiguracionValidacion/{id}', 'App\Http\Controllers\Administracion\ConfiguracionController@ConfiguracionValidacion');
Route::post('ConfiguracionCorreo/{id}', 'App\Http\Controllers\Administracion\ConfiguracionController@ConfiguracionCorreo');

Route::post('ConfiguracionRecompensa', 'App\Http\Controllers\Administracion\ConfiguracionAppController@ConfiguracionRecompensa');




Route::resource('configuracionapp', 'App\Http\Controllers\Administracion\ConfiguracionAppController');

Route::resource('administradores', 'App\Http\Controllers\Administracion\AdministradorController');
Route::resource('establecimientos', 'App\Http\Controllers\Administracion\NegocioController');

Route::get('imagenes',function(){
    return view('administracion.citas.imagenes');
});



Route::resource('friday','App\Http\Controllers\Administracion\FridayController');


Route::resource('reportes', 'App\Http\Controllers\Administracion\ReporteController');

Route::get('ReporteStatusObraAdministracion/{id_planta}', 'App\Http\Controllers\Administracion\ReporteController@ReporteStatusObraAdministracion');
Route::get('ReporteMaterialesAnual/{year}', 'App\Http\Controllers\Administracion\ReporteController@ReporteMaterialesAnual');

Route::resource('crm','App\Http\Controllers\Administracion\CrmController');

Route::resource('entregas','App\Http\Controllers\Administracion\EntregaController');




Route::resource('plantars','App\Http\Controllers\Administracion\PlantaReciduosController');

Route::resource('recolectores','App\Http\Controllers\Administracion\RecolectorController');

/**
 * Rutas para vendedores (Protocolo rueditas de bici)
 */
Route::get('citaspendientesventas', 'App\Http\Controllers\Vendedor\AlertaController@CitasPendientesVentas');
Route::post('borrarcitaspendientesventas/{id}', 'App\Http\Controllers\Vendedor\AlertaController@Borrarcitaspendientesventas');
 
Route::resource('dashboardv','App\Http\Controllers\Vendedor\DashboardController');
Route::get('GraficasMaterialMesVendedor','App\Http\Controllers\Vendedor\DashboardController@GraficasMaterialMesVendedor');
Route::get('ReporteMensualvendedor/{month}/{year}','App\Http\Controllers\Vendedor\DashboardController@ReporteMensualvendedor');


Route::resource('citasventas', 'App\Http\Controllers\Vendedor\CitaController');

Route::resource('obrav','App\Http\Controllers\Vendedor\ObraController');
Route::put('AgregarProducto/{id}','App\Http\Controllers\Vendedor\ObraController@AgregarProducto');
Route::put('GuardaPrecioProducto/{id}','App\Http\Controllers\Vendedor\ObraController@GuardaPrecioProducto');
Route::put('BorrarProductoObra/{id}','App\Http\Controllers\Vendedor\ObraController@BorrarProductoObra');


Route::put('AgregarTransporte/{id}','App\Http\Controllers\Vendedor\ObraController@AgregarTransporte');
Route::put('GuardaPrecioTransporte/{id}','App\Http\Controllers\Vendedor\ObraController@GuardaPrecioTransporte');
Route::put('BorrarTransporteObra/{id}','App\Http\Controllers\Vendedor\ObraController@BorrarTransporteObra');

Route::resource('pagosv', 'App\Http\Controllers\Vendedor\PagoValidacionController');

Route::resource('ventas','App\Http\Controllers\Vendedor\VentaController');

Route::post('CancelarPagov/{id}', 'App\Http\Controllers\Vendedor\PagoValidacionController@CancelarPago');
Route::post('VerificarPagov/{id}', 'App\Http\Controllers\Vendedor\PagoValidacionController@VerificarPago');

Route::resource('saldosv', 'App\Http\Controllers\Vendedor\PagoController');


Route::resource('productos','App\Http\Controllers\Vendedor\ProductoController');
Route::get('agregar','App\Http\Controllers\Vendedor\ProductoController@Agregar');
Route::get('productofotos/{id}','App\Http\Controllers\Vendedor\ProductoController@FotosProductos');


Route::resource('transporte','App\Http\Controllers\Vendedor\TransporteController');
Route::get('cargar','App\Http\Controllers\Vendedor\TransporteController@Cargar');


Route::post('RechazarPedido/{id}','App\Http\Controllers\Vendedor\VentaController@RechazarPedido');

Route::post('AceptarPedido/{id}','App\Http\Controllers\Vendedor\VentaController@AceptarPedido');

Route::post('GuardarPedido/{id}','App\Http\Controllers\Vendedor\VentaController@GuardarPedido');

Route::get('Carritov/{id}','App\Http\Controllers\Vendedor\VentaController@Carritov');


Route::get('Remision/{id}','App\Http\Controllers\FormatosController@Remision');


Route::resource('reporteven', 'App\Http\Controllers\Vendedor\ReporteController');



Route::resource('materiales', 'App\Http\Controllers\Vendedor\MaterialController');


Route::post('guardarcategoriamaterialadm', 'App\Http\Controllers\Vendedor\MaterialController@GuardarCategoriaMaterial');
Route::put('actualizacategoriamaterialadm/{id}', 'App\Http\Controllers\Vendedor\MaterialController@ActualizaCategoriaMaterial');
Route::get('borrarcategoriamaterialadm/{id}', 'App\Http\Controllers\Vendedor\MaterialController@BorrarCategoriaMaterial');

Route::post('guardarmaterial', 'App\Http\Controllers\Vendedor\MaterialController@GuardarMaterial');
Route::put('actualizamaterialadm/{id}', 'App\Http\Controllers\Vendedor\MaterialController@ActualizaMaterial');
Route::get('borrarmaterialadm/{id}', 'App\Http\Controllers\Vendedor\MaterialController@BorrarMaterial');



Route::get('PassResetAdmin',function(){
    return view('administracion.extras.passreset');
});


/**
 * Rutas para recepcion
 */

 
Route::resource('cita', 'App\Http\Controllers\Recepcion\CitasController');
Route::resource('reportesre', 'App\Http\Controllers\Recepcion\ReporteController');
Route::resource('configuracionnes', 'App\Http\Controllers\Recepcion\ConfiguracionController');
Route::post('configuracioncuentanes', 'App\Http\Controllers\Recepcion\ConfiguracionController@ConfiguracionCuenta');
Route::post('CambioPassnes/{id}', 'App\Http\Controllers\Recepcion\ConfiguracionController@CambioPass');




Route::resource('microgeneradoresa','App\Http\Controllers\Recepcion\MgeneradoresController');
Route::get('ConfirmarMicro/{id}','App\Http\Controllers\Recepcion\MgeneradoresController@ConfirmarMicro');

Route::resource('transferencias', 'App\Http\Controllers\Recepcion\TransferenciaController');
Route::get('recepciones', 'App\Http\Controllers\Recepcion\TransferenciaController@Recepciones');

Route::get('envios', 'App\Http\Controllers\Recepcion\TransferenciaController@Envios');
Route::get('transferencias_confirmar/{id}', 'App\Http\Controllers\Recepcion\TransferenciaController@Confirmar');
/**
 * Rutas para finanzas 
 */

Route::resource('saldosfi', 'App\Http\Controllers\Finanzas\PagoController');

Route::post('PagoClienteFinanzas','App\Http\Controllers\Finanzas\PagoController@PagoClienteFinanzas');


Route::resource('pagosvalidacion', 'App\Http\Controllers\Finanzas\PagoValidacionController');
Route::post('CancelarPagoF/{id}', 'App\Http\Controllers\Finanzas\PagoValidacionController@CancelarPago');
Route::post('VerificarPagoF/{id}', 'App\Http\Controllers\Finanzas\PagoValidacionController@VerificarPago');

Route::resource('obrasfi', 'App\Http\Controllers\Finanzas\ObraController');
Route::resource('generadoresfi', 'App\Http\Controllers\Finanzas\GeneradorController');
Route::resource('kpifi', 'App\Http\Controllers\Finanzas\KpiController');
Route::resource('materialesfi', 'App\Http\Controllers\Finanzas\MaterialController');
Route::resource('reportesfi', 'App\Http\Controllers\Finanzas\ReporteController');


Route::get('ReporteObrasFinanzas','App\Http\Controllers\Finanzas\ReporteController@Geppettos');

Route::get('ReportePagosFinanzas/{id_planta}/{inipago}/{finpago}', 'App\Http\Controllers\Finanzas\ReporteController@ReportePagosFinanzas');



/**
 * Rutas para dosificadores 
 */








Route::resource('choferesd', 'App\Http\Controllers\Dosificadores\ChoferController');

Route::resource('vehiculosd', 'App\Http\Controllers\Dosificadores\VehiculoController');


Route::get('LlegadaPlanta/{id}','App\Http\Controllers\Dosificadores\PedidoController@LlegadaPlanta');

Route::get('GenerarCodigoRecoleccion/{id}', 'App\Http\Controllers\Dosificadores\PedidoController@GenerarCodigoRecoleccion');





Route::get('Trackingd', 'App\Http\Controllers\Dosificadores\TrackingController@Tracking');

/**
 * Recuperacion de contraseñas 
 */
Route::post('RecuperarAdmin','App\Http\Controllers\LoginController@RecuperarAdmin');

Route::get('AdminPass/{id}',function($id){
    $token=Token::find($id);
    if($token){
        return view('administracion.extras.pass',['id'=>$id]);
    }else{
        return redirect('home')->with('error','No se encontró la petición o ya se ultilizó el link anteriormente.');
    }
});


Route::post('GuardarPassAdmin/{id}','App\Http\Controllers\LoginController@GuardarPassAdmin');




/**
 * Rutas para guardar catalogo que todas apuntan al controlador Asociacion\CatalogosController.
 */
Route::post('guardarplanta', 'App\Http\Controllers\Asociacion\CatalogosController@GuardarPlanta');

Route::post('guardartipoobra', 'App\Http\Controllers\Asociacion\CatalogosController@GuardarTipoobra');
Route::get('borrartipoobra/{id}', 'App\Http\Controllers\Asociacion\CatalogosController@BorrarTipoobra');


Route::post('guardarcategoriamaterial', 'App\Http\Controllers\Asociacion\CatalogosController@GuardarCategoriaMaterial');
Route::get('borrarcategoriamaterial/{id}', 'App\Http\Controllers\Asociacion\CatalogosController@BorrarCategoriaMaterial');

Route::put('actualizamaterial/{id}', 'App\Http\Controllers\Asociacion\CatalogosController@ActualizaMaterial');
Route::get('borrarmaterial/{id}', 'App\Http\Controllers\Asociacion\CatalogosController@BorrarMaterial');

Route::post('guardarcondicion', 'App\Http\Controllers\Asociacion\CatalogosController@GuardarCondicion');
Route::get('borrarcondicion/{id}', 'App\Http\Controllers\Asociacion\CatalogosController@BorrarCondicion');



//Route::get('borrarproducto/{id}', 'App\Http\Controllers\Asociacion\CatalogosController@BorrarProducto');

/**
 * Confirmaciones de generadores, obras y no se que mas vaya a haber
 */

Route::get('confirmargenerador/{id}', 'App\Http\Controllers\Asociacion\GeneradorController@ConfirmarGenerador');





/**
 * Sacar formatos por id
 */
Route::get('contrato/{id}', 'App\Http\Controllers\FormatosController@Contrato');
Route::get('transferencia/{id}', 'App\Http\Controllers\FormatosController@Transferencia');



/**
 * Rutas para residentes
 */

Route::resource('residentes', 'App\Http\Controllers\ResidenteController');
Route::get('registroresidente', 'App\Http\Controllers\ResidenteController@RegistroResidente');
Route::resource('pedidos', 'App\Http\Controllers\PedidoController');
Route::get('carrito', 'App\Http\Controllers\PedidoController@Carrito');
Route::get('cotizacion/{id}', 'App\Http\Controllers\PedidoController@Cotizacion');
Route::get('QuitardelCarrito/{id}','App\Http\Controllers\PedidoController@QuitardelCarrito');

Route::get('catalogo', 'App\Http\Controllers\PedidoController@Catalogo');

Route::get('logistica', 'App\Http\Controllers\PedidoController@Logistica');
/**
 * Rutas para informacion de SEDEMA
 */

 

Route::resource('plantas','App\Http\Controllers\Sedema\PlantaController');
Route::get('GraficaVolumenSEDEMA','App\Http\Controllers\Sedema\PlantaController@GraficaVolumenSEDEMA');
Route::get('CitasSedemaPlanta','App\Http\Controllers\Sedema\PlantaController@CitasSedemaPlanta');
Route::get('GraficasMaterialMesSEDEMA','App\Http\Controllers\Sedema\PlantaController@GraficasMaterialMesSEDEMA');

Route::resource('sedemag', 'App\Http\Controllers\Sedema\GeneradorController');
Route::get('sedemag/{con}/{id}', 'App\Http\Controllers\Sedema\GeneradorController@show');
Route::get('sedemad/{con}/{id}', 'App\Http\Controllers\Sedema\GeneradorController@Dashboard');

Route::resource('sedemao', 'App\Http\Controllers\Sedema\ObraController');
Route::get('sedemao/{id}', 'App\Http\Controllers\Sedema\ObraController@show');

Route::get('reporte/{id}', 'App\Http\Controllers\Sedema\ObraController@Reporte');
Route::get('reporteobra/{id}', 'App\Http\Controllers\Cliente\ObraController@ReporteObra');


Route::resource('configuraciones', 'App\Http\Controllers\Sedema\ConfiguracionController');
Route::post('DatosCuentaEdit', 'App\Http\Controllers\Sedema\ConfiguracionController@DatosCuentaEdit');


Route::resource('admsedema', 'App\Http\Controllers\Sedema\AdministradorController');
Route::get('quitaradminsedema/{id}', 'App\Http\Controllers\Sedema\AdministradorController@QuitarAdmin');


Route::get('GraficasPagosClienteSedema/{con}/{id}','App\Http\Controllers\Sedema\GeneradorController@GraficasPagosClienteSedema');



/**
 * Correos
 */


Route::get('confirmacion/{id}','App\Http\Controllers\LoginController@Confirmacion');


Route::get('confirmaciont/{id}','App\Http\Controllers\LoginController@Confirmaciont');

/**
 * Pagos cliente
 */

Route::post('PagoCliente', 'App\Http\Controllers\PagosController@PagoCliente');


Route::get('ContratoRC/{id}', 'App\Http\Controllers\FormatosController@ContratoRC');
//Route::get('ContratoRCT/{id}', 'App\Http\Controllers\FormatosController@ContratoRCT');



/**
 * Rutas android
 */
Route::get('TCRecitrackTrasporte',function(){
    return view('formatos.TCRecitrackTrasporte');
});

Route::get('AvisoPrivacidad',function(){
    return view('formatos.aviso_privacidad');
});




Route::get('RegistroChofer','App\Http\Controllers\Android\RecitrackTransporte\Choferes\ChoferController@index');
Route::post('RegistroChofer','App\Http\Controllers\Android\RecitrackTransporte\Choferes\ChoferController@store');

Route::get('Token/{id}','App\Http\Controllers\Android\RecitrackTransporte\Choferes\ChoferController@Token');

Route::get('DatosChofer/{id}/{token}','App\Http\Controllers\Android\RecitrackTransporte\Choferes\ChoferController@DatosChofer');
Route::put('UpdateChofer/{id}','App\Http\Controllers\Android\RecitrackTransporte\Choferes\ChoferController@UpdateChofer');

Route::get('PassChofer/{id}/{token}','App\Http\Controllers\Android\RecitrackTransporte\Choferes\ChoferController@PassChofer');
Route::put('UpdateChoferPass/{id}','App\Http\Controllers\Android\RecitrackTransporte\Choferes\ChoferController@UpdateChoferPass');


Route::get('DocsChofer/{id}/{token}','App\Http\Controllers\Android\RecitrackTransporte\Choferes\ChoferController@DocsChofer');
Route::put('UpdateChoferDocs/{id}','App\Http\Controllers\Android\RecitrackTransporte\Choferes\ChoferController@UpdateChoferDocs');

Route::get('citarev/{id}/{admin}','App\Http\Controllers\Android\CitaController@CitaRev');
Route::put('citaconfirmacion/{id}/{admin}','App\Http\Controllers\Android\CitaController@CitaConfirmacion');
Route::get('ConfirmacionChofer/{id}','App\Http\Controllers\Android\RecitrackTransporte\Choferes\LoginController@Confirmacion');

Route::get('EntregarViajeFirma/{id}/{entrada}/{descarga}','App\Http\Controllers\Android\RecitrackTransporte\Choferes\RemisionesController@EntregarViajeFirma');
Route::post('EntregarViaje/{id}','App\Http\Controllers\Android\RecitrackTransporte\Choferes\RemisionesController@EntregarViaje');


 /**
  * Micreogeneradores
  */

  Route::resource('microgeneradores','App\Http\Controllers\Mgeneradores\MgeneradoresController');
  


/**
* Rutas generales
*/


Route::post('Cargarcomprobante', 'App\Http\Controllers\PedidoController@Cargarcomprobante');
Route::get('boleta/{id}', 'App\Http\Controllers\General\CitaController@boleta');
Route::get('boleta2/{id}', 'App\Http\Controllers\General\CitaController@boleta2');
Route::get('manifiesto/{id}', 'App\Http\Controllers\General\CitaController@manifiesto'); 
Route::get('terminacion/{id}', 'App\Http\Controllers\General\ObraController@terminacion'); 

Route::get('manifiestodescarga/{id}', 'App\Http\Controllers\General\CitaController@manifiestodescarga');   
Route::get('manifiestos/{id}', 'App\Http\Controllers\General\CitaController@manifiestos');
Route::get('EntregaQr/{id}', 'App\Http\Controllers\General\CitaController@EntregaQr');


Route::get('firma/{id}', 'App\Http\Controllers\CitasController@FirmaTransporte');
Route::post('firma/{id}', 'App\Http\Controllers\CitasController@Entregar');
Route::get('Tracking', 'App\Http\Controllers\General\TrackingController@Tracking');




Route::post('GenerarRemision/{id}','App\Http\Controllers\General\AdminCliente\PedidoController@GenerarRemision');

//
//Administracion generales



Route::resource('pedidosd', 'App\Http\Controllers\General\Administracion\PedidoController');


Route::get('RemisionWeb/{id}', 'App\Http\Controllers\General\Administracion\PedidoController@RemisionWeb');

Route::post('AceptarViajeWeb/{id}', 'App\Http\Controllers\General\Administracion\PedidoController@AceptarViajeWeb');

Route::post('BuscarCodigo','App\Http\Controllers\General\Administracion\PedidoController@BuscarCodigo');




Route::resource('estimaciones','App\Http\Controllers\General\Administracion\EstimacionController');

Route::resource('registros','App\Http\Controllers\General\Administracion\RegistroController');
Route::get('GraficasRegistrosObras','App\Http\Controllers\General\Administracion\RegistroController@GraficasRegistrosObras');

/**
 * Rutas generales->administracion
 */


Route::get('ReportePagosAdministracion/{id_planta}/{mes}/{anio}', 'App\Http\Controllers\General\Administracion\ReporteController@ReportePagosAdministracion');
Route::get('ReporteCitasAdministracion/{id_obra}/{ini}/{fin}/{id_planta}/{fotos}', 'App\Http\Controllers\General\Administracion\ReporteController@ReporteCitasAdministracion');
Route::get('ReporteTransporte/{id_obra}/{ini}/{fin}/{id_planta}', 'App\Http\Controllers\General\Administracion\ReporteController@ReporteTransporte');


/**
 * 
 * Rutas Dependencias
 */

Route::resource('obrasd','App\Http\Controllers\Dependencias\ObraController');
 
   



/**
 * Rutas desarrollo para tareas
 */


 Route::get('IdPlanta','App\Http\Controllers\Desarrollo\TareasController@IdPlanta');
 Route::get('GenerarSolicitudes','App\Http\Controllers\Desarrollo\TareasController@GenerarSolicitudes');

 


 Route::get('Fotos','App\Http\Controllers\Desarrollo\TareasController@Fotos');
 Route::get('Pass123','App\Http\Controllers\Desarrollo\TareasController@Pass123');
 
 Route::get('Contratos','App\Http\Controllers\Desarrollo\TareasController@Contratos');

 Route::get('Limite/{id}','App\Http\Controllers\Desarrollo\TareasController@Limite');
 
 Route::get('ArreglaMateriales','App\Http\Controllers\Desarrollo\TareasController@ArreglaMateriales');
 
 Route::get('tipoobra',function(){
      return $tipoobra=TipoObra::select('tipoobra',DB::raw("group_concat(subtipoobra) as subtipoobra"))->groupby('tipoobra')->get();      
 });

 Route::get('FoliosPedidos','App\Http\Controllers\Desarrollo\TareasController@FoliosPedidos');

 Route::get('getuuids',function(){
    $uidds='';
    for($i=0;$i<50;$i++){
        $uidds.='<br>'.($i+1).'.-'.GetUuid();
    }
    return $uidds;    
});


Route::get('QuitarTema',function(){
   
    return QuitarTema();    
});

Route::get('StatusObrasUpdate','App\Http\Controllers\Desarrollo\TareasController@StatusObrasUpdate');

Route::get('CorrigePrecios/{id}','App\Http\Controllers\Desarrollo\TareasController@CorrigePrecios');

Route::get('CorrigueInfoCitas/{id}','App\Http\Controllers\Desarrollo\TareasController@CorrigueInfoCitas');

Route::get('CorrigeFolios','App\Http\Controllers\Desarrollo\TareasController@CorrigeFolios');




/////Rutas random

Route::get('ReporteValorObras',function(){
    $obras=DB::table('obras')
    ->select(DB::raw("(select planta from plantas where id=obras.id_planta) as planta"),
    'obras.obra','obras.tipoobra','obras.cantidadobra',DB::raw("(obras.cantidadobra)*14000 as valor"))
    ->whereraw("obras.id_planta = '0e8332117ef04888838b4037b7e99ee3' or obras.id_planta = 'e500460066c94495b7de1f0c0a8204d9'")
    ->get();
   
    return Excel::download(new ReporteValorObras($obras), 'ReporteValorObras.xlsx');     
});



////Rutas publicidades  

Route::resource('banners','App\Http\Controllers\Publicidad\BannerController');

Route::post('CargarBCitas', 'App\Http\Controllers\Publicidad\BannerController@CargarBCitas');

Route::resource('CorreoClientes','App\Http\Controllers\Publicidad\CorreoClienteController');

Route::post('CargarClienteCorreo', 'App\Http\Controllers\Publicidad\CorreoClienteController@CargarClienteCorreo');

Route::post('ProbarCorreoCliente', 'App\Http\Controllers\Publicidad\CorreoClienteController@ProbarCorreoCliente');


Route::resource('CorreoGeneradores','App\Http\Controllers\Publicidad\CorreoGeneradorController');

Route::post('CargarGeneradorCorreo', 'App\Http\Controllers\Publicidad\CorreoGeneradorController@CargarGeneradorCorreo');

Route::resource('CorreoObras','App\Http\Controllers\Publicidad\CorreoObraController');

Route::post('CargarObraCorreo', 'App\Http\Controllers\Publicidad\CorreoObraController@CargarObraCorreo');


/**
 * Rutas Uia
 */

 

 Route::resource('inspectores','App\Http\Controllers\Uia\InspectorController');

 Route::post('EliminarInspector/{id}','App\Http\Controllers\Uia\InspectorController@EliminarInspector');


Route::resource('formularios','App\Http\Controllers\Uia\FormularioController');

Route::get('EliminarEncuesta/{id}','App\Http\Controllers\Uia\FormularioController@EliminarEncuesta');
Route::get('DestroyEncuesta/{id}','App\Http\Controllers\Uia\FormularioController@DestroyEncuesta');
 


Route::Post('GuardarNombreEncuesta/{id}','App\Http\Controllers\Uia\FormularioController@GuardarNombreEncuesta');

Route::Post('UpdatePregunta/{id}','App\Http\Controllers\Uia\FormularioController@UpdatePregunta');

Route::resource('encuestasadm','App\Http\Controllers\Uia\EncuestaController');



/**
 * Ruta Inspectores
 */


 
Route::resource('encuestas','App\Http\Controllers\Inspeccion\InspeccionController');

Route::get('informe/{id}','App\Http\Controllers\Inspeccion\InspeccionController@Informe');

Route::Post('GuardarInforme','App\Http\Controllers\Inspeccion\InspeccionController@GuardarInforme');


Route::Post('AdjuntarArchivos','App\Http\Controllers\Inspeccion\InspeccionController@AdjuntarArchivos');