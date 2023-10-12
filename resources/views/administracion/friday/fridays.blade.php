<!DOCTYPE html>
<html lang="en">
<head>
  @include('administracion.header')
  <title>CSMX | WishList</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('administracion.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('administracion.sidebars.sidebar')

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
                <h3 class="card-title">Fridays</h3>
              </div>
              <div class="card-body">
                
                <a href="friday/create" type="submit" class="btn btn-info"><i class="fa fa-plus" aria-hidden="true"></i> Friday</a>
                <div class="row">
                  <div class="col-md-12">
                    <br>
                    @if(count($fridays)>0)
                      <table class="table table-hover text-nowrap">
                        <thead>
                          <tr>
                              <th>Administrador</th>
                              <th>Titulo</th>                              
                              <th>Prioridad</th>
                              <th>Status</th>
                              <th>Opciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($fridays as $friday)
                          <tr>
                            <td>{{$friday->administrador}}</td>
                            <td>{{$friday->titulo}}</td>
                            <td>
                              @if($friday->prioridad==1)
                              <small class="badge badge-danger"><i class="fa fa-check" aria-hidden="true"></i>Alta</small>
                              @endif

                              @if($friday->prioridad==2)
                              <small class="badge badge-warning"><i class="fa fa-check" aria-hidden="true"></i>Media</small>
                              @endif

                              @if($friday->prioridad==3)
                              <small class="badge badge-info"><i class="fa fa-check" aria-hidden="true"></i>Baja</small>
                              @endif
                            </td>
                            <td>
                              @if($friday->status==0)
                              <small class="badge badge-danger"><i class="fa fa-check" aria-hidden="true"></i>Pendiente</small>
                              @endif

                              @if($friday->status==1)
                              <small class="badge badge-warning"><i class="fa fa-check" aria-hidden="true"></i>Desarrollo</small>
                              @endif

                              @if($friday->status==2)
                              <small class="badge badge-info"><i class="fa fa-check" aria-hidden="true"></i>Listo</small>
                              @endif
                            </td>
                            <td>
                              <a href="friday/{{$friday->id}}" class="btn btn-info btn-sm "><i class="fa fa-eye" aria-hidden="true"></i> Ver</a>
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
                {{ $fridays->links('pagination::bootstrap-4') }}
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
@include('administracion.footer')
</body>
</html>
