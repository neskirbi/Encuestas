<!DOCTYPE html>
<html lang="en">
<head>
  @include('soporte.header')
  <title>{{GetSiglas(0)}} | Pagos</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('soporte.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('soporte.sidebars.sidebar')

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
                <h3 class="card-title"><i class="nav-icon fa fa-dollar" aria-hidden="true"></i> Pagos</h3>

                
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <a href="pagoschofer/create" target="" class="btn btn-info" title=""><i class="fa fa-dollar" aria-hidden="true"></i> Generar Pagos</a>                          
                <br><br>
           
                <div class="row">
                  <div class="col-md-12" style="overflow-x:scroll;">
                    @if(count($pagoschof))
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                        <th>Planta</th>
                        <th>Chofer</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Monto</th>             
                        <th>Fecha</th>             
                        </tr>
                      </thead>
                      <tbody>
                    
                        @foreach($pagoschof as $pago)
                        <tr>
                        <td title="{{$pago->planta}}">{{strlen($pago->planta)<30 ? $pago->planta : mb_substr($pago->planta,0,29,"UTF-8").' ...'}}</td>
                          <td title="{{$pago->nombrecompleto}}">{{$pago->nombrecompleto}}</td>
                          <td title="{{$pago->cantidad}}">{{$pago->cantidad}} m<sup>3</sup></td>
                          <td title="{{$pago->recompensa}}">$ {{$pago->recompensa}}/  m<sup>3</sup></td>
                          <td title="{{$pago->cantidad*$pago->recompensa}}">$ {{$pago->cantidad*$pago->recompensa}}</td>
                          <td title="{{FechaFormateadaTiempo($pago->created_at)}}">{{FechaFormateadaTiempo($pago->created_at)}}</td>
                          
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
              {{ $pagoschof->appends($_GET)->links('pagination::bootstrap-4') }}
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

@include('soporte.footer')
</body>
</html>
