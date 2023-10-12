<!DOCTYPE html>
<html lang="en">
<head>
  @include('recepcion.header')
  <title>{{GetSiglas(0)}} | Transferencias</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('recepcion.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('recepcion.sidebars.sidebar')

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
          <div class="col-md-6">
            <!-- small box -->
            
            <div class="small-box bg-info">
            
              <div class="inner">
                <h3>{{$recepcionest}} m<sup>3</sup> </h3>
                <p>Recepciones</p>
              </div>
              <div class="icon">
                <i class="fa fa-truck"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="Mostrar('recepciones','envios');">Detalle <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <!-- ./col -->
          <div class="col-md-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$enviost}} m<sup>3</sup> </h3>
                <p>Envios</p>
              </div>
              <div class="icon">
              <i class="fa fa-truck"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="Mostrar('envios','recepciones');">Detalle <i class="fas fa-arrow-circle-right">&nbsp;</i></a>
            </div>
          </div>
        </div>


        <div class="row">
        
          <div class="col-12">
            <div class="card card-danger" id="envios" style="display:none;">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-truck" aria-hidden="true"></i> Envios</h3>

                
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                <div class="col-md-4"><a href="{{url('transferencias/create')}}" class="btn btn-info"><i class="nav-icon fa fa-plus" aria-hidden="true"></i> Salida</a></div>
                </div>
                <div class="row">
                  <div class="col-md-12" style="overflow-x:scroll;">
                    <iframe src="envios" frameborder="0" style="width:100%; height:500px;"></iframe>
                  </div>
                </div>
                
                
                </div>
              <!-- /.card-body -->
              <div class="card-footer">
              </div>
            </div>


            <div class="card card-info" id="recepciones">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-truck" aria-hidden="true"></i> Recepciones</h3>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                <iframe src="recepciones" frameborder="0" style="width:100%; height:500px;"></iframe>
                
                
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
              </div>
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

@include('recepcion.footer')

<script>
  function Mostrar(show,hide){

    
    $('#'+hide).hide(500,function(){
      $('#'+show).show(500);
    });
  }
</script>
</body>
</html>
