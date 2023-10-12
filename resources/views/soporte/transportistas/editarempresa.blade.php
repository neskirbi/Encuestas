<!DOCTYPE html>
<html lang="en">
<head>
  @include('soporte.header')
  <title> {{GetSiglas(0)}} | Empresas</title>

  
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
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Registro de Empresa</h3>
                </div>
              
                <form method="POST" action="{{url('transportistas').'/'.$empresa->id}}" id="formobra" enctype="multipart/form-data">
                @csrf
                <input name="_method" type="hidden" value="PUT">
              
                <div class="card-body">
                              
                  <div class="form-group">
                    <label for="razonsocial">Razón social</label>
                    <input required type="text" name="razonsocial" class="form-control" id="razonsocial" placeholder="Razón Social" maxlength="250" aria-invalid="false" value="{{$empresa->razonsocial}}">
                  </div>


                  <div class = "row">
                    <div class="col-md-4"> 
                      <div class="form-group">
                        <label for="razonsocial">Ramir</label>
                        <input required type="text" name="ramir" class="form-control" id="ramir" placeholder="Ramir" maxlength="100" aria-invalid="false" value="{{$empresa->ramir}}">
                      </div>                      
                    </div>


                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="giro">Giro</label>
                        <input required type="text" name="giro" class="form-control" id="giro" placeholder="Giro" maxlength="250" aria-invalid="false" value="{{$empresa->giro}}">
                      </div>
                    </div>  
                      
                    <div class="col-md-4">  
                      <div class="form-group">
                        <label for="regsct">Registro SCT</label>
                        <input required type="text" name="regsct" class="form-control" id="regsct" placeholder="Registro SCT" maxlength="100" aria-invalid="false" value="{{$empresa->regsct}}">
                      </div>
                    </div>
                  </div>
        
                                          
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="domicilio">Domicilio</label>
                        <textarea class="form-control" required name="domicilio" rows="3" cols="90">{{$empresa->domicilio}}</textarea>
                      </div>
                    </div>  
                  </div>
                
                                           
                         
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input required type="text" name="telefono" class="form-control" id="telefono" placeholder="Teléfono" aria-invalid="false" maxlength="50" value="{{$empresa->telefono}}">
                      </div>
                    </div>  
                  
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="mail">Correo</label>
                        <input required type="text" name="mail" class="form-control" id="mail" placeholder="Correo" aria-invalid="false" maxlength="50" value= "{{$empresa->correo}}">
                      </div>
                    </div>
                  </div>
                
                
                
                </div>
      
                  <div class="card-footer">
                    <button required="" type="submit" id="guardar" class="btn  btn-info float-right">Guardar</button>
                  </div>    
              
            
            
              </form>
            </div>  
          </div>
        </div>  
      </div>
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
