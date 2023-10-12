<!DOCTYPE html>
<html lang="en">
<head>
  @include('encuestas.header')
  <title>{{GetSiglas(0)}} | Registro Hotel</title>
  
  
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
                    <h3 class="card-title"><i class="fa fa-industry" aria-hidden="true"></i> Registro de Hotel</h3>            
                </div>
                <!-- /.card-header -->
                    <form method="POST" action="{{url('hoteles')}}/{{$id}}" id="formnegocio" enctype="multipart/form-data">
                    @csrf
                    <input name="_method" type="hidden" value="PUT">
                    
                    <div class="card-body">  

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Datos del Hotel</h3>
                            </div>
                            <div class="card-body">
                                
                                
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="nombrepropietario">Nombre del Propietario</label>
                                            <input required type="text" name="nombrepropietario"  value="{{$hoteles->nombrepropietario}}"  class="form-control" id="nombrepropietario" placeholder="Nombre del Propietario" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="razonsocial">Razón Social</label>
                                            <input required type="text" name="razonsocial" class="form-control"  value="{{$hoteles->razonsocial}}"  id="razonsocial" placeholder="Razón Social " aria-invalid="false" >
                                        </div>
                                    </div>
                                
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombrehotel">Nombre del Hotel</label>
                                            <input required type="text" name="nombrehotel" value="{{$hoteles->nombrehotel}}"  class="form-control" id="nombrehotel" placeholder="Nombre del Hotel " aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>


                               

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="calle">Calle</label>
                                            <input required type="text" name="calle"  value="{{$hoteles->calle}}" class="form-control" id="calle" placeholder="Calle" aria-invalid="false" >
                                        </div>
                                    </div>
                                    

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="numeroext">Número Ext.</label>
                                            <input required type="text" name="numeroext"  value="{{$hoteles->numeroext}}" class="form-control" id="numeroext" placeholder="Número Ext. "aria-invalid="false" >
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="numeroint">Número Int.</label>
                                            <input required type="text" name="numeroint" value="{{$hoteles->numeroint}}" class="form-control" id="numeroint" placeholder="Número Int. "aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="colonia">Colonia</label>
                                            <input required type="text" name="colonia" value="{{$hoteles->colonia}}" class="form-control" id="colonia" placeholder="Colonia" aria-invalid="false" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="municipio">Alcaldía/Municipio</label>
                                            <input required type="text" name="municipio" value="{{$hoteles->municipio}}" class="form-control" id="municipio" placeholder="Alcaldía/Municipio" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cp">C.P.</label>
                                            <input required type="text" name="cp" value="{{$hoteles->cp}}" class="form-control" id="cp" placeholder="C.P." aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class='row'>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="entidad">Entidad Federativa</label>
                                            <select  name="entidad" class="form-control" id="entidad" aria-invalid="false" >
                                                <option value="{{$hoteles->entidad}}">{{$hoteles->entidad}}</option>
                                                @foreach($entidades as $entidad)
                                                <option value="{{$entidad->entidad}}">{{$entidad->entidad}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                           
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="numerohabitaciones">¿Cuántas habitaciones dispone su establecimiento para hospedar?</label>
                                            <input required type="text" name="numerohabitaciones" value="{{$hoteles->numerohabitaciones}}" class="form-control" id="numerohabitaciones" placeholder="Ej. 30-50" pattern="[0-9\-]+" aria-invalid="false" >
                                        </div>
                                
                                    </div>
                                </div>    

                                <div class="row">                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="categoria"> ¿En qué categoría pertenece principalmente su establecimiento?</label>
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="row">    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select  required name="categoria" class="form-control" id="categoria" aria-invalid="false" >
                                                <option value="{{$hoteles->categoria}}">{{$hoteles->categoria}}</option>
                                                <option value="">Seleccione categoria</option>
                                                <option value="1 Estrella">1 Estrella</option>
                                                <option value="2 Estrellas">2 Estrellas</option>
                                                <option value="3 Estrellas">3 Estrellas</option>
                                                <option value="4 Estrellas">4 Estrellas</option>
                                                <option value="5 Estrellas">5 Estrellas</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="aforoenllaves">¿Cuál es el aforo máximo en llaves del establecimiento?</label>
                                            <input required type="text" name="aforoenllaves" value="{{$hoteles->aforoenllaves}}" class="form-control" id="aforoenllaves" placeholder="Ej. 30-50" pattern="[0-9\-]+" aria-invalid="false" >
                                        </div>
                                
                                    </div>
                                </div>    

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="metrosestablecimiento">¿Cuántos m2 de superficie tiene su establecimiento?</label>
                                            <input required type="text" name="metrosestablecimiento" value="{{$hoteles->metrosestablecimiento}}" class="form-control" id="metrosestablecimiento" placeholder="Ej. 30-50" pattern="[0-9\-]+" aria-invalid="false" >
                                        </div>
                                
                                    </div>
                                </div>    

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="porcentmujeres">¿Cuántos empleados tiene?</label>
                                            <input required type="text" name="porcentmujeres" value="{{$hoteles->porcentmujeres}}" class="form-control" id="porcentmujeres" placeholder="Ej. 30-50" pattern="[0-9\-]+" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="numeroempleados">Aproximadamente, ¿qué porcentaje de sus trabajadores son mujeres?</label>
                                            <input required type="text" name="numeroempleados" value="{{$hoteles->numeroempleados}}"class="form-control" id="numeroempleados" placeholder="Ej. 30-50" pattern="[0-9\-]+" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="añosnegocio">¿Cuántos años lleva su negocio abierto?</label>
                                            <input required type="text" name="añosnegocio" value="{{$hoteles->añosnegocio}}" class="form-control" id="añosnegocio" placeholder="Ej. 30-50" pattern="[0-9\-]+" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tarifanoche">¿Qué precio Tarifa maneja este establecimiento por noche?</label>
                                            <input required type="text" name="tarifanoche" value="{{$hoteles->tarifanoche}}" class="form-control" id="tarifanoche" placeholder="Ej. 30-50" pattern="[0-9\-]+" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="afiliado">¿Se encuentra afiliado a la Asociación Mexicana de Hoteles y Moteles?</label>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <select  required name="afiliado" class="form-control" id="afiliado" aria-invalid="false" >
                                                <option value="{{$hoteles->afiliado}}">{{$hoteles->afiliado}}</option>
                                                <option value=""></option>
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
                                            <select  required name="franquicia" class="form-control" id="franquicia" aria-invalid="false" >
                                                <option value="{{$hoteles->franquicia}}">{{$hoteles->franquicia}}</option>
                                                <option value=""></option>
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
                                            <label for="tratamientoagua">¿Cómo es su tratamiento de Aguas Residuales?</label>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <input required type="text" name="tratamientoagua"  value="{{$hoteles->tratamientoagua}}"  class="form-control" id="tratamientoagua" placeholder="Ej. Drenaje" aria-invalid="false" >
                                           
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="desechoresiduos">¿Qué tipos de Residuos Sólidos desecha con más frecuencia?</label>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <input required type="text" name="desechoresiduos"  value="{{$hoteles->desechoresiduos}}" class="form-control" id="desechoresiduos" placeholder="Ej. Papel" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-16">
                                        <div class="form-group">
                                            <label for="numbolsasbasura">¿Cuántas bolsas de basura genera su establecimiento al día?</label>
                                            <input required type="text" name="numbolsasbasura"  value="{{$hoteles->numbolsasbasura}}" class="form-control" id="numbolsasbasura"  placeholder="Ej. 30-50" pattern="[0-9\-]+" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="pagosrealizados">¿El año pasado realizó sus pagos al municipio de Lazaro Cardenas por la recolección de residuos que genera su establecimiento?</label>
                                            <input required type="text" name="pagosrealizados"  value="{{$hoteles->pagosrealizados}}" class="form-control" id="pagosrealizados" placeholder="Ej: Si / Realice 40 pagos por la empresa Hotel MarNovo.  Ej: No / ¿Por qué?" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="manejoresiduos">¿Usted contrata a empresas certificadas para la recolección y manejo de residuos sólidos en la isla?</label>
                                            <input required type="text" name="manejoresiduos"  value="{{$hoteles->manejoresiduos}}" class="form-control" id="manejoresiduos" placeholder="Ej: Si, por la empresa ReciclajesMx / Ej: No, por que no hay empresas certificadas" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="horariobasura">¿En qué horario acostumbra usted sacar su basura?</label>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input required type="text" name="horariobasura"  value="{{$hoteles->horariobasura}}" class="form-control" id="horariobasura"  placeholder="Horario" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>


                                <div class="row">                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            
                                            <label for="donde">¿Donde coloca usted su basura?</label>
                                            <input required type="text" name="donde"  value="{{$hoteles->donde}}" class="form-control" id="donde"  placeholder="" aria-invalid="false" >
                                           
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
                                            <select  required name="wifi" class="form-control" id="wifi" aria-invalid="false" >
                                                <option value="{{$hoteles->wifi}}">{{$hoteles->wifi}}</option>
                                                <option value=""></option>
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
                                            <select  required name="areainfantil" class="form-control" id="areainfantil" aria-invalid="false" >
                                                <option value="{{$hoteles->areainfantil}}">{{$hoteles->areainfantil}}</option>
                                                <option value=""></option>
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
                                            <select  required name="aireacon" class="form-control" id="aireacon" aria-invalid="false" >
                                                <option value="{{$hoteles->aireacon}}">{{$hoteles->aireacon}}</option>
                                                <option value=""></option>
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
                                            <select  required name="reservacion" class="form-control" id="reservacion" aria-invalid="false" >
                                                <option value="{{$hoteles->reservacion}}">{{$hoteles->reservacion}}</option>
                                                <option value=""></option>
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
                                            <select  required name="entrega" class="form-control" id="entrega" aria-invalid="false" >
                                                <option value="{{$hoteles->entrega}}">{{$hoteles->entrega}}</option>
                                                <option value=""></option>
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
                                            <select  required name="llevar" class="form-control" id="llevar" aria-invalid="false" >
                                                <option value="{{$hoteles->llevar}}">{{$hoteles->llevar}}</option>    
                                                <option value=""></option>
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
                                            <select  required name="trampas" class="form-control" id="trampas" aria-invalid="false" >
                                                <option value="{{$hoteles->trampas}}">{{$hoteles->trampas}}</option>
                                                <option value=""></option>
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
                                            <input required type="text" name="ventas" value="{{$hoteles->ventas}}" class="form-control" id="ventas" placeholder=""  aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>


                                <div class="row">                                    
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="cerrar">¿Ha considerado cerrar su establecimiento de manera definitiva?</label>
                                            <input required type="text" name="cerrar" value="{{$hoteles->cerrar}}" class="form-control" id="cerrar" placeholder=""  aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>


                                <div class="row">                                    
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="razon">¿Cuál considera que sería la principal razón para cerrar su establecimiento?</label>
                                            <input required type="text" name="razon"  value="{{$hoteles->razon}}" class="form-control" id="razon" placeholder=""  aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>


                                <div class="row">                                    
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="despedir">¿Su establecimiento se ha visto en la necesidad de despedir personal debido a la contingencia?</label>
                                            <input required type="text" name="despedir" value="{{$hoteles->despedir}}"class="form-control" id="despedir" placeholder=""  aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="plantilla">¿Qué porcentaje del total de su plantilla laboral considera que fue o se verá afectada?</label>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input required type="text" name="plantilla" value="{{$hoteles->plantilla}}" class="form-control" id="plantilla" placeholder=""  aria-invalid="false" >
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
                                            <select  required name="medidas" class="form-control" id="medidas" aria-invalid="false" >
                                                <option value="{{$hoteles->medidas}}">{{$hoteles->medidas}}</option>
                                                <option value=""></option>
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
                                            <input required type="text" name="implemento" value="{{$hoteles->implemento}}" class="form-control" id="implemento" placeholder=""  aria-invalid="false" >
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
                                            <label for="redsocial">¿Qué Redes Sociales utiliza y como aparece en ellas?</label>
                                            <input required type="text" name="redsocial" value="{{$hoteles->redsocial}}" class="form-control" id="redsocial" placeholder=""    aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="facebook">Facebook</label>
                                            <select  required name="facebook" class="form-control" id="facebook" aria-invalid="false" >
                                                <option value="{{$hoteles->facebook}}">{{$hoteles->facebook}}</option>
                                                <option value=""></option>
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
                                            <select  required name="instagram" class="form-control" id="instagram" aria-invalid="false" >
                                                <option value="{{$hoteles->instagram}}">{{$hoteles->instagram}}</option>
                                                <option value=""></option>
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
                                            <select  required name="twitter" class="form-control" id="twitter" aria-invalid="false" >
                                                <option value="{{$hoteles->twitter}}">{{$hoteles->twitter}}</option>
                                                <option value=""></option>
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
                                            <select  required name="youtube" class="form-control" id="youtube" aria-invalid="false" >
                                                <option value="{{$hoteles->youtube}}">{{$hoteles->youtube}}</option>
                                                <option value=""></option>
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
                                            <select  required name="tiktok" class="form-control" id="tiktok" aria-invalid="false" >
                                                <option value="{{$hoteles->tiktok}}">{{$hoteles->tiktok}}</option>
                                                <option value=""></option>
                                                <option value="Sí">Sí</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>   
                        
                        
                    </div><!--End body-->
                    </form>
                    <div class="card-footer" >
                        <button required type="submit" id="guardar" class="btn  btn-info float-right">Guardar</button>
                    </div>
                
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
