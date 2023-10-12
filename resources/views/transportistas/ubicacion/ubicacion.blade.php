<!DOCTYPE html>
<html lang="en">
<head>
  @include('transportistas.header')
  <title>{{GetSiglas(0)}} | Ubicaciones / Mapas </title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('transportistas.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('transportistas.sidebars.sidebar')

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
                <div class="col-md-4">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Vehículos</h3>
                        </div>
                        <div class="card-body Altura" style="overflow-y:scroll;">
                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                @foreach($coordenadas as $coordenada)
                                <li class="item">
                                    <div class="product-img">
                                        <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                                    </div>
                                    <div class="product-info">
                                      
                                      <a class="nav-link" data-toggle="pill" href="#ruta_frame"  role="tab" onclick="MostrarMapa(this);" data-id="{{$coordenada->id}}">{{$coordenada->nombres.' '.$coordenada->apellidos}}
                                        <span class="badge badge-warning float-right">Ver</span>
                                      </a>
                                      <span class="product-description">
                                          {{FechaFormateada($coordenada->fecha)}}
                                      </span>
                                    </div>
                                </li>
                               @endforeach
                            </ul>    

                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Mapa</h3>
                            <div class="card-tools">
                              <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">                                  
                                  <a class="nav-link active" id="ubicacion" data-toggle="pill" href="#mapa_frame"  role="tab">Ubicaciones</a>
                                </li>
                              </ul>
                            </div>
                        </div>
                        <div class="card-body">
                          <div class="tab-content" id="custom-tabs-four-tabContent">
                            <!-- Morris chart - Sales -->
                            <div class="tab-pane fade active show" id="mapa_frame" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                              <iframe src="mapa" width="100%" height="500px" frameborder="0"></iframe>
                            </div>
                            <div class="tab-pane fade" id="ruta_frame" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                              <iframe id="ruta" src="" width="100%" height="500px" frameborder="0"></iframe>
                            </div>
                          </div>

                        </div>
                        <div class="card-footer"></div>
                    </div>
                    
                
                </div>    
            </div>
        </div>
      <!-- /.container-fluid -->
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
  function MostrarMapa(_this){
    $('#ubicacion').removeClass('active');    
    $(_this).removeClass('active');
    $('#ruta').attr('src',"{{url('ruta')}}?id="+$(_this).data('id')+'&dia={{date("Y-m-d")}}');
  }
</script>
@include('transportistas.footer')
</body>

</html>
