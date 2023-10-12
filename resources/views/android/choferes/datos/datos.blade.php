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
          <h3 class="card-title"><i class="nav-icon fa fa-user" aria-hidden="true"></i> Datos</h3>
        </div>
        <form action="{{url('UpdateChofer')}}/{{$chofer->id}}" method="POST" id="RegistroChofer" enctype="multipart/form-data">
          @csrf          
          <input name="_method" type="hidden" value="PUT">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">                                        
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="nombres">Nombre(s)</label>
                          <input required type="text" name="nombres" class="form-control" id="nombres" placeholder="Nombre(s)" aria-invalid="false"maxlength="150" value="{{ $chofer->nombres }}" >
                      </div>                     
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="ramir">Apellidos</label>
                          <input required type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Apellidos" aria-invalid="false" maxlength="150" value="{{ $chofer->apellidos }}">
                      </div>
                    </div>
                  </div>

               

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="banco">Banco</label>
                          <input type="text" name="banco" class="form-control" id="banco" placeholder="Banco" aria-invalid="false" maxlength="30" value="{{ $chofer->banco }}">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="cuenta">Cuenta Interbancaria CLABE</label>
                          <input type="text" name="cuenta" class="form-control" id="cuenta" placeholder="CLABE" aria-invalid="false" maxlength="30" value="{{ $chofer->cuenta }}">
                      </div>
                    </div>
                  </div>
                 

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="nombret">Nombre del Titular</label>
                          <input required type="text" name="nombret" class="form-control" id="nombret" placeholder="Titular" aria-invalid="false"maxlength="150" value="{{ $chofer->nombret }}" >
                      </div>                     
                    </div>
                  </div>
                 
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="licencia">Licencia</label>
                        
                        <select class="form-control" id="licencia" name="licencia" aria-invalid="false" maxlength="100">
                            <option value="{{$chofer->licencia}}">{{$chofer->licencia}}</option>
                            <optgroup></optgroup>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                            <option value="F">F</option>
                        </select>
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
