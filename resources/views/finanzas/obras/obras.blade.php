<!DOCTYPE html>
<html lang="en">
<head>
  @include('finanzas.header')
  <title>{{GetSiglas(0)}} | Obras</title>

  
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
                <h3 class="card-title">Obras</h3>

                <div class="card-tools">
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Filtros <i class="fa fa-sliders" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" style="width:300px;">
                      <form class="px-4 py-3" action="{{url('obrasfi')}}" method="GET">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-building"></i></span>
                          </div>
                          <input type="text" class="form-control" name="obra" id="obra" placeholder="Obra" @if(isset($filtros->obra)) value="{{$filtros->obra}}" @endif >
                        </div>

                        <div class="dropdown-divider"></div>
                        <a href="obrasfi" class="btn btn-default btn-sm">Limpiar</a>
                        <button type="submit" class="btn btn-info btn-sm float-right">Aplicar</button>
                        
                      </form>
                      
                    </div>
                  </div>                 
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12" style="overflow-x:scroll;">
                    @if(count($obras))
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                        <th>Obra</th>
                        <th>Residuos Declarados</th>
                        <th>Residuos Entregados</th>
                        <th>Residuos Pendientes</th>
                        <th>Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                    
                        @foreach($obras as $obra)
                        <tr>
                          <td title="{{$obra->obra}}"><a href="obrasfi/{{$obra->id}}">{{strlen($obra->obra)<30 ? $obra->obra : mb_substr($obra->obra,0,29,"UTF-8").' ...'}}</a></td>
                          <td title="Declarados:{{number_format($obra->cantidadobra,2)}} {{$obra->superunidades}}">{{number_format($obra->cantidadobra,2)}} {{$obra->superunidades}}</td>
                          <td title="Entregados:{{number_format($obra->entregado,2)}} {{$obra->superunidades}}">{{number_format($obra->entregado,2)}} {{$obra->superunidades}}</td>                          
                          <td title="Pendientes:{{number_format($obra->cantidadobra-$obra->entregado,2)}} {{$obra->superunidades}}">{{number_format($obra->cantidadobra-$obra->entregado,2)}} {{$obra->superunidades}}</td>
                          <td>
                            @if(file_exists('documentos/clientes/contratos/'.$obra->id.'.pdf'))
                            <a href="documentos/clientes/contratos/{{$obra->id}}.pdf?ver={{rand(0,10000)}}" target="_blank" class="btn btn-info btn-sm d-inline p-2" > <i class="fa fa-download" aria-hidden="true"></i> Contrato</a>
                            @endif
                          </td>
                        </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                    @endif
                  </div>
                </div>
                
                
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
              {{ $obras->appends($_GET)->links('pagination::bootstrap-4') }}
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

@include('finanzas.footer')
</body>
</html>
