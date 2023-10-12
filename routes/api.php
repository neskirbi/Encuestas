<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Chofer;
use App\Models\PreVerificacion;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/**
 * Apis Soporte
 */


Route::post('GuardarMunicipio','App\Http\Controllers\Soporte\ApiController@GuardarMunicipio');


/**
 * 
 * Apis Director
 */

 
Route::post('StatusObrasDirector', 'App\Http\Controllers\Director\ApiController@StatusObrasDirector');
Route::post('GetObrasPagosFin', 'App\Http\Controllers\Director\ApiController@GetObrasPagosFin');




/**
 * Apis Administrador
 */

Route::post('SaldoNegativo','App\Http\Controllers\Administracion\ApiController@SaldoNegativo');
Route::post('CambiaFecha','App\Http\Controllers\Administracion\ApiController@CambiaFecha');
Route::post('CargarFoto','App\Http\Controllers\Administracion\ApiController@CargarFoto');
Route::post('BorrarFoto','App\Http\Controllers\Administracion\ApiController@BorrarFoto');
Route::post('HabilitarDeshabilitar','App\Http\Controllers\Administracion\ApiController@HabilitarDeshabilitar');
Route::post('GetVehiculoInfo','App\Http\Controllers\Dosificadores\ApiController@GetVehiculoInfo');
Route::post('ActivarPlanta','App\Http\Controllers\Administracion\ApiController@ActivarPlanta');
Route::post('EnviarCorreoRC','App\Http\Controllers\Administracion\ApiController@EnviarCorreoRC');

Route::post('ReportePagos', 'App\Http\Controllers\Administracion\ApiController@ReportePagos');
Route::post('ReporteCitas', 'App\Http\Controllers\Administracion\ApiController@ReporteCitas');
Route::post('ReporteStatusObrasPre', 'App\Http\Controllers\Administracion\ApiController@ReporteStatusObrasPre');

Route::post('ReporteTransportePre', 'App\Http\Controllers\Administracion\ApiController@ReporteTransportePre');

/**
 * SEDEMA
 */

 
Route::post('AvanceEntregasSedema', 'App\Http\Controllers\Sedema\ApiController@AvanceEntregasSedema');

Route::post('CargaPlantas', 'App\Http\Controllers\Sedema\ApiController@CargaPlantas');



/**
 * Apis clientes
 */

Route::post('AvanceEntregas', 'App\Http\Controllers\Cliente\ApiController@AvanceEntregas');



Route::post('CorreoExisteAdmin', 'App\Http\Controllers\ApisController@CorreoExisteAdmin');

Route::post('CorreoExiste', 'App\Http\Controllers\ApisController@CorreoExiste');

Route::post('GetHoras', 'App\Http\Controllers\ApisController@GetHoras');

Route::post('GetMateriales', 'App\Http\Controllers\ApisController@GetMateriales');

Route::get('GetCategoriasMaterial/{id_planta}', 'App\Http\Controllers\ApisController@GetCategoriasMaterial');

Route::post('MaterialesObraTodos', 'App\Http\Controllers\ApisController@MaterialesObraTodos');
Route::post('MaterialesObraDeclarados', 'App\Http\Controllers\ApisController@MaterialesObraDeclarados');
Route::post('Matricula', 'App\Http\Controllers\ApisController@Matricula');
Route::post('Razon', 'App\Http\Controllers\ApisController@Razon');
Route::post('SubTipoObra', 'App\Http\Controllers\ApisController@SubTipoObra');

Route::post('GuardarVehiculo', 'App\Http\Controllers\ApisController@GuardarVeiculo');


Route::post('AvanceFecha', 'App\Http\Controllers\ApisController@AvanceFecha');

Route::post('Clientes', 'App\Http\Controllers\ApisController@Clientes');

Route::post('GetGeneradorDatos', 'App\Http\Controllers\ApisController@GetGeneradorDatos');





Route::post('DetalleEntregas', 'App\Http\Controllers\ApisController@DetalleEntregas');
Route::post('CatalogoObraProducto', 'App\Http\Controllers\ApisController@CatalogoObraProducto');
Route::post('CatalogoObraTransporte', 'App\Http\Controllers\ApisController@CatalogoObraTransporte');

Route::post('AgregarCarrito', 'App\Http\Controllers\ApisController@AgregarCarrito');

Route::post('PuedeGastar','App\Http\Controllers\General\ApiController@PuedeGastar');
Route::post('MunicipiosApi','App\Http\Controllers\General\ApiController@MunicipiosApi');



/**
 * Correos
 */


Route::post('CorreoConfirmApi','App\Http\Controllers\CorreoController@CorreoConfirmApi');




Route::post('CargarFotoProducto','App\Http\Controllers\ApisController@CargarFotoProducto');
Route::post('BorrarProductoFoto','App\Http\Controllers\ApisController@BorrarProductoFoto');

/**
 * Apis Android
 */
Route::post('Login','App\Http\Controllers\Android\LoginController@Login');

Route::post('BoletaQr','App\Http\Controllers\Android\CitaController@BoletaQr');



/**
 * Recitrack Transporte
 */

Route::post('Coordenadas','App\Http\Controllers\Android\General\CoordenadaController@Coordenadas');
Route::post('LoginChofer','App\Http\Controllers\Android\RecitrackTransporte\Choferes\LoginController@Login');
Route::post('DataCita','App\Http\Controllers\Android\RecitrackTransporte\Choferes\ScanerController@DataCita');
Route::post('AceptarCita','App\Http\Controllers\Android\RecitrackTransporte\Choferes\ScanerController@AceptarCita');
Route::post('Entregado','App\Http\Controllers\Android\RecitrackTransporte\ScanerController@Entregado');
Route::post('HistorialViajes','App\Http\Controllers\Android\RecitrackTransporte\Choferes\ViajesController@HistorialViajes');
Route::post('GetTotal','App\Http\Controllers\Android\RecitrackTransporte\Choferes\ViajesController@GetTotal');
Route::post('SolicitarPago','App\Http\Controllers\Android\RecitrackTransporte\Choferes\ViajesController@SolicitarPago');
Route::post('GetSolicitudes','App\Http\Controllers\Android\RecitrackTransporte\Choferes\ViajesController@GetSolicitudes');

////Entregas 
Route::post('Viajes','App\Http\Controllers\Android\RecitrackTransporte\Choferes\RemisionesController@Viajes');
Route::post('AceptarViaje','App\Http\Controllers\Android\RecitrackTransporte\Choferes\RemisionesController@AceptarViaje');
Route::post('EnviarCodigo',function(Request $request){
    
    $length = 5;
    $codigo = substr(str_repeat(0, $length).rand(1,9999), - $length);
    //return EnviarMensaje($request->telefono,'Su numero se ha registrado en reci-track.mx, para confirmar el registro de su número vaya al siguiente link reci-track.mx/ValidacionChofer/'.$id.' .');

    if(Chofer::where('telefono',$request->telefono)->first()){
        return 3;
    }
    if(EnviarMensaje("+52".$request->telefono,'Su numero se ha registrado en reci-track.mx, Codigo: '.$codigo)){

        
        $pre=new PreVerificacion();
        $pre->id=GetUuid();
        $pre->telefono=$request->telefono;
        $pre->codigo = $codigo;
        $pre->save();
        return 1;
    }else{
        return 0;
    }




});
/**
 * Recitrac Recoleccion
 */

Route::post('RecolectorLogin','App\Http\Controllers\Android\RecitrackRecoleccion\Recolectores\LoginController@RecolectorLogin');
Route::post('CargarRecoleccion','App\Http\Controllers\Android\RecitrackRecoleccion\Recolectores\RecoleccionController@CargarRecoleccion');
//Route::post('DatosNegocio','App\Http\Controllers\Android\Recolector\RecoleccionController@DatosNegocio');

/**
 * Recitrack Clientes
 */

Route::post('Login','App\Http\Controllers\Android\Recitrack\LoginController@Login');
Route::post('Remisiones','App\Http\Controllers\Android\Recitrack\RemisionController@Remisiones');

Route::post('GetObras','App\Http\Controllers\Android\Recitrack\RemisionController@GetObras');


/**
 * Interface Sap
 */

Route::get('ClientesSAP','App\Http\Controllers\Sap\ServiciosController@ClientesSAP');
Route::get('GeneradoresSAP','App\Http\Controllers\Sap\ServiciosController@GeneradoresSAP');
Route::get('PagosSAP','App\Http\Controllers\Sap\ServiciosController@PagosSAP');
Route::get('ObrasSAP','App\Http\Controllers\Sap\ServiciosController@ObrasSAP');
Route::get('CitasSAP','App\Http\Controllers\Sap\ServiciosController@CitasSAP');

Route::get('url',function(){
    return $_SERVER['SERVER_NAME'];
});




/**
 * Rutas para inspectores
 */


 
Route::post('GetDatosObra','App\Http\Controllers\Inspeccion\Api\ApiController@GetDatosObra');


/**
 * Finanzas
 */

 
Route::post('ReportePagosFi', 'App\Http\Controllers\Finanzas\ApiController@ReportePagosFi');