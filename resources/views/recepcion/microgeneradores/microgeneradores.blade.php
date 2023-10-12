<!DOCTYPE html>
<html lang="en">
<head>
  @include('recepcion.header')
  <title>{{GetSiglas(0)}} | Microgeneradores</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('recepcion.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('recepcion.sidebars.sidebar')

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
              <div class="card-header">
                <h3 class="card-title"> <i class="nav-icon fa fa-group" aria-hidden="true"></i> Microgeneradores</h3>
              </div>
              <div class="card-body" style="overflow-x:scroll;">
                
                
                <div class="row">
                  <div class="col-md-12">
                    <br>
                    @if(count($microgeneradores)>0)
                      <table class="table table-hover text-nowrap">
                        <thead>
                          <tr>
                              <th>Nombre</th>
                              <th>Material</th>                              
                              <th>Fecha</th>
                              <th>Cantidad</th>
                              <th>Estatus</th>
                              <th>Opciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($microgeneradores as $microgenerador)
                          <tr>
                            <td>{{$microgenerador->nombre}}</td>
                            <td>{{$microgenerador->material}}</td>                            
                            <td>{{FechaFormateada($microgenerador->fechayhora)}}</td>                                                     
                            <td>{{$microgenerador->cantidad}} costales</td>
                            
                            <td>
                              @if($microgenerador->confirmacion==0)
                              <small class="badge badge-danger"><i class="fa fa-check" aria-hidden="true"></i>Falta</small>
                              @endif

                              @if($microgenerador->confirmacion==1)
                              <small class="badge badge-warning"><i class="fa fa-check" aria-hidden="true"></i>Pendiente</small>
                              @endif

                              @if($microgenerador->confirmacion==2)
                              <small class="badge badge-info"><i class="fa fa-check" aria-hidden="true"></i>Entregado</small>
                              @endif
                            </td>
                            <td>
                              <a href="{{url('microgeneradoresa')}}/{{$microgenerador->id}}" class="btn btn-info btn-sm "><i class="fa fa-eye" aria-hidden="true"></i> Ver</a>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    @endif
                  </div>
                </div>
              </div>
              <div class="card-footer">
                {{ $microgeneradores->links('pagination::bootstrap-4') }}
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
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>

<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>

<script>
  
</script>
@include('recepcion.footer')
</body>
</html>
