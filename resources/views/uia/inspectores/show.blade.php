<!DOCTYPE html>
<html lang="en">
<head>
  @include('uia.header')
  <title>Encuestas</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('uia.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('uia.sidebars.sidebar')

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
            <form action="{{url('inspectores/'.$inspector->id)}}" method="post">
              @csrf
              @method('put')
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title"><i class="fa fa-group" aria-hidden="true"></i> Inspectores</h3>

                  <div class="card-tools">
                                
                  </div>
                  
                </div>
                <!-- /.card-header -->
                <div class="card-body" >
                

                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="inspector">Inspector</label>
                        <input required type="text" class="form-control" id="inspector" name="inspector" placeholder="Inspector" value="{{$inspector->inspector}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input required type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" value="{{$inspector->telefono}}">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="mail">Correo</label>
                        <input required type="mail" class="form-control" id="mail" name="mail" placeholder="Correo" value="{{$inspector->mail}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="pass">Contraseña</label>
                        <input required type="text" class="form-control" id="pass" name="pass" placeholder="Contraseña" value="{{$inspector->pass}}">
                      </div>
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button class="btn btn-primary float-right"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                  
                </div>
              </div>
            </form>
            
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

@include('uia.footer')
</body>
</html>
