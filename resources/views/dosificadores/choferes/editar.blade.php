<!DOCTYPE html>
<html lang="en">
<head>
  @include('dosificadores.header')
  <title>{{GetSiglas(0)}} | Choferes</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('dosificadores.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('dosificadores.sidebars.sidebar')

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
                  <form action="{{url('choferesd')}}/{{$chofer->id}}" method="POST">
                    @csrf
                    <input name="_method" type="hidden" value="PUT">
                    <div class="card-body">
                       
                        
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombres">Nombre(s)</label>
                                <input required type="text" name="nombres" class="form-control" id="nombres" placeholder="Nombre(s)" aria-invalid="false"maxlength="150" value="{{ $chofer->nombres }}" >
                            </div>

                          </div>
                    
                          
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="ramir">Apellidos</label>
                                <input required type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Apellidos" aria-invalid="false" maxlength="150" value="{{ $chofer->apellidos }}"  >
                            </div>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="licencia">Licencia</label>
                                    
                                    <select required class="form-control" id="licencia" name="licencia" aria-invalid="false" maxlength="100">
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
                       
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="telefono">Teléfono</label>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">+52</span>
                                </div>
                                <input required type="number"  class="form-control" id="telefono" data-telefono="{{$chofer->telefono}}" placeholder="Teléfono" aria-invalid="false" maxlength="50" value="{{$chofer->telefono}}" onkeyup="CambioTelefono(this)">
                              </div>
                            </div>
                          </div>
                        </div>
                       
                        <div class="row">                          
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="pass">Contraseña</label>
                                <input  type="text" onkeyup="ValidarPass();" name="pass" class="form-control" id="pass" placeholder="Contraseña" value="{{$chofer->pass}}" aria-invalid="false" maxlength="255" >
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="pass">Confirmar Contraseña</label>
                                <input  type="text" onkeyup="ValidarPass();" name="pass2" class="form-control" id="pass2" placeholder="Contraseña" value="{{$chofer->pass}}" aria-invalid="false" maxlength="255" >
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
  function CambioTelefono(_this){
    _this=$(_this);
    if(_this.data('telefono')!=_this.val()){
      _this.attr("name","telefono");
    }else{
      _this.removeAttr("name");
    }
  }
</script>
@include('dosificadores.footer')
</body>
</html>