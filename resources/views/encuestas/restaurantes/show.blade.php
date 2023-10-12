<!DOCTYPE html>
<html lang="en">
<head>
  @include('encuestas.header')
  <title>CSMX | Registro Restaurante</title>
  
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('encuestas.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('encuestas.sidebars.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
     
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-utensils" aria-hidden="true"></i> Registro de Restaurante</h3>            
                </div>
                <!-- /.card-header -->
                    <form method="POST" action="{{url('restaurantes')}}/{{$id}}" id="formnegocio" enctype="multipart/form-data">
                    @csrf
                    <input name="_method" type="hidden" value="PUT">
                    
                    <div class="card-body">  

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Datos del Establecimiento</h3>
                            </div>
                            <div class="card-body">
                                
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="negocio">Nombre del propietario de este establecimiento:</label>
                                            <input  required type="text" name="cliente" value="{{$restaurante->cliente}}" class="form-control" id="cliente" placeholder="Nombre del propietario de este establecimiento" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="negocio">Raz&oacute;n Social:</label>
                                            <input required type="text" name="razonsocial" value="{{$restaurante->razonsocial}}" class="form-control" id="razonsocial" placeholder="Raz&oacute;n Social:" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telefono">Teléfono</label>
                                            <input required type="text" name="telefono" value="{{$restaurante->telefono}}" class="form-control" id="telefono" placeholder="Teléfono"  aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="contactocomercial">Nombre completo del Contacto Comercial:</label>
                                            <input required type="text" name="contactocomercial" value="{{$restaurante->contactocomercial}}" class="form-control" id="contactocomercial" placeholder="Nombre completo del Contacto Comercial:" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>


                               

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="calle">Calle</label>
                                            <input required type="text" name="calle" value="{{$restaurante->calle}}" class="form-control" id="calle" placeholder="Calle" aria-invalid="false" >
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="numeroext">Número Ext.</label>
                                            <input required type="text" name="numeroext" value="{{$restaurante->numeroext}}" class="form-control" id="numeroext" placeholder="Número Ext." aria-invalid="false" >
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="numeroint">Número Int.</label>
                                            <input required type="text" name="numeroint" value="{{$restaurante->numeroint}}" class="form-control" id="numeroint" placeholder="Número Int." aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="colonia">Colonia</label>
                                            <input required type="text" name="colonia" value="{{$restaurante->colonia}}" class="form-control" id="colonia" placeholder="Colonia"  aria-invalid="false" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="municipio">Alcaldía/Municipio</label>
                                            <input required type="text" name="municipio" value="{{$restaurante->municipio}}" class="form-control" id="municipio" placeholder="Alcaldía/Municipio"  aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cp">C.P.</label>
                                            <input required type="text" name="cp" value="{{$restaurante->cp}}" class="form-control" id="cp" placeholder="C.P."  aria-invalid="false" >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="entidad">Entidad Federativa</label>
                                            
                                            <select required name="entidad"  class="form-control" id="entidad" aria-invalid="false" >
                                                <option value="{{$restaurante->entidad}}">{{$restaurante->entidad}}</option>
                                                @foreach($entidades as $entidad)
                                                <option value="{{$entidad->entidad}}">{{$entidad->entidad}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                  
                                </div>


                                <div class="row">                                    
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="giro">¿A qué giro pertenece principalmente su establecimiento?</label>
                                            <input required type="text" name="giro" value="{{$restaurante->giro}}" class="form-control" id="giro" placeholder="Giro"  aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="ncomensales">¿Cuántos comensales atiende este establecimiento (clientes sentados) ?</label>
                                            <input required type="text" name="ncomensales" value="{{$restaurante->ncomensales}}" class="form-control" id="ncomensales" placeholder="Ej. 30-50" pattern="[0-9\-]+" title="formato incorrecto"  aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="aforo">¿Cuál es el aforo máximo del establecimiento?</label>
                                            <input required type="text" name="aforo" value="{{$restaurante->aforo}}" class="form-control" id="aforo" placeholder="Ej. 30-50" pattern="[0-9\-]+" title="formato incorrecto"  aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="row">                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="superficie">¿Cuántos m2 de superficie tiene su establecimiento?</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input required type="text" name="superficie" value="{{$restaurante->superficie}}" class="form-control" id="superficie" placeholder="Ej. 30-50" pattern="[0-9\-]+" title="formato incorrecto"  aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="antiguedad">¿Cuántos años lleva su negocio abierto?</label>
                                        
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input required type="number" name="antiguedad" value="{{$restaurante->antiguedad}}" step="1" min="1" class="form-control" id="antiguedad" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="afiliado">¿Se encuentra afiliado a la Cámara Nacional de la Industria de Restaurantes y Alimentos Condimentados (CANIRAC) ?</label>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <select  required name="afiliado" value="" class="form-control" id="afiliado" aria-invalid="false" >
                                                <option value="{{$restaurante->afiliado}}">{{$restaurante->afiliado}}</option>
                                                <option value="Sí">Sí</option>
                                                <option value="No">No</option>
                                                <option value="No sé">No sé</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="franquicia">¿Su establecimiento forma parte de una franquicia?</label>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <select  required name="franquicia" value="{{$restaurante->franquicia}}" class="form-control" id="franquicia" aria-invalid="false" >
                                                <option value="{{$restaurante->franquicia}}">{{$restaurante->franquicia}}</option>
                                                <option value="Sí">Sí</option>
                                                <option value="No">No</option>
                                                <option value="No sé">No sé</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">                                    
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="categoria">¿En qué categoría considera que se encuentra su restaurante?</label>
                                            <input required type="text" name="categoria" value="{{$restaurante->categoria}}" class="form-control" id="categoria" placeholder="Categoria"   aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>
                                
                                
                               
                            </div>
                        </div>
                       

                       
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Su establecimiento cuenta con:</h3>
                            </div>
                            <div class="card-body">


                                <div class="row">                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="wifi">Wi-Fi</label>
                                            <select  required name="wifi" value="" class="form-control" id="wifi" aria-invalid="false" >
                                                <option value="{{$restaurante->wifi}}">{{$restaurante->wifi}}</option>
                                                <option value="Sí">Sí</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="areainfantil">Área Infantil.</label>
                                            <select  required name="areainfantil" value="" class="form-control" id="areainfantil" aria-invalid="false" >
                                                <option value="{{$restaurante->areainfantil}}">{{$restaurante->areainfantil}}</option>
                                                <option value="Sí">Sí</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="aireacon">Aire acondicionado.</label>
                                            <select  required name="aireacon" value="" class="form-control" id="aireacon" aria-invalid="false" >
                                                <option value="{{$restaurante->aireacon}}">{{$restaurante->aireacon}}</option>
                                                <option value="Sí">Sí</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="row">                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="reservacion">Servicio de reservación.</label>
                                            <select  required name="reservacion" value="" class="form-control" id="reservacion" aria-invalid="false" >
                                                <option value="{{$restaurante->reservacion}}">{{$restaurante->reservacion}}</option>
                                                <option value="Sí">Sí</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="row">                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="entrega">Entrega a Domicilio.</label>
                                            <select  required name="entrega" value="" class="form-control" id="entrega" aria-invalid="false" >
                                                <option value="{{$restaurante->entrega}}">{{$restaurante->entrega}}</option>
                                                <option value="Sí">Sí</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="row">                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="llevar">Servicio para llevar.</label>
                                            <select  required name="llevar" value="" class="form-control" id="llevar" aria-invalid="false" >
                                                <option value="{{$restaurante->llevar}}">{{$restaurante->llevar}}</option>
                                                <option value="Sí">Sí</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="row">                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="trampas">Trampas de grasa.</label>
                                            <select  required name="trampas" value="" class="form-control" id="trampas" aria-invalid="false" >
                                                <option value="{{$restaurante->trampas}}">{{$restaurante->trampas}}</option>
                                                <option value="Sí">Sí</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>                
                        


                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Clasificaci&oacute;n</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">                                    
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="clasificacion">¿Cómo se clasifica su restaurante?</label>
                                            <input required type="text" name="clasificacion" value="{{$restaurante->clasificacion}}" class="form-control" id="clasificacion" placeholder="¿Cómo se clasifica su restaurante?"   aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>


                                <div class="row">                                    
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="rangoprecio">Rango de Precios por persona en el que se encuentra su restaurante?</label>
                                            <input required type="text" name="rangoprecio" value="{{$restaurante->rangoprecio}}" class="form-control" id="rangoprecio" placeholder="Ej. 320-500" pattern="[0-9\-]+" title="formato incorrecto"  aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>    
                        
                        

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Reciclaje</h3>
                            </div>
                            <div class="card-body">

                                <div class="row">                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="reciclaje">¿Practica usted el reciclaje de residuos sólidos?</label>
                                            
                                        </div>
                                    </div>
                                </div>


                                <div class="row">                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <select  required name="reciclaje" value="" class="form-control" id="reciclaje" aria-invalid="false" >
                                                <option value="{{$restaurante->reciclaje}}">{{$restaurante->reciclaje}}</option>
                                                <option value="Sí">Sí</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="tresiduo">¿Qué tipos de Residuos Sólidos desecha con más frecuencia?</label>
                                            <input required type="text" name="tresiduo" value="{{$restaurante->tresiduo}}" class="form-control" id="tresiduo" placeholder="Residuos" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="bolsas">¿Cuántas bolsas de basura genera su establecimiento al día?</label>
                                            <input required type="text" name="bolsas" value="{{$restaurante->bolsas}}" class="form-control" id="bolsas" placeholder="Ej. 320-500" pattern="[0-9\-]+" title="formato incorrecto"  aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>


                                <div class="row">                                    
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="pagos">¿El año pasado realizó sus pagos al municipio de Lazaro Cardenas por la recolección de residuos que genera su establecimiento?</label>
                                            <input required type="text" name="pagos" value="{{$restaurante->pagos}}" class="form-control" id="pagos" placeholder=""    aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="row">                                    
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="contrata">¿ Usted contrata a empresas certificadas para la recolección y manejo de residuos sólidos en la isla.?</label>
                                            <input required type="text" name="contrata" value="{{$restaurante->contrata}}" class="form-control" id="contrata" placeholder=""    aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>



                                
                                <div class="row">                                    
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="horarios">¿En qué horario acostumbra usted sacar su basura?</label>
                                            <input required type="text" name="horarios" value="{{$restaurante->horarios}}" class="form-control" id="horarios" placeholder="" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>


                                <div class="row">                                    
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="donde">¿Donde coloca usted su basura?</label>
                                            <input required type="text" name="donde" value="{{$restaurante->donde}}" class="form-control" id="donde" placeholder=""  aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>


                                <div class="row">                                    
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="tratamiento">¿Cómo es su tratamiento de aguas residuales?</label>
                                            <input required type="text" name="tratamiento" value="{{$restaurante->tratamiento}}" class="form-control" id="tratamiento" placeholder=""    aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>


                               

                            </div>
                        </div>   



                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Redes sociales</h3>
                            </div>
                            <div class="card-body">

                                <div class="row">                                    
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="correo">¿Cuenta con correo Electrónico?</label>
                                            <input required type="text" name="correo" value="{{$restaurante->correo}}" class="form-control" id="correo" placeholder=""    aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="facebook">Facebook</label>
                                            <select  required name="facebook" value="" class="form-control" id="facebook" aria-invalid="false" >
                                                <option value="{{$restaurante->facebook}}">{{$restaurante->facebook}}</option>
                                                <option value="Sí">Sí</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="instagram">Instagram</label>
                                            <select  required name="instagram" value="" class="form-control" id="instagram" aria-invalid="false" >
                                                <option value="{{$restaurante->instagram}}">{{$restaurante->instagram}}</option>
                                                <option value="Sí">Sí</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="twitter">Twitter</label>
                                            <select  required name="twitter" value="" class="form-control" id="twitter" aria-invalid="false" >
                                                <option value="{{$restaurante->twitter}}">{{$restaurante->twitter}}</option>
                                                <option value="Sí">Sí</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="youtube">You Tube</label>
                                            <select  required name="youtube" value="" class="form-control" id="youtube" aria-invalid="false" >
                                                <option value="{{$restaurante->youtube}}">{{$restaurante->youtube}}</option>
                                                <option value="Sí">Sí</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="tiktok">Tik Tok.</label>
                                            <select  required name="tiktok" value="" class="form-control" id="tiktok" aria-invalid="false" >
                                                <option value="{{$restaurante->tiktok}}">{{$restaurante->tiktok}}</option>
                                                <option value="Sí">Sí</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>   



                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Impacto por COVID-19 y medidas sanitarias en el establecimiento</h3>
                            </div>
                            <div class="card-body">

                            <div class="row">                                    
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="ventas">¿Comparado con el mismo mes del año anterior, ¿cómo se comportaron las ventas de su empresa durante enero?</label>
                                            <input required type="text" name="ventas" value="{{$restaurante->ventas}}" class="form-control" id="ventas" placeholder=""  aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>


                                <div class="row">                                    
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="cerrar">¿Ha considerado cerrar su establecimiento de manera definitiva?</label>
                                            <input required type="text" name="cerrar" value="{{$restaurante->cerrar}}" class="form-control" id="cerrar" placeholder=""  aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>


                                <div class="row">                                    
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="razon">¿Cuál considera que sería la principal razón para cerrar su establecimiento?</label>
                                            <input required type="text" name="razon" value="{{$restaurante->razon}}" class="form-control" id="razon" placeholder=""  aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>


                                <div class="row">                                    
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="despedir">¿Su establecimiento se ha visto en la necesidad de despedir personal debido a la contingencia?</label>
                                            <input required type="text" name="despedir" value="{{$restaurante->despedir}}" class="form-control" id="despedir" placeholder=""  aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="plantilla">¿Qué porcentaje del total de su plantilla laboral considera que fue o se verá afectada?</label>
                                            <input required type="text" name="plantilla" value="{{$restaurante->plantilla}}" class="form-control" id="plantilla" placeholder=""  aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="medidas">¿Ha implementado medidas sanitarias en su establecimiento?</label>
                                           
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <select  required name="medidas" value="" class="form-control" id="medidas" aria-invalid="false" >
                                                <option value="{{$restaurante->medidas}}">{{$restaurante->medidas}}</option>
                                                <option value="Sí">Sí</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>




                                <div class="row">                                    
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="implemento">¿Qué medidas sanitarias implementó para su establecimiento?</label>
                                            <input required type="text" name="implemento" value="{{$restaurante->implemento}}" class="form-control" id="implemento" placeholder=""  aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>                               
                               
                            </div>
                        </div>   



                        
                        
                        
                    </div><!--End body-->
                    <div class="card-footer" >
                        <button required type="submit" id="guardar" class="btn  btn-info float-right">Guardar</button>
                    </div>
                    </form>
                
            </div>
            <br>          
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);

 
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
<script>
    var markers = [];
    function initMap() {
        const myLatlng = { lat:  20.248882446801847, lng: -101.45472227050904 };
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 4,
          center: myLatlng,
        });
        // Create the initial InfoWindow.
        let infoWindow = new google.maps.InfoWindow({
          content: "Seleccione ubicación",
          position: myLatlng,
        });
        infoWindow.open(map);
        // Configure the click listener.
         
        map.addListener("click", (mapsMouseEvent) => {
            // Close the current InfoWindow.
            infoWindow.close();
            DeleteMarkers()
            // Create a new InfoWindow.
            infoWindow = new google.maps.InfoWindow({
              position: mapsMouseEvent.latLng,
            });
            var coordenadas=mapsMouseEvent.latLng.toJSON();
            $('#latitud').val(coordenadas.lat);
            $('#longitud').val(coordenadas.lng);
            const coornegocio = { lat:  coordenadas.lat*1, lng: coordenadas.lng*1 };
            const marker = new google.maps.Marker({
            position: coornegocio,
            map,
            title:$('#negocio').val()
            });
             //Add marker to the array.
            markers.push(marker);
            infoWindow.setContent('La negocio se localiza:<br>Latitud:'+coordenadas.lat+'<br>Longitud:'+coordenadas.lng);
          
            infoWindow.open(map,marker);
          
        });
    }
      
</script>

@include('MapsApi')


@include('footer')
</body>
</html>
