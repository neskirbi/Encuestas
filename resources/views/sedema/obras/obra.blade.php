<!DOCTYPE html>
<html lang="en">
<head>
  @include('sedema.header')
  <title>{{GetSiglas(0)}} | Dashboard</title>
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader 
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>-->

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
        <!-- Small boxes (Stat box) -->
        
        <div class="row">
          <div class="col-md-6">
            @foreach($obras as $obra)
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Obra</h3>
                <div class="card-tools">
                  <a href="{{url('reporte').'/'.$obra->id}}" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> Impimir</a>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4><i class="far fa-user"></i> {{$obra->razonsocial}} </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h5><i class="far fa-building"></i> {{$obra->obra}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h6><i class="fa fa-recycle"></i> {{$obra->planta}}</h6>
                    </div>
                </div>
                <div class="row">                    
                    <div class="col-md-12">
                        <b>{{$obra->nautorizacion}}</b>
                    </div> 
                </div>
                <div class="row">                    
                    <div class="col-md-12">
                        {{$obra->superficie}} {{$obra->superunidades}}
                    </div> 
                </div>
                <b>Dirección</b>
                <div class="row">                    
                    <div class="col-md-12">
                        {{$obra->calle}} {{$obra->numeroext}} {{$obra->numeroint}}
                    </div> 
                </div>

                <div class="row">                    
                    <div class="col-md-12">
                        {{$obra->colonia}}
                    </div> 
                </div>

                <div class="row">                    
                    <div class="col-md-12">
                        {{$obra->municipio}}, {{$obra->entidad}}
                    </div> 
                </div>
                <div class="row">                    
                    <div class="col-md-12">
                        Inicio: {{FechaFormateada($obra->fechainicio)}}
                    </div> 
                </div>
                <div class="row">                    
                    <div class="col-md-12">
                        Fin: {{FechaFormateada($obra->fechafin)}}
                    </div> 
                </div>
                <script>
                  /**
                   * Aqui por que agarro el id de la obra en el foreach
                   */
                    $(document).ready(function(){
                        AvanceEntregasSedema('{{$obra->id}}');
                    });
                    
                </script>
                    
               
              </div>
            </div> 
            @endforeach

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Contrato</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      @if(file_exists(('documentos/clientes/contratos').'/'.$obra->id.'.pdf'))
                      <iframe id="inlineFrameExample"
                          title="identificación"
                          width="100%"
                          height="200"
                          src="{{asset('documentos/clientes/contratos').'/'.$obra->id.'.pdf'}}">
                      </iframe>
                      <a target="_blank" class="btn btn-default" href="{{asset('documentos/clientes/contratos').'/'.$obra->id.'.pdf'}}">Ver</a>
                      @endif
                      @if(!file_exists(('documentos/clientes/contratos').'/'.$obra->id.'.pdf'))
                      <h3 title="{{asset('documentos/clientes/contratos').'/'.$obra->id.'.pdf'}}">Sin contrato</h3>
                      
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Informes Unidad de Inspección</h3>
                <div class="card-tools">
                  
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <a href="{{url('informe')}}/{{$obra->id}}" class="btn btn-info"> <i class="fas fa-plus"></i> Informe</a>
                  </div>
                </div>
                
                
              </div>
            </div>





          </div>
          <div class="col-md-6">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Volumen Declarado</h3>
              </div>
              <div class="card-body">
                <div class="avancematerial" style="height:350px;">
                  
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <!-- BAR CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Entregas diarias</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="avance">
                </div>
              </div>
              <!-- /.card-body -->
            </div>

          </div>
          <!-- /.col (RIGHT) -->
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Detalle Materiales</h3>                
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x:scroll;">
                
                @if(count($acumulados))
                <table class="table table-hover text-nowrap" id="obras">
                  <thead>
                    <tr>
                    <th>Material</th>                    
                    <th>Volumen declarado</th>
                    <th>Entregado a sitio de reciclaje</th>
                    <th># Entregas</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                    @foreach($acumulados as $acumulado)
                    <tr>
                      
                      <td>
                        {{$acumulado->material}}
                      </td>  
                      <td>
                        {{number_format($acumulado->volumen,2)}} {{$acumulado->unidades}}
                      </td>
                      <td>
                        {{number_format($acumulado->cantidad,2)}} {{$acumulado->unidades}}
                      </td>
                      <td>
                        {{$acumulado->nentregas}}
                      </td>  
                      
                    
                    </tr>
                    @endforeach
                    
                  </tbody>
                </table>
                @endif
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>


        <div class="row">
          <div class="col-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Desglose</h3>                
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x:scroll;">
                
                @if(count($obras))
                <table class="table table-hover text-nowrap" id="obras">
                  <thead>
                    <tr>
                    <th>Material</th>
                    <th>Entregado a sitio de reciclaje</th>
                    <th>Fecha entrega</th>
                    <th>Manifiesto</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                    @foreach($materialesobra as $materialobra)
                    <tr>
                      <td>
                        {{$materialobra->material}}
                      </td>  
                      <td>
                        {{$materialobra->cantidad}} {{$materialobra->unidades}}
                      </td>
                            
                      <td>
                        {{FechaFormateada($materialobra->fechacita)}}
                      </td>
                      <td>
                        <a href="{{url('boleta').'/'.$materialobra->id_cita}}" target="_blank" class="btn btn-info btn-sm d-inline p-2" title="Descargar Boleta"><i class="fa fa-download" aria-hidden="true"></i> Boleta</a>
                        <a href="{{url('manifiesto').'/'.$materialobra->id_cita}}" target="_blank" class="btn btn-info btn-sm d-inline p-2" title="Descargar manifiesto"><i class="fa fa-download" aria-hidden="true"></i> Manifiesto</a>
                      </td>
                      
                    
                    </tr>
                    @endforeach
                    
                  </tbody>
                </table>
                @endif
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
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
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>

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


</body>
</html>
