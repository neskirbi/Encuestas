<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>CSMX | Vehículos</title>

  
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
        <div class="row">
            <div class="col-md-6">
                <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Vehículos</h3>
                    <a href="#" data-toggle="modal" data-target="#modalvehiculo" class="float-right"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                </div>
                <div class="card-body">
                @if(count($vehiculos))
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                            <th>Tipo</th>
                            <th>Marca y Modelo</th>
                            <th>No. Matrícula</th>    
                            </tr>
                        </thead>
                    <tbody>
                    @foreach($vehiculos as $vehiculo)
                    <tr>
                      <td>{{$vehiculo->vehiculo}}</td>
                      <td>{{$vehiculo->marca}}<br>{{$vehiculo->modelo}}</td>
                      <td>{{$vehiculo->matricula}}</td>
                      <td>
                      <form action="vehiculos/{{$vehiculo->id}}" method="POST"  class="d-inline p-2">
                          {{ csrf_field() }}
                          <input type="hidden" name="_method" value="DELETE">
                          <button  id="borrar" class="borrar btn btn-danger btn-sm" data-texto="¿Deseas quitar esta vehiculo?"><i class="fa fa-times" aria-hidden="true"></i></button>
                          
                      </form>
                      </td>
                    </tr>
                      
                    @endforeach                   
                        
                    </tbody>
                    </table>
                  @endif
                </div>
                <!-- /.card-body -->
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Chóferes</h3>
                    <a href="#" data-toggle="modal" data-target="#modalchofer" class="float-right"><i class="fa fa-user-plus" aria-hidden="true"></i></a>
                </div>
                <div class="card-body">
                @if(count($choferes))
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                            <th>Nombre(s)</th>
                            <th>Apellidos</th>
                            <th>Marca y Modelo</th>
                            </tr>
                        </thead>
                    <tbody>
                    @foreach($choferes as $chofer)
                      <td>{{$chofer->nombres}}</td>
                      <td>{{$chofer->apellidos}}</td>
                      <td>{{$vehiculo->marca}}<br>{{$vehiculo->modelo}}</td>
                      <td>
                        <form action="choferes/{{$chofer->id}}" method="POST"  class="d-inline p-2">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                            <button  id="borrar" class="borrar btn btn-danger btn-sm" data-texto="¿Deseas quitar este chofer?"><i class="fa fa-times" aria-hidden="true"></i></button>
                            
                        </form>
                      </td>
                     
                    @endforeach 
                        
                    </tbody>
                    </table>
                  @endif
                </div>
                <!-- /.card-body -->
                </div>
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <script> 
    toastr.success('Registro Matricula y Vehículo');
  </script>
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

@include('cliente.vehiculos.modals.modalvehiculo')
@include('cliente.vehiculos.modals.modalchofer')
@include('footer')

</body>
</html>
