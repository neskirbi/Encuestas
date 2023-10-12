<!DOCTYPE html>
<html lang="en">
<head>
  @include('administracion.header')
  <title>CSMX | Obras</title>

  
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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="nav-icon fa fa-check"></i> Solicitudes</h3>

                
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12" style="overflow-x:scroll;">
                    @if(count($solicitudes))
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Chofer</th>
                          <th>Monto</th> 
                          <th>Cuenta</th> 
                          <th>Banco</th>
                          <th>Titular</th> 
                          <th>Teléfono</th>                 
                          <th>Estatus</th>
                          <th colspan="2">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                    
                        @foreach($solicitudes as $solicitud)
                        <tr>
                          <td title='{{$solicitud->chofer}}' style="cursor:pointer;"><i class="nav-icon fa fa-user" aria-hidden="true" ></i></td>
                          <td>{{$solicitud->chofer}}</td>
                          <td>$ {{number_format($solicitud->monto,2)}}</td>
                          <td>{{$solicitud->cuenta}}</td>
                          <td>{{$solicitud->banco}}</td>
                          <td>{{$solicitud->nombret}}</td>
                          <td>{{$solicitud->telefono}}</td>                          
                          
                          <td>
                          @if($solicitud->status==0)
                            <small class="badge badge-danger"><i class="fa fa-exclamation" aria-hidden="true"></i> Rechazado</small>
                          @endif

                          @if($solicitud->status==1)
                            <small class="badge badge-warning"><i class="fa fa-exclamation" aria-hidden="true"></i> Pendiente</small>
                          @endif

                          @if($solicitud->status==2)
                            <small class="badge badge-success"><i class="fa fa-exclamation" aria-hidden="true"></i> Confirmado</small>
                          @endif
                          </td>
                          <td>
                            <form action="{{url('solicitudes').'/'.$solicitud->id}}" method="post">
                               @csrf
                               @method('PUT')
                               <input type="text" name="status" id="" value="2" style="display:none;">
                              <button type="submit" class="btn btn-success btn-block btn-sm"><i class="fa fa-check" aria-hidden="true"></i> Confirmar</button>
                            </form>
                          </td>
                          <td>
                            <form action="{{url('solicitudes').'/'.$solicitud->id}}" method="post">
                               @csrf
                               @method('PUT')
                               <input type="text" name="status" id="" value="0" style="display:none;">
                              <button type="submit" class="btn btn-danger btn-block btn-sm"><i class="fa fa-check" aria-hidden="true"></i> Rechazar</button>
                            </form>
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
              {{ $solicitudes->appends($_GET)->links('pagination::bootstrap-4') }}
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

@include('administracion.footer')
</body>
</html>
