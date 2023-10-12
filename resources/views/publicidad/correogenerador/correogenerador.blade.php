<!DOCTYPE html>
<html lang="en">
<head>
  @include('publicidad.header')
  
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css');}}">
  <title>{{GetSiglas(0)}} | Publicidad</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('publicidad.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('publicidad.sidebars.sidebar')

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
                <div class="card-title">Correo Alta Generador</div>
              </div>
              <div class="card-body">

              

                <div class="row" >
                  <div class="col-md-12">
                    <div>
                      @if(isset($bannercorreo->mail))
                      {!!$bannercorreo->mail!!}
                      @endif
                    </div>
                  </div>
                </div>
                <hr>
                
                <form action="{{url('CargarGeneradorCorreo')}}" enctype="multipart/form-data" method="post">
                @csrf

                  
                

                <hr>

                <div class="row">
                  <div class="col-md-12">
                    <textarea  id="summernote" name="mail"></textarea>
                  </div>
                </div>
                
                
                
                <div class="row">
                  <div class="col-md-12">
                    <p>Poner esta etiqueta <b>@generador</b> donde se cargara el nombre del cliente y <b>@mail</b> donde se cargara el correo del cliente.</p>
                    <button class="btn btn-primary btn-block">Guardar</button>
                  </div>
                </div>
                </form>

                <hr>

              
                
              </div>
              <div class="card-footer"></div>
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
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js');}}"></script>

<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});



$(function () {
    // Summernote
    $('#summernote').summernote({
      height: 300     
   });

    // 
  })
</script>

@include('transportistas.footer')
</body>
</html>
