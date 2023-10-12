<!DOCTYPE html>
<html lang="en">
<head>
  @include('directores.header')
  <title>CSMX | Reportes</title>
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('directores.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('directores.sidebars.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <!-- /.content-header -->
    <div class="content-header">
     <h1></h1>
    </div>
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Reportes</h3>

                   
                    </div>
                    <div class="card-body p-0">
                        <input type="hidden" name="id_planta" id="id_planta" value="{{GetIdPlanta()}}">
                        <ul class="nav nav-pills flex-column">

                       
                            <li class="nav-item active">
                                <a class="nav-link active" onclick="VentanasTitulos(this);" data-text="Status Obras"  data-toggle="pill" href="#sobras" role="tab">
                                    <i class="fa fa-building" aria-hidden="true"></i> Status Obras
                                    <!--<span class="badge bg-primary float-right">12</span>-->
                                </a>
                            </li>
                        
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

            <div class="col-md-9">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                    <h3 class="card-title" id="titulo">
                        Reportes
                    </h3>
                    <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">

                            <div class="tab-pane fade  active show" id="sobras" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab" >
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        
                                    </div>
                                    <div class="col-md-4">
                                         
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class=" float-right">
                                            <button class="btn btn-info" onclick="StatusObrasDirector();"><i class="nav-icon fa fa-eye" aria-hidden="true"></i> Consultar</button>                                       
                                            <a class="btn btn-info" target="_blank" href="{{url('StatusObrasDirector')}}/{{GetIdPlanta()}}"><i class="nav-icon fa fa-print" aria-hidden="true"></i> Imprimir</a>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div calss="form-group">
                                            <div id="contenedorprereporteobras" class="Altura" style="width:100%; overflow: scroll;"></div>
                                        </div>
                                    </div>                                    
                                </div>                               
                            </div>
                        </div>
                       
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
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);

 
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="dist/js/adminlte.js"></script>
</body>
</html>
