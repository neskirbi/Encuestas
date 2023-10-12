<!DOCTYPE html>
<html lang="en">
<head>
  @include('transportistas.header')
  <title>{{GetSiglas(0)}} | Vehículos</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('transportistas.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('transportistas.sidebars.sidebar')

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
              <h3 class="card-title"><i class="nav-icon fa fa-user" aria-hidden="true"></i> Chofer</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <form action="{{url('chofer')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="razonsocial">Razón Social</label>
                                    <select required name="empresatransporte" class="form-control" id="empresatransporte">
                                      <option value="">---Empresa---</option>
                                      @foreach($empresastransporte as $empresa)
                                      <option value="{{$empresa->id}}">{{$empresa->razonsocial}}</option>  
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>      
                        
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombres">Nombre(s)</label>
                                <input required type="text" name="nombres" class="form-control" id="nombres" placeholder="Nombre(s)" aria-invalid="false"maxlength="150" value="{{ old('nombres') }}" >
                            </div>

                          </div>
                    
                          
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="ramir">Apellidos</label>
                                <input required type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Apellidos" aria-invalid="false" maxlength="150" >
                            </div>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="licencia">Licencia</label>
                                    
                                    <select required class="form-control" id="licencia" name="licencia" aria-invalid="false" maxlength="100">
                                        <option value="">--Licencia--</option>
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
                       
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="telefono">Teléfono</label>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">+52</span>
                                </div>
                                <input required type="number" name="telefono" class="form-control" id="telefono" placeholder="Teléfono" aria-invalid="false" maxlength="50" >
                              </div>
                            </div>
                          </div>
                        </div>
                       
                        <div class="row">                          
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="pass">Contraseña</label>
                                <input required type="password" onkeyup="ValidarPass();" name="pass" class="form-control" id="pass" placeholder="Contraseña" aria-invalid="false" maxlength="255" >
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="pass">Confirmar Contraseña</label>
                                <input required type="password" onkeyup="ValidarPass();" name="pass2" class="form-control" id="pass2" placeholder="Contraseña" aria-invalid="false" maxlength="255" >
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="card-footer">
            
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
@include('transportistas.footer')
</body>
</html>
