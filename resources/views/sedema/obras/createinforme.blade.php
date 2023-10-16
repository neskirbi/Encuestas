<!DOCTYPE html>
<html lang="en">
<head>
  @include('sedema.header')
  <title>{{GetSiglas(0)}} | Obras</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('sedema.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('sedema.sidebars.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
     
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
      
      
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="razonsocial">Razón Social</label>
                                    <input data-invalido="true" type="text" name="razonsocial" id="razonsocial"  class="form-control" aria-invalid="false" value="{{$obra->razonsocial}}">
                                </div>
                            </div>
                        </div>

                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Representante Legal</label>
                                    <input data-invalido="true" type="text" name="repre" id="repre"  class="form-control" aria-invalid="false" value="{{$obra->repre}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <center><label>Domicilio de la Obra</label></center>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="calle">Calle</label>
                                    <input data-invalido="true" type="text" name="calle" id="calle"  class="form-control" aria-invalid="false" value="{{$obra->calle}}">
                                </div>
                            </div>

                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="numeroext"># Ext.</label>
                                    <input data-invalido="true" type="text" name="numeroext" id="numeroext"  class="form-control" aria-invalid="false" value="{{$obra->numeroext}}">
                                </div>
                            </div>

                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="numeroint"># Int.</label>
                                    <input data-invalido="true" type="text" name="numeroint" id="numeroint"  class="form-control" aria-invalid="false" value="{{$obra->numeroint}}">
                                </div>
                            </div>
                        </div>

                        

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="colonia">Colonia</label>
                                    <input data-invalido="true" type="text" name="colonia" id="colonia"  class="form-control" aria-invalid="false" value="{{$obra->colonia}}">
                                </div>
                            </div>

                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="municipio">Alcaldía-Municipio</label>
                                    <input data-invalido="true" type="text" name="municipio" id="municipio"  class="form-control" aria-invalid="false" value="{{$obra->municipio}}">
                                </div>
                            </div>

                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="entidad">Entidad</label>
                                    <input data-invalido="true" type="text" name="entidad" id="entidad"  class="form-control" aria-invalid="false" value="{{$obra->entidad}}">
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <center><label>Etapa de la Obra</label></center>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fechainicio">Obra Inicio</label>
                                    <input data-invalido="true" type="text" name="fechainicio" id="fechainicio"  class="form-control" aria-invalid="false" value="{{$obra->fechainicio}}">
                                </div>
                            </div>

                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fechafin">Obra Fin</label>
                                    <input data-invalido="true" type="text" name="fechafin" id="fechafin"  class="form-control" aria-invalid="false" value="{{$obra->fechafin}}">
                                </div>
                            </div>

                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nbo">Número de bitácora de obra asignado </label>
                                    <input data-invalido="true" type="text" name="nbo" id="nbo"  class="form-control" aria-invalid="false" >
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <center><label>Autorizaciones</label></center>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fechainicio">Impacto ambiental </label>
                                    <input data-invalido="true" type="text" name="fechainicio" id="fechainicio"  class="form-control" aria-invalid="false">
                                </div>
                            </div>

                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fechafin">Registro de generador de residuos peligrosos </label>
                                    <input data-invalido="true" type="text" name="fechafin" id="fechafin"  class="form-control" aria-invalid="false" >
                                </div>
                            </div>

                            
                           
                            
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fechainicio">Plan de Manejo de RCD </label>
                                    <input data-invalido="true" type="text" name="fechainicio" id="fechainicio"  class="form-control" aria-invalid="false">
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
          
        </div>

        <div class="callout callout-info">
            <h5>2. Señalización de la separación de residuos </h5>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <center><label>Señalización de las áreas y contenedores destinado a la separación de residuos.</label></center>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-check">
                                    <input class="form-check-input" value="1" type="radio" name="pp">
                                    <label class="form-check-label">Si</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="0" type="radio" name="pp">
                                    <label class="form-check-label">No</label>
                                    </div>                                        
                                </div>
                            </div>
                       
                            
                            <div class="col-md-8">Cuenta con la identificación de áreas y contenedores destinados a la separación de residuos de conformidad con la Tabla 1 NACDMX-007, mediante croquis, planos de áreas y fotografía </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fechainicio">Observaciones</label>
                                    <input data-invalido="true" type="text" name="fechainicio" id="fechainicio"  class="form-control" aria-invalid="false">
                                </div>
                            </div>
                        </div>
                        <hr>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-check">
                                    <input class="form-check-input" value="1" type="radio" name="pp">
                                    <label class="form-check-label">Si</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="0" type="radio" name="pp">
                                    <label class="form-check-label">No</label>
                                    </div>                                        
                                </div>
                            </div>
                       
                            
                            <div class="col-md-8">Cuenta con la identificación de áreas destinados para los RSU generados, así como la identificación de los contenedores conforme a los colores establecidos en la Tabla 2, 3, 4 y 5 de la NADF-024-AMBT-2013</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fechainicio">Observaciones</label>
                                    <input data-invalido="true" type="text" name="fechainicio" id="fechainicio"  class="form-control" aria-invalid="false">
                                </div>
                            </div>
                        </div>
                        <hr>
                        

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-check">
                                    <input class="form-check-input" value="1" type="radio" name="pp">
                                    <label class="form-check-label">Si</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="0" type="radio" name="pp">
                                    <label class="form-check-label">No</label>
                                    </div>                                        
                                </div>
                            </div>
                       
                            
                            <div class="col-md-8">Cuenta con la identificación del área destinada para los RP generados (en caso de aplicar), evitando mezclarse con los RSU. </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fechainicio">Observaciones</label>
                                    <input data-invalido="true" type="text" name="fechainicio" id="fechainicio"  class="form-control" aria-invalid="false">
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="callout callout-info">
            <h5>3. Evidencia documental</h5>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <center><label>Evidencia documental que garantiza el correcto manejo de recursos </label></center>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-check">
                                    <input class="form-check-input" value="1" type="radio" name="pp">
                                    <label class="form-check-label">Si</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="0" type="radio" name="pp">
                                    <label class="form-check-label">No</label>
                                    </div>                                        
                                </div>
                            </div>
                       
                            
                            <div class="col-md-8">Cuenta con Bitácora de generación de residuos de la construcción y demolición </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fechainicio">Observaciones</label>
                                    <input data-invalido="true" type="text" name="fechainicio" id="fechainicio"  class="form-control" aria-invalid="false">
                                </div>
                            </div>
                        </div>
                        <hr>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-check">
                                    <input class="form-check-input" value="1" type="radio" name="pp">
                                    <label class="form-check-label">Si</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="0" type="radio" name="pp">
                                    <label class="form-check-label">No</label>
                                    </div>                                        
                                </div>
                            </div>
                       
                            
                            <div class="col-md-8">Establece entradas y salidas de los residuos de los RCD, conforme a la Tabla 1.</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fechainicio">Observaciones</label>
                                    <input data-invalido="true" type="text" name="fechainicio" id="fechainicio"  class="form-control" aria-invalid="false">
                                </div>
                            </div>
                        </div>
                        <hr>
                        

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-check">
                                    <input class="form-check-input" value="1" type="radio" name="pp">
                                    <label class="form-check-label">Si</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="0" type="radio" name="pp">
                                    <label class="form-check-label">No</label>
                                    </div>                                        
                                </div>
                            </div>
                       
                            
                            <div class="col-md-8">Cuenta con los Manifiestos de Entrega-Transporte-Recepción de conformidad con la NADF-024-AMBT-2013 </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fechainicio">Observaciones</label>
                                    <input data-invalido="true" type="text" name="fechainicio" id="fechainicio"  class="form-control" aria-invalid="false">
                                </div>
                            </div>
                        </div>
                        <hr>
                        

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-check">
                                    <input class="form-check-input" value="1" type="radio" name="pp">
                                    <label class="form-check-label">Si</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="0" type="radio" name="pp">
                                    <label class="form-check-label">No</label>
                                    </div>                                        
                                </div>
                            </div>
                       
                            
                            <div class="col-md-8">Verificar que en los Manifiestos de Entrega-Transporte-Recepción, la recolección no excede de 30 días a partir de la generación de dicho residuo asentado en el registro de generación.</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fechainicio">Observaciones</label>
                                    <input data-invalido="true" type="text" name="fechainicio" id="fechainicio"  class="form-control" aria-invalid="false">
                                </div>
                            </div>
                        </div>
                        <hr>
                        

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-check">
                                    <input class="form-check-input" value="1" type="radio" name="pp">
                                    <label class="form-check-label">Si</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="0" type="radio" name="pp">
                                    <label class="form-check-label">No</label>
                                    </div>                                        
                                </div>
                            </div>
                       
                            
                            <div class="col-md-8">Cuenta con las facturas y registros de los envíos de los RSU, RCD o RP generados durante el proceso de construcción, los declarados en sus manifiestos. </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fechainicio">Observaciones</label>
                                    <input data-invalido="true" type="text" name="fechainicio" id="fechainicio"  class="form-control" aria-invalid="false">
                                </div>
                            </div>
                        </div>
                        <hr>
                        

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-check">
                                    <input class="form-check-input" value="1" type="radio" name="pp">
                                    <label class="form-check-label">Si</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="0" type="radio" name="pp">
                                    <label class="form-check-label">No</label>
                                    </div>                                        
                                </div>
                            </div>
                       
                            
                            <div class="col-md-8">Cuenta con las facturas de compra de agua tratada utilizada para minimizar la dispersión de partículas, o en su caso evidencia de la conexión a la red secundaria de agua tratada. </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fechainicio">Observaciones</label>
                                    <input data-invalido="true" type="text" name="fechainicio" id="fechainicio"  class="form-control" aria-invalid="false">
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-check">
                                    <input class="form-check-input" value="1" type="radio" name="pp">
                                    <label class="form-check-label">Si</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="0" type="radio" name="pp">
                                    <label class="form-check-label">No</label>
                                    </div>                                        
                                </div>
                            </div>
                       
                            
                            <div class="col-md-8">Evidencia física del cumplimiento de lo establecido en el plan de manejo concerniente al aprovechamiento de RCD en sitio, mediante memoria fotográfica </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fechainicio">Observaciones</label>
                                    <input data-invalido="true" type="text" name="fechainicio" id="fechainicio"  class="form-control" aria-invalid="false">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            
                            <div class="col-md-12">
                               <table width="100%" border="1px">
                                <thead>
                                    <tr>
                                        <th><center>Autorización</center></th>
                                        <th><center>Transportista</center></th>
                                        <th><center>Almacenamiento y/o Acopio </center></th>
                                        <th><center>Tratamiento/Reciclaje </center></th>
                                        <th><center>Destino Final </center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th><center>RAMIR o autorización correspondiente</center> </th>
                                        <th><input type="text" class="form-control"></th>
                                        <th><input type="text" class="form-control"></th>
                                        <th><input type="text" class="form-control"></th>
                                        <th><input type="text" class="form-control"></th>
                                    </tr>
                                    <tr>
                                        <th><center>Residuo autorizado </center></th>
                                        <th><input type="text" class="form-control"></th>
                                        <th><input type="text" class="form-control"></th>
                                        <th><input type="text" class="form-control"></th>
                                        <th><input type="text" class="form-control"></th>
                                    </tr>
                                </tbody>
                               </table>
                            </div>

                        </div>

                        
                    </div>
                    
                </div>
            </div>
        </div>

        
        <div class="callout callout-info">
            <h5>4. Adicionales (dependerá de lo condiciones de cada proyecto, así como establecido en la resolución en materia de impacto ambiental) 

 </h5>
        </div>

        
        <!-- /.row -->
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

<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>



</body>
</html>
