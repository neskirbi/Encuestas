<!DOCTYPE html>
<html lang="en">
<head>
  @include('finanzas.header')
  <title>CSMX | Pagos</title>

  
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
        <!-- Small boxes (Stat box) -->
        

        <div class="row">
          <div class="col-12">
            <div class="card ">
              <div class="card-header">
                <h5 class="card-title"><i class="fa fa-check" aria-hidden="true"></i> Validación de Pagos</h5>
              </div>
              <div class="card-body" style="overflow:scroll;">
                @if(count($pagos))
                @foreach($pagos as $pago)

                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-12">
                              <h5 class="card-title"><b>{{strlen($pago->obra)<81 ? $pago->obra : mb_substr($pago->obra,0,80,"UTF-8").'...'}}</b></h5>
                              @if($pago->status==0)
                                <small style="cursor:pointer;" onclick="alert('Detalle: {{$pago->detalle}}');" title="{{$pago->detalle}}" class="badge badge-danger float-right"><i class="fa fa-times" aria-hidden="true"></i> Cancelado</small>
                              @elseif($pago->status==1)
                                <small class="badge badge-warning float-right"><i class="fa fa-check" aria-hidden="true"></i> Pendiente</small>
                              @elseif($pago->status==2)
                                <small class="badge badge-success float-right"><i class="fa fa-check" aria-hidden="true"></i> Verificado</small>
                              @endif

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
                            <div class="col-md-2">
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
                                                    
                            <div class="col-md-3" style="padding:5px;">
                            @if($pago->status!=2)
                              <form action="VerificarPagoF/{{$pago->id}}" method="POST">
                              @csrf
                                <button style="width:100%;" class="btn btn-success btn-block btn-sm confirmarclick" data-texto="¿Desea verificar el pago?" type="submite">
                                  <i class="fa fa-check" aria-hidden="true"></i> Validar
                                </button>
                              </form>
                            @endif
                            </div>   

                            <div class="col-md-3" style="padding:5px;"> 
                            @if(file_exists(public_path('documentos/clientes/pagos/comprobantes').'/'.$pago->id.'.jpg'))
                            <a href="{{url('documentos/clientes/pagos/comprobantes').'/'.$pago->id.'.jpg'}}" target="_blank" class="btn btn-block btn-sm btn-info"><i class="fa fa-eye" aria-hidden="true"></i> Comprobante</a>
                            @endif
                            </div> 

                            <div class="col-md-3" style="padding:5px;"> </div>
                               
                            <div class="col-md-3" style="padding:5px;">
                            @if($pago->status!=0)
                            <button style="width:100%;" class="btn btn-danger btn-block btn-sm"  data-toggle="modal" data-target="#modalcancelarpago" data-id="{{$pago->id}}" data-nombre="{{$pago->obra}}" data-monto="$ {{number_format($pago->monto)}}" onclick="PrepararCancelacion(this,'CancelarPagoF');">
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
    GraficaPagos(HtmltoJson('{{($pagos_fecha)}}'));
</script>
@include('finanzas.pagosvalidacion.modals.modalpago')
@include('finanzas.pagosvalidacion.modals.modalcancelarpago')

</body>
</html>
