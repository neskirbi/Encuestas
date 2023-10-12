<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>{{GetSiglas(0)}} | Campamentos</title>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('cliente..navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('cliente..sidebars.sidebar')

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
            <form method="POST" action="{{url('campamentos')}}" id="formcampamentos" enctype="multipart/form-data">
            @csrf
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Campamentos</h3>
              </div>
            
              <div class="card-body">

                <div class="row">
                    
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="responsable">Alcaldía</label>
                      <select class="form-control" required name="obra" id="obra">
                        <option value="">----Seleccionar----</option>
                        @foreach($obras as $obra)
                        <option value="{{$obra->id}}">{{$obra->obra}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  

                </div>

                <div class="row">
                    
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="responsable">Responsable</label>
                      <input required type="text" name="responsable" class="form-control" id="responsable" placeholder="Responsable" maxlength="100" aria-invalid="false">
                    </div>
                  </div>

                                
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="arearesponsable">Area Responsable</label>
                      <input required type="text" name="arearesponsable" class="form-control" id="arearesponsable" placeholder="Area Responsable" maxlength="250" aria-invalid="false">
                    </div>
                  </div>

                </div>

                


                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label for="calle">Calle</label>
                      <input required type="text" name="calle" class="form-control" id="calle" placeholder="Calle" maxlength="100" aria-invalid="false">
                    </div>                      
                  </div>

                </div>


                <div class="row">    
                
                  <div class="col-md-8">
                    <div class="form-group">
                      <label for="colonia">Colonia</label>
                      <input required type="text" name="colonia" class="form-control" id="colonia" placeholder="Colonia" maxlength="250" aria-invalid="false">
                    </div>
                  </div>
                
                
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="alcaldia">Municipio/Alcaldía</label>
                      <input required type="text" name="alcaldia" class="form-control" id="alcaldia" placeholder="Municipio/Alcaldía" maxlength="100" aria-invalid="false">
                    </div>
                  </div>
                </div>

      
                                        
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="codigopostal">C.P.</label>
                      <input required type="text" name="codigopostal" class="form-control" id="codigopostal" placeholder="Codigo Postal" maxlength="100" aria-invalid="false">
                    </div>                      
                  </div>
                
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="telefono">Teléfono</label>
                      <input required type="text" name="telefono" class="form-control" id="telefono" placeholder="Teléfono" maxlength="250" aria-invalid="false">
                    </div>
                  </div>
                </div>  
                  
                  
                
              </div> 
             
                  
              <div class="card-footer">
                <button type="submit" class="btn  btn-outline-info float-right">Guardar</button> 
              </div> 
              
            </div>
            </form>
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
  $.widget.bridge('uibutton', $.ui.button);

 
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>

@include('MapsApi')

</body>
</html>
