<!DOCTYPE html>
<html lang="en">
<head>
  @include('inspecciones.header')
  <title>Encuestas</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('inspecciones.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('inspecciones.sidebars.sidebar')

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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Inspecciones</h3>

                
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                

                <div class="row">
                  <div class="col-md-12" style="overflow-x:scroll;">
                    @if(count($encuestas))
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th>Encuesta</th> 
                          <th>Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                    
                        @foreach($encuestas as $encuesta)
                        <tr>
                          <td title="{{$encuesta->encuesta}}">{{($encuesta->encuesta)}}</td>
                          
                          <td>
                          <a href="{{url('informe')}}/{{$encuesta->id}}" class="btn btn-info"> <i class="fas fa-plus"></i> Encuestar</a>
                            
                          </td>
                          
                        </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                    @endif
                  </div>
                </div>
                
                
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>


        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Encuestas</h3>

                
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                

                <div class="row">
                  <div class="col-md-12" style="overflow-x:scroll;">
                    @if(count($encuestas))
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th>Encuesta</th> 
                          <th>Fecha</th>
                          <th>Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                    
                        @foreach($inspecciones as $inspeccion)
                        <tr>
                          <td title="{{$inspeccion->encuesta}}">
                            {{strlen($inspeccion->encuesta) > 40 ? mb_substr($inspeccion->encuesta,0,29,"UTF-8") : $inspeccion->encuesta}}
                          </td>
                            
                          <td>
                            {{FechaFormateadaTiempo($inspeccion->created_at)}}
                          </td>
                          <td>
                            <a href="{{url('inspecciones')}}/{{$inspeccion->id}}" class="btn btn-info"> <i class="fas fa-eye"></i> Revisar</a>                            
                          </td>

                         

                          <td>
                            <?php
                              $adjuntos=explode(',',$inspeccion->adjuntos);
                              
                            ?>

                            @foreach($adjuntos as $adjunto)
                            @if(file_exists(public_path('documentos/inspecciones/adjuntos').'/'.$adjunto) && $adjunto!='')
                            <a href="{{asset('documentos/inspecciones/adjuntos').'/'.$adjunto}}"  target="_blank"><img src="https://static.vecteezy.com/system/resources/previews/000/644/844/original/vector-pdf-icon-symbol-sign.jpg" width="50px" alt="{{asset('documentos/inspecciones/adjuntos/').$adjunto.'pdf'}}"></a>
                            @endif
                            @endforeach
                          </td>
                          
                        </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                    @endif
                  </div>
                </div>
                
                
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
              {{ $inspecciones->appends($_GET)->links('pagination::bootstrap-4') }}
              </div>
            </div>
            <!-- /.card -->
          </div>
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
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);

 
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="dist/js/adminlte.js"></script>

<script>
  function AdjuntarId(id){
    $('#id').val(id);
  }

  $(function () {
        bsCustomFileInput.init();
    });
</script>
@include('inspecciones.inspecciones.modals.modaladjuntar')
@include('administracion.footer')
</body>
</html>
