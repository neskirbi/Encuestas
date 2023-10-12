<!DOCTYPE html>
<html lang="en">
<head>
  @include('soporte.header')
  <title>{{GetSiglas(0)}} | Alcaldías</title>

  
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
                <h3 class="card-title"><i class="nav-icon fa fa-building" aria-hidden="true"></i> Dependecias</h3>                
              </div>
              <!-- /.card-header -->
              <form action="{{url('dependencias')}}" method="post">
                @csrf
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="entidad">Entidad federativa</label>
                        <!--<input  type="text" name="entidad" class="form-control" id="entidad" placeholder="Entidad federativa" aria-invalid="false" >-->
                        <select  name="entidad" class="form-control" id="entidad" aria-invalid="false" onchange="MunicipiosApi(this,2);">
                            <option value="">--Entidad Federativa--</option>
                            @foreach($entidades as $entidad)
                            <option value="{{$entidad->entidad}}">{{$entidad->entidad}}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="municipio">Alcaldía/Municipio</label>
                        <select  name="municipio" class="form-control" id="municipio" aria-invalid="false" >
                            
                        </select>
                    </div>
                  </div>
                </div>                   
                
                <div class="row">
                  <div class="col-md-7">
                      <div class="form-group">
                          <label for="nombre">Nombre</label>
                          <input required type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" aria-invalid="false" maxlength="150" >
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="mail">Correo</label>
                          <input required type="text" name="mail" class="form-control" id="mail" placeholder="Correo" aria-invalid="false" maxlength="150" >
                      </div>
                  </div>
                
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="pass">Contrase&ntilde;a</label>
                          <input required type="text" name="pass" class="form-control" id="pass" placeholder="Contrase&ntilde;a" aria-invalid="false" maxlength="150" >
                      </div>
                  </div>
                </div>


              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-info float-right">Guardar</button>
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
