<!DOCTYPE html>
<html lang="en">
<head>
  @include('android.choferes.header')
  <title>CSMX | Citas</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('android.choferes.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('android.choferes.sidebars.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
     
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row" >
    <div class="col-md-12">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title"><i class="nav-icon fa fa-key" aria-hidden="true"></i> Cambiar Contraseña</h3>
        </div>
        <form action="{{url('UpdateChoferPass')}}/{{$chofer->id}}" method="POST" id="RegistroChofer" enctype="multipart/form-data">
          @csrf          
          <input name="_method" type="hidden" value="PUT">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">                                        
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="pass">Nueva Contraseña</label>
                          <input required type="text" name="pass" class="form-control" id="pass" placeholder="Nueva Contraseña" aria-invalid="false"maxlength="150" >
                      </div>                     
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="pass2">Repetir Contraseña</label>
                          <input required type="text" name="pass2" class="form-control" id="pass2" placeholder="Repetir Contraseña" aria-invalid="false" maxlength="150">
                      </div>
                    </div>
                  </div>
                  
                
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
          </form>
        </div>
      </div>
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

</body>
</html>
