<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>{{GetSiglas(0)}} | Obras</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('asociados.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('asociados.sidebars.sidebar')

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

                <!--<div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>-->
                
              </div>
              <!-- /.card-header -->
              <div class="card-body"  style="overflow-x: scroll;">
                
                @if(count($obras))
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                    <th>Generador</th>
                    <th>Obra</th>
                    <th>Tipo de Obra</th>  
                    <th>Transporte</th>                  
                    <th>Estatus</th>
                    <th colspan="2">Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                
                    @foreach($obras as $obra)
                    <tr>
                      <td>{{strlen($obra->razonsocial)<30 ? $obra->razonsocial : mb_substr($obra->razonsocial,0,29,"UTF-8").' ...'}}</td>
                      <td>{{strlen($obra->obra)<30 ? $obra->obra : mb_substr($obra->obra,0,29,"UTF-8").' ...'}}</td>
                      <td>{{$obra->tipoobra}}</td>
                      <td>
                      @if($obra->transporte)
                        <center><i class="fas fa-check"></i></center>
                      @endif
                      </td>
                      <td>
                      @if($obra->verificado==0)
                        <small class="badge badge-warning"><i class="fa fa-exclamation" aria-hidden="true"></i> Pendiente</small>
                      @else
                        <small class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i>  Verificado</small>
                      @endif
                      </td>
                      <td>
                        <a href="obrasasoc/{{$obra->id}}" class="btn btn-info btn-sm d-inline p-2" ><i class="fa fa-eye" aria-hidden="true"></i> Revisar</a>
                        
                      </td>
                      <td>
                      @if($obra->verificado==1)
                        @if(file_exists('documentos/clientes/contratos/'.$obra->id.'.pdf'))
                        <a href="documentos/clientes/contratos/{{$obra->id}}.pdf" target="_blank" class="btn btn-info btn-sm d-inline p-2" > <i class="fa fa-download" aria-hidden="true"></i> Contrato</a>
                        @else
                        <small class="badge badge-danger"><i class="fa fa-times" aria-hidden="true"></i>  Sin contrato</small>
                        @endif
                      @endif
                      </td>
                    </tr>
                    @endforeach
                    
                  </tbody>
                </table>
                @endif
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

@include('asociados.footer')
</body>
</html>
