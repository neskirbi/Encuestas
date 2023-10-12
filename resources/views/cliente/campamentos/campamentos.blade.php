<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>{{GetSiglas(0)}} | Campamentos</title>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('cliente.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('cliente.sidebars.sidebar')

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
                    <h3 class="card-title">Campamentos</h3>
                </div>
                <!-- /.card-header -->
                <div class= "card-body">
                <div class="p-2">
                  <a href="campamentos/create" class="btn btn-primary"><span><i class="fa fa-plus" aria-hidden="true"></i></span> Registrar Campamento</a>
                </div>
                <div class="row">
                  <div class="col-md-12" style="overflow-x:scroll;">
                    @if(count($campamentos))
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th>Area Responsable </th>
                          <th>Nombre del Responsable del Campamento de Resguardo</th>                    
                          <th>Teléfono</th>
                          <th>Alcaldía</th>
                        </tr>
                      </thead>
                      <tbody>
                      
                        @foreach($campamentos as $campamento)
                        <tr>
                          <td>{{$campamento->arearesponsable}}</td>
                          <td>{{$campamento->nombreresponsablecamp}}</td>
                          <td>{{$campamento->telefono}}</td>
                          <td>{{$campamento->alcaldia}}</td>
                          
                          <td>
                            <a href="campamentos/{{$campamento->id}}" class="btn btn-info btn-sm d-inline p-2" ><i class="fa fa-eye" aria-hidden="true"></i> Revisar</a>
                          </td>
                          </tr>

                       
                           
                        </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                    @endif
                  </div>
                </div>
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
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>

@include('MapsApi')

</body>
</html>
