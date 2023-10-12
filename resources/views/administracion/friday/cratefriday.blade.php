<!DOCTYPE html>
<html lang="en">
<head>
  @include('administracion.header')  
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css');}}">
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
            <div class="card card-outline card-info">
              <div class="card-header">
                <h3 class="card-title">
                  Friday
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{url('friday')}}" method="post">
                  @csrf
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <input required type="text" class="form-control" placeholder="Titulo" name="titulo">
                      </div>
                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-2">
                      <button type="submit" class="btn btn-default float-right">Enviar</button>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="prioridad">Prioridad</label>
                        <select class="form-control" name="prioridad">
                          <option value="1" class="btn btn-danger">Alta</option>
                          <option value="2"  class="btn btn-warning">Media</option>
                          <option value="3"  class="btn btn-info">Baja</option>
                        </select>
                      </div>
                    </div>
                  </div>  
                  <div class="row">
                    <div class="col-md-12">
                      <textarea required id="summernote" name="detalle"></textarea>
                    </div>
                  </div>
                </form>
                
                
              </div>
            </div>
          </div>
          <!-- /.col-->
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
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js');}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>

<script>
  $(function () {
    // Summernote
    $('#summernote').summernote({
                height: 300     
   });

    // 
  })
</script>
@include('administracion.footer')
</body>
</html>
