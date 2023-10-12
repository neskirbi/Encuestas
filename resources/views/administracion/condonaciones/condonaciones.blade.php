<!DOCTYPE html>
<html lang="en">
<head>
  @include('administracion.header')
  <title>CSMX | Condonaciones</title>

  
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
        <!-- Small boxes (Stat box) -->
        

        <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header">
              <h3 class="card-title"> <i class="nav-icon fa fa-bars" aria-hidden="true"></i> Condonaciones</h3>
                <div class="card-tools">
                  <div class="btn-group">
                    <button type="button" class="btn  btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Filtros <i class="fa fa-sliders" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" style="width:300px;">
                      <form class="px-4 py-3" action="{{url('condonaciones')}}" method="GET">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-building"></i></span>
                          </div>
                          <input type="text" class="form-control" name="obra" id="obra" placeholder="Obra" @if(isset($filtros->obra)) value="{{$filtros->obra}}" @endif >
                        </div>
                        
                        <div class="row">
                          <div class="col-6">
                            <a href="{{url('condonaciones')}}" class="btn btn-block btn-default btn-sm">Limpiar</a>
                          </div>
                          <div class="col-6">
                            <button type="submit" class="btn btn-block btn-info btn-sm float-right">Aplicar</button>
                          </div>
                        </div>
                        
                        
                        
                      </form>
                      
                    </div>
                  </div>                 
                </div>              

                
              </div>
              <div class="card-body">
                <button class="btn btn-danger"  data-toggle="modal" data-target="#modalcondonacion"  >
                  <i class="fa fa-plus" aria-hidden="true"></i> Condonar
                </button> 
                <br> 
                <br> 
                <br> 


              @if(count($condonaciones))
                @foreach($condonaciones as $condonacion)

                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-12">
                              <h5 class="card-title"><b>{{strlen($condonacion->obra)<81 ? $condonacion->obra : mb_substr($condonacion->obra,0,80,"UTF-8").'...'}}</b></h5>
                              <small class="badge badge-info float-right"><i class="fa fa-check" aria-hidden="true"></i> Condonado</small>

                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              Detalle: <b>{{$condonacion->detalle}}</b>
                            </div>
                          </div>
                          <div class="row">
                                
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="cantidad">Fecha</label>
                                  <input  type="text" class="form-control" id="created_at"  value="{{FechaFormateada($condonacion->created_at).' '.date('H:i:s',strtotime($condonacion->created_at))}}">
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="Monto">Monto</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                  </div>
                                  <input disabled  type="text" class="form-control" id="Monto"  value="{{number_format($condonacion->monto,2)}}">
                                </div>
                              </div>
                            </div>
                                
                                
                              
                          </div> 
                          <div class="row">
                                                    
                            <div class="col-md-3" >
                            
                            </div>   

                            <div class="col-md-3" > 
                           
                            </div> 
                            <div class="col-md-3" > 
                              
                            </div>   

                            <div class="col-md-3" >
                            
                            </div>   
                          </div>
                        </div>
                    </div>
                      
                  </div>
                </div>



                
                
                @endforeach
                @endif


                
              </div>

              <div class="card-footer">
              {{ $condonaciones->appends($_GET)->links('pagination::bootstrap-4') }}
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
<script>
</script>
@include('administracion.condonaciones.modals.modalpago')

</body>
</html>
