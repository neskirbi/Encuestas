<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>{{GetSiglas(0)}} | Configuración</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('sedema.sidebars.sidebar')

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
          <div class="col-md-3">
            <div class="card card-danger card-outline">
              <div class="card-header">
              <h3 class="card-title">Configuraciones</h3>

              
              </div>
              <div class="card-body p-0">
                  <input type="hidden" name="id_planta" id="id_planta" value="{{Auth::guard('sedemas')->user()->nombre}}">
                  <ul class="nav nav-pills flex-column">                 

                    <li class="nav-item active">
                      <a class="nav-link" onclick="VentanasTitulos(this);" data-text="Cuenta"  data-toggle="pill" href="#cuenta" role="tab">
                        <i class="fa fa-user" aria-hidden="true"></i> Cuenta
                        <!--<span class="badge bg-primary float-right">12</span>-->
                      </a>
                    </li>
                     
                     
                  </ul>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <div class="col-md-9">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title" id="titulo">Cuenta</h3>
              </div>
              <div class="card-body">                 
                <div class="row">
                    <div class="tab-content" id="custom-tabs-four-tabContent" style="width:100%;">                          
                        <div class="tab-pane fade active show" id="cuenta" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                            <form action="{{url('DatosCuentaEdit')}}" method="post" id="cuentaform">
                              @csrf
                              <div class="row">
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class='form-group'>
                                                <label for="nombre">Administrador</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{$sedema->nombre}}">
                                            </div>
                                        </div>                               
                                    </div>
                                    <div class="row">                            
                                        <div class="col-sm-6">
                                            <div class='form-group'>
                                                <label for="cargo">Cargo</label>
                                                <input type="text" class="form-control" id="cargo" name="cargo" value="{{$sedema->cargo}}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class='form-group'>
                                                <label for="mail">Correo</label>
                                                <input type="text" class="form-control" id="mail" name="mail" value="{{$sedema->mail}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class='form-group'>
                                                <label for="pass">Contraseña</label>
                                                <input type="text" class="form-control" id="pass" name="pass" value="{{$sedema->pass}}">
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>
                                
                              </div>                                                                      
                            </form>
                            <button class="btn btn-info float-right" onclick="Submite('cuentaform',this);" data-texto="¿Guardar los datos de administrador?">Guardar</button>
                            <div class="row">
                              <div class="col-md-12">  
                                <div class='form-group'>
                                  <label style="color:#999;">Nota:Al actualizar los datos se cerrara la sesión.</label>
                                </div>                 
                                
                              </div>
                            </div>
                        </div>
                    </div>
                  </div>           
                    
                </div>
                
                
              </div>
              <!-- /.card-body -->
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
<script src="dist/js/adminlte.js"></script>

@include('administracion.footer')


</body>
</html>
