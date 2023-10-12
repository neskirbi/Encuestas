<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>CSMX | Negocios</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('cliente.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('cliente.sidebars.sidebar')

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
                <h3 class="card-title"><i class="fa fa-industry" aria-hidden="true"></i> Establecimientos </h3>

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
              <div class="card-body">
                <div class="p-2">
                  <a href="{{url('negocios/create')}}" class="btn btn-primary"><span><i class="fa fa-plus" aria-hidden="true"></i></span> Establecimiento</a>
                </div>
                <div class="row">
                  <div class="col-md-12" style="overflow-x:scroll;">
                    @if(count($negocios))
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th>Establecimientos</th>
                          <th>Tipo de Establecimientos</th>                    
                          <th>Estatus</th>
                          <th colspan="3">Opciones</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                      
                        @foreach($negocios as $negocio)
                        <tr>
                          <td>{{$negocio->negocio}}</td>
                          <td>{{$negocio->tiponegocio}}</td>
                          <td>@if($negocio->verificado==0)
                            <small class="badge badge-warning"><i class="fa fa-exclamation" aria-hidden="true"></i> Pendiente</small>
                            @else
                            <small class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i>  Verificado</small>
                            @endif
                          </td>
                          
                          
                          <td>
                            <a href="negocios/{{$negocio->id}}" class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Ver</a>
                          </td>

                          <td>
                            @if(file_exists('documentos/clientes/contratos/'.$negocio->id.'.pdf'))
                              <a href="documentos/clientes/contratos/{{$negocio->id}}.pdf" target="_blank" class="btn btn-info btn-sm d-inline p-2" >Contrato <i class="fa fa-download" aria-hidden="true"></i></a>
                            @endif
                          </td>
                          
                          <td>
                            @if($negocio->verificado==0)
                            <form action="negocios/{{$negocio->id}}" method="POST"  class="d-inline p-2">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <button  id="borrar" class="borrar btn btn-danger btn-sm" data-texto="¿Eliminar Registro?"><i class="fa fa-times" aria-hidden="true"></i></button>
                                
                            </form>
                            @endif

                            @if($negocio->verificado==1)
                            <a href="negocio/cedula/{{$negocio->id}}" class="btn btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> Cédula QR</a>
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
</body>
</html>
