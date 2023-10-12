<!DOCTYPE html>
<html lang="en">
<head>
  @include('ventas.header')
  <title>CSMX | Pagos</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('ventas.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('ventas.sidebars.sidebar')

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
              <h3 class="card-title"> <i class="nav-icon fa fa-check" aria-hidden="true"></i> Validación de Pagos</h3>
                <div class="card-tools">
                  <div class="btn-group">
                    <button type="button" class="btn  btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Filtros <i class="fa fa-sliders" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" style="width:300px;">
                      <form class="px-4 py-3" action="{{url('pagosv')}}" method="GET">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-building"></i></span>
                          </div>
                          <input type="text" class="form-control" name="obra" id="obra" placeholder="Obra" @if(isset($filtros->obra)) value="{{$filtros->obra}}" @endif >
                        </div>
                        

                        <div class="dropdown-divider"></div>
                        <a href="{{url('pagosv')}}" class="btn btn-block btn-default btn-sm">Limpiar</a>
                        <button type="submit" class="btn btn-block btn-info btn-sm float-right">Aplicar</button>
                        
                      </form>
                      
                    </div>
                  </div>                 
                </div>              

                
              </div>
              <div class="card-body">
              @if(count($pagos))
                @foreach($pagos as $pago)

                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-12">
                              <h5 class="card-title"><b>{{strlen($pago->generador)<81 ? $pago->generador : mb_substr($pago->generador,0,80,"UTF-8").'...'}}</b></h5>
                              @if($pago->status==0)
                                <small style="cursor:pointer;" onclick="alert('Detalle: {{$pago->detalle}}');" title="{{$pago->detalle}}" class="badge badge-danger float-right"><i class="fa fa-times" aria-hidden="true"></i> Cancelado</small>
                              @elseif($pago->status==1)
                                <small class="badge badge-warning float-right"><i class="fa fa-check" aria-hidden="true"></i> Pendiente</small>
                              @elseif($pago->status==2)
                                <small class="badge badge-success float-right"><i class="fa fa-check" aria-hidden="true"></i> Verificado</small>
                              @endif

                              <br>
                              <h5 class="card-title"><b>{{strlen($pago->obra)<81 ? $pago->obra : mb_substr($pago->obra,0,80,"UTF-8").'...'}}</b></h5>
                             
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              Referencia: <b>{{$pago->referencia}}</b>
                            </div>
                          </div>
                          <div class="row">
                                
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="cantidad">Fecha</label>
                                  <input  type="text" class="form-control" id="created_at"  value="{{FechaFormateada($pago->created_at).' '.date('H:i:s',strtotime($pago->created_at))}}">
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="Monto">Monto</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                  </div>
                                  <input disabled  type="text" class="form-control" id="Monto"  value="{{number_format($pago->monto,2)}}">
                                </div>
                              </div>
                            </div>
                                
                                
                              
                          </div> 
                          <div class="row">
                                                    
                            <div class="col-md-3" >
                            @if($pago->status!=2)
                              <form action="VerificarPagov/{{$pago->id}}" method="POST">
                              @csrf
                                <button style="width:100%;" class="btn btn-block btn-success confirmarclick" data-texto="¿Desea verificar el pago?" type="submite">
                                  <i class="fa fa-check" aria-hidden="true"></i> Validar
                                </button>
                              </form>
                            @endif
                            </div>   

                            <div class="col-md-3" > 
                            @if(file_exists(public_path('documentos/clientes/pagos/comprobantes').'/'.$pago->id.'.jpg'))
                            <a href="{{url('documentos/clientes/pagos/comprobantes').'/'.$pago->id.'.jpg'}}" target="_blank" class="btn btn-block btn-info"><i class="fa fa-eye" aria-hidden="true"></i> Comprobante</a>
                            @endif
                            </div> 
                            <div class="col-md-3" > 
                            <a href="{{url('pagosv').'/'.$pago->id}}" target="_blank" class="btn btn-block btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modificar</a></div>   

                            <div class="col-md-3" >
                            @if($pago->status!=0)
                            <button style="width:100%;" class="btn btn-block btn-danger"  data-toggle="modal" data-target="#modalcancelarpago" data-id="{{$pago->id}}" data-nombre="{{$pago->obra}}" data-monto="$ {{number_format($pago->monto)}}" onclick="PrepararCancelacion(this,'CancelarPagov');">
                              <i class="fa fa-times" aria-hidden="true"></i> Cancelar
                            </button>  
                            @endif   
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
              {{ $pagos->appends($_GET)->links('pagination::bootstrap-4') }}
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
@include('ventas.pagosvalidacion.modals.modalpago')
@include('ventas.pagosvalidacion.modals.modalcancelarpago')

</body>
</html>
