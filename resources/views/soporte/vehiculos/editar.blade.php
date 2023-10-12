<!DOCTYPE html>
<html lang="en">
<head>
  @include('soporte.header')
  <title>{{GetSiglas(0)}} | Vehículos</title>

  
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
      <div class="row" >
        <div class="col-md-12">
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title"><i class="nav-icon fa fa-truck" aria-hidden="true"></i> Editar Vehículos</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                <form method="POST" action="{{url('vehiculossoporte').'/'.$vehiculo->id}}" id="formobra" enctype="multipart/form-data">
                    @csrf
                    <input name="_method" type="hidden" value="PUT">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="razonsocial">Razón Social</label>
                                <select required name="empresatransporte" class="form-control" id="empresatransporte">
                                  <option value="{{$empresa->id}}">{{$empresa->razonsocial}}</option>
                                  @foreach($empresas as $empresa)
                                  <option value="{{$empresa->id}}">{{$empresa->razonsocial}}</option>  
                                  @endforeach
                                </select>
                            </div>
                          </div>
                        </div>    
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="vehiculo">Vehículo</label>
                                    <input required type="text" name="vehiculo" class="form-control" id="vehiculo" placeholder="Vehículo" aria-invalid="false" maxlength="100" value="{{$vehiculo->vehiculo}}" >
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="marca">Marca</label>
                                    <input required type="text" name="marca" class="form-control" id="marca" placeholder="Marca" aria-invalid="false" maxlength="100" value="{{$vehiculo->marca}}" >
                                </div>

                            </div>
                      

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="modelo">Modelo</label>
                                    <input required type="text" name="modelo" class="form-control" id="modelo" placeholder="Modelo" aria-invalid="false" maxlength="100" value="{{$vehiculo->modelo}}" >
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="matricula">Matrícula</label>
                                    <input required type="text" name="matricula" class="form-control" id="matricula" placeholder="Matrícula" aria-invalid="false" maxlength="100" value="{{$vehiculo->matricula}}" >
                                </div>

                            </div>
                      
                      
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label for="combustible">Combustible</label>
                                  <select required type="text" name="combustible" class="form-control" id="combustible" aria-invalid="false" maxlength="50"  >
                                  <option value="{{$vehiculo->combustible}}">{{$vehiculo->combustible}}</option>                        
                                  <option value="Gasolina">Gasolina</option>
                                  <option value="Diesel">Diésel</option>
                                  <option value="Gas LP">Gas LP</option>
                                  </select>
                              </div>

                            </div>
                        </div>
                        
                      
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ramir">Descripción</label>
                                    <textarea required type="text" rows="5" name="detalle" class="form-control" id="detalle" placeholder="Descripción" aria-invalid="false" maxlength="100" > {{$vehiculo->detalle}} </textarea>
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
@include('soporte.footer')
</body>
</html>
