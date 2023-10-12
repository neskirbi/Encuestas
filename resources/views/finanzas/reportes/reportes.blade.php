<!DOCTYPE html>
<html lang="en">
<head>
  @include('finanzas.header')
  <title>{{GetSiglas(0)}} | Reportes</title>
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('finanzas.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('finanzas.sidebars.sidebar')

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
                        <input type="hidden" name="id_planta" id="id_planta" value="{{Auth::guard('finanzas')->user()->id_planta}}">
                        <ul class="nav nav-pills flex-column">

                        
                        <li class="nav-item active">
                                <a class="nav-link active" onclick="VentanasTitulos(this);" data-text="Reporte Obras"  data-toggle="pill" href="#report" role="tab">
                                    <i class="fa fa-building" aria-hidden="true"></i> Reporte Obras
                                    <!--<span class="badge bg-primary float-right">12</span>-->
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" onclick="VentanasTitulos(this);" data-text="Pagos"  data-toggle="pill" href="#pagos" role="tab">
                                    <i class="fa fa-dollar" aria-hidden="true"></i> Pagos
                                    <!--<span class="badge bg-primary float-right">12</span>-->
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" onclick="VentanasTitulos(this);" data-text="Citas"  data-toggle="pill" href="#citas" role="tab">
                                    <i class="fa fa-calendar" aria-hidden="true"></i> Citas
                                    <!--<span class="badge bg-primary float-right">12</span>-->
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" onclick="VentanasTitulos(this);" data-text="Logistica"  data-toggle="pill" href="#transporte" role="tab">
                                    <i class="fa fa-truck" aria-hidden="true"></i> Logistica
                                    <!--<span class="badge bg-primary float-right">12</span>-->
                                </a>
                            </li>
                            

                            
                            <!--<li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-envelope"></i> Sent
                            </a>
                            </li>
                            <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-file-alt"></i> Drafts
                            </a>
                            </li>
                            <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-filter"></i> Junk
                                <span class="badge bg-warning float-right">65</span>
                            </a>
                            </li>
                            <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-trash-alt"></i> Trash
                            </a>
                            </li>-->
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

            <div class="col-md-9">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                    <h3 class="card-title" id="titulo">
                    Reporte Obras
                    </h3>
                    <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">


                            <div class="tab-pane fade active show" id="report" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab" >
                                <div class="row">                                    
                                    <a class="btn btn-info" href="{{url('ReporteObrasFinanzas')}}">Descargar</a>
                                    
                                </div>

                                
                               
                            </div>

                            <div class="tab-pane fade" id="pagos" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab" >
                            
                                <div class="row">
                                
                                    <div class="col-md-4">
                                         <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Inicio</span>
                                            </div>
                                            <input type="date" class="form-control" id="inipago" value="<?php echo date('Y-m-d');?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                         <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Fin</span>
                                            </div>
                                            <input type="date" class="form-control" id="finpago" value="<?php echo date('Y-m-d');?>">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class=" float-right">
                                            <button class="btn btn-info" onclick="ReportePagosFi();"><i class="nav-icon fa fa-eye" aria-hidden="true"></i> Consultar</button>                                       
                                            <button class="btn btn-info" onclick="ReportePagosFinanzas();"><i class="nav-icon fa fa-print" aria-hidden="true"></i> Imprimir</button>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div calss="form-group">
                                            <div id="contenedorpagos" class="Altura" style="width:100%; overflow: scroll;"></div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="tab-pane fade" id="citas" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab" >
                                <div class="row">                                    
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <select name="obracita" id="obracita" class="form-control">
                                                <option value="">Obras</option>
                                                <optgroup></optgroup>
                                                @foreach($obras as $obra)
                                                <option value="{{$obra->id}}">{{$obra->obra}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fotoscita">Fotos</label>
                                           <input type="checkbox" id="fotoscita" name="fotoscita">
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                         <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Inicio</span>
                                            </div>
                                            <input type="date" class="form-control" id="ini" value="<?php echo date('Y-m-d');?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                         <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Fin</span>
                                            </div>
                                            <input type="date" class="form-control" id="fin" value="<?php echo date('Y-m-d');?>">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class=" float-right">
                                            <button class="btn btn-info" onclick="ReporteCitas();"><i class="nav-icon fa fa-eye" aria-hidden="true"></i> Consultar</button>                                       
                                            <button class="btn btn-info" onclick="ReporteCitasAdministracion();"><i class="nav-icon fa fa-print" aria-hidden="true"></i> Imprimir</button>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div calss="form-group">
                                            <div id="contenedorcitas" class="Altura" style="width:100%; overflow: scroll;"></div>
                                        </div>
                                    </div>
                                    
                                </div>

                                
                               
                            </div>


                            <div class="tab-pane fade" id="transporte" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab" >
                                <div class="row">                                    
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <select name="obracita" id="tobra" class="form-control">
                                                <option value="">Obras</option>
                                                <optgroup></optgroup>
                                                @foreach($obras as $obra)
                                                <option value="{{$obra->id}}">{{$obra->obra}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                         <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Inicio</span>
                                            </div>
                                            <input type="date" class="form-control" id="tini" value="<?php echo date('Y-m-d');?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                         <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Fin</span>
                                            </div>
                                            <input type="date" class="form-control" id="tfin" value="<?php echo date('Y-m-d');?>">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class=" float-right">
                                            <button class="btn btn-info" onclick="ReporteTransportePre();"><i class="nav-icon fa fa-eye" aria-hidden="true"></i> Consultar</button>                                       
                                            <button class="btn btn-info" onclick="ReporteTransporte();"><i class="nav-icon fa fa-print" aria-hidden="true"></i> Imprimir</button>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div calss="form-group">
                                            <div id="contenedortransporte" class="Altura" style="width:100%; overflow: scroll;"></div>
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
@include('footer')
</body>
</html>
