<!DOCTYPE html>
<html lang="en">
<head>
  @include('administracion.header')
  <title>CSMX | Obras</title>

  
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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{$obra->obra}}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">


              <div class="row">
                  <div class="col-md-12" >

                    <div class="input-group">
                      <input disabled class="form-control" type="text" value="Para: {{$planta->correosrc}}">
                     
                    </div>
                      <span style="font-size:.8em; color:#f00;">Estos correos se configuran en el apartado de Configuración -> Correos</span>
                  </div>
                </div>


                <hr>
                <div class="row">
                  <div class="col-md-12" >

                    <p>Hola Buen día.</p>
                    <p>Se ha dado de alta un obra en ReciTrack que quiere cotización de Póliza de Responsabilidad Civil, a continuación los datos del Cliente y Proyecto.</p>
                  </div>
                </div>
                  
                <div class="row">
                  <div class="col-md-12">
                    Cliente: {{$obra->razonsocial}}
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    Representante Legal: {{$obra->nombresrepre}} {{$obra->apellidosrepre}}
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-12">
                    Contacto en Obra: {{$obra->contacto}}
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    Teléfono 1: {{$obra->telefono}}
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    Teléfono 2: {{$obra->celular}}
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    Correo: {{$obra->correo}}
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-12">
                    Tipo de Obra: {{CodificaTipoObra($obra->tipoobra)}}
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    Valor de la Obra: $ {{number_format($obra->valorobra,2)}}
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    Fecha de inicio: {{FechaFormateada($obra->fechainicio)}}
                  </div>
                </div>
                
                
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-12">
                    <button class="btn btn-info float-right" data-id="{{$obra->id}}" onclick="EnviarCorreoRC(this);">Enviar</button>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
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
    <strong>Copyright &copy; 2014-2021 <a href="https: //adminlte.io">AdminLTE.io</a>.</strong>
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

@include('administracion.footer')
</body>
</html>
