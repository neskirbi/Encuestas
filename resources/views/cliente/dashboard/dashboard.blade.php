<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>{{GetSiglas(0)}} | Dashboard</title>
  
</head>
<style>
  .boxpago{
    -webkit-box-shadow: 1px 2px 57px -15px rgba(0,0,0,0.75);
    -moz-box-shadow: 1px 2px 57px -15px rgba(0,0,0,0.75);
    box-shadow: 1px 2px 57px -15px rgba(0,0,0,0.75);
    border:1px #ccc solid; 
    border-radius:15px; 
    width:100%;
    padding:10px; 
    text-align:center;
  }

  .boxtransfer{
    border:1px #ccc solid; 
    border-radius:15px;
    padding:10px; 
    text-align:center;
    display:inline-block;
    cursor:pointer;

  }

</style>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts') 
<div class="wrapper">

  <!-- Preloader 
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>-->

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
              

        </div>  
        <!-- Small boxes (Stat box) -->
        <div class="row">
          
          <div class="col-md-4">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>$ {{number_format($pago==null ? 0 : $pago ,2)}}</h3>

                <p>Pagos</p>
              </div>
              <div class="icon">
              <i class="fas fa-donate"></i>
              </div>
              <a href="#" class="small-box-footer"><!--Detalle <i class="fas fa-arrow-circle-right">-->&nbsp;</i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-md-4" title="{{$saldo}}">
            <!-- small box -->
            @if(($saldo)<0)
            <div class="small-box bg-danger">
            @else
            <div class="small-box bg-info">
            @endif
            
              <div class="inner">
                <h3>$ {{number_format($saldo,2)}}</h3>

                <p>Saldo</p>
              </div>
              <div class="icon">
                <i class="fas fa-hand-holding-usd"></i>
              </div>
              <a href="#" class="small-box-footer"><!--Detalle <i class="fas fa-arrow-circle-right">-->&nbsp;</i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-md-4">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>$ {{ number_format($gasto,2)}}</h3>
                <p>Consumo</p>
              </div>
              <div class="icon">
              <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"><!--Detalle <i class="fas fa-arrow-circle-right">-->&nbsp;</i></a>
            </div>
          </div>
          </div>
        <!-- /.row --> 
        <div class="row">
          <div class="col-md-12">
            <!-- BAR CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Vista General</h3>
                <div class="card-tools">
                  
                </div>
              </div>
              <div class="card-body">
                
                <iframe src="{{url('GraficasPagosCliente')}}" frameborder="0" width="100%" height="450px"></iframe>
                
              </div>
              <!-- /.card-body -->
            </div>

          </div>
          <!-- /.col (RIGHT) -->
        </div>


        
        <!-- /.row --> 
        <div class="row">
          <div class="col-md-12">
            <!-- BAR CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Saldo por Planta</h3>
                <div class="card-tools">
                  
                </div>
              </div>
              <div class="card-body">
                
                <iframe src="{{url('GraficasSaldoPlanta')}}" frameborder="0" width="100%" height="450px"></iframe>
                
              </div>
              <!-- /.card-body -->
            </div>

          </div>
          <!-- /.col (RIGHT) -->
        </div>


        <div class="row">
          <div class="col-md-12">
            <!-- BAR CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Saldo por Obras</h3>
                <div class="card-tools">
                  
                </div>
              </div>
              <div class="card-body" style="overflow:scroll;">
                
                <div class="row">
                  <div class= "col-md-12">
                    <br>
                    <font color="#f00">Nota:Los saldos no son transferibles entre obras.</font>
                    <br>
                    
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th>Obra</th>
                          <th>Reciclaje</th>
                          <th>Pedidos</th>
                          <th>Pagos</th>
                          <th>Saldo</th>
                          <th>Planta</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($saldo_obras as $saldo)
                        <tr>
                          <td title="{{$saldo->obra}}">{{strlen($saldo->obra)<30 ? $saldo->obra : mb_substr($saldo->obra,0,29,"UTF-8").' ...'}}</td>
                          <td>$ {{number_format($saldo->reciclaje*1,2)}}</td>
                          <td>$ {{number_format($saldo->pedidos*1,2)}}</td>
                          <td>$ {{number_format($saldo->pagos*1,2)}}</td>
                          @if($saldo->pagos-($saldo->pedidos+$saldo->reciclaje)<0)
                          <td><small class="badge badge-danger float-right"><i class="fa fa-dollar"></i> {{number_format($saldo->pagos-($saldo->pedidos+$saldo->reciclaje),2)}}</small></td>
                          @else                        
                          <td><small class="badge badge-info float-right"><i class="fa fa-dollar"></i> {{number_format($saldo->pagos-($saldo->pedidos+$saldo->reciclaje),2)}}</small></td>
                          @endif
                        
                          <td>{{$saldo->planta}}</td>
                        </tr>
                      @endforeach                                  
                      </tbody>
                    </table>
                  </div>
                </div>
                
              </div>
              <!-- /.card-body -->
            </div>

          </div>
          <!-- /.col (RIGHT) -->
        </div>

        <div class="row">
          <div class="col-md-12">
            <!-- BAR CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Pagos y Consumo</h3>
                <div class="card-tools">
                  
                </div>
              </div>
              <div class="card-body">
                <div class="card card-primary card-outline card-outline-tabs" style="height:550px;">
                  <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                      
                      <li class="nav-item active">
                      <a class="nav-link active" id="pagostab" data-toggle="pill" href="#pagos" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Pagos</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="reciclajetab" data-toggle="pill" href="#reciclaje" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Reciclaje</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="pedidostab" data-toggle="pill" href="#pedidos" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Pedidos</a>
                      </li>
                      
                      
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                      
                      <div class="tab-pane fade active show" id="pagos" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab" style=" max-height: 420px; overflow-y:scroll;">
                     
                        <div class="row">
                          <div class= "col-md-12">
                            
                            <table class="table table-hover text-nowrap">
                              <thead>
                                <tr>
                                  <th>Monto</th>
                                  <th>Referencia</th>
                                  <th>Obra</th>
                                  <th>Fecha</th>
                                  <th colspan="3">Estatus</th>
                                </tr>
                              </thead>
                              <tbody>
                              @foreach($pagodetalles as $pagodetalle)
                                <tr>
                                  <td>$ {{number_format($pagodetalle->monto,2)}}</td>
                                  <td>{{$pagodetalle->referencia}}</td>
                                  <td title="{{$pagodetalle->obra}}">{{strlen($pagodetalle->obra)<30 ? $pagodetalle->obra : mb_substr($pagodetalle->obra,0,29,"UTF-8").' ...'}}</td>
                                  <td>{{FechaFormateada($pagodetalle->created_at)}}</td>
                                  <td>
                                      @if($pagodetalle->status==0)
                                        <small style="cursor:pointer;" onclick="alert('Detalle: {{$pagodetalle->detalle}}');" title="{{$pagodetalle->detalle}}" class="badge badge-danger"><i class="fa fa-times" aria-hidden="true"></i> Cancelado</small>
                                      @elseif($pagodetalle->status==1)
                                        <small class="badge badge-warning"><i class="fa fa-check" aria-hidden="true"></i> Pendiente</small>
                                      @elseif($pagodetalle->status==2)
                                        <small class="badge badge-info"><i class="fa fa-check" aria-hidden="true"></i> Correcto</small>
                                      @endif
                                  </td>
                                  <td>
                                  @if($pagodetalle->status==1)
                                    <a href="transferencia/{{$pagodetalle->id}}" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-download" aria-hidden="true"></i> L. Captura</a>
                                  @endif
                                  </td>
                                  <td>
                                  @if(!file_exists(public_path('documentos/clientes/pagos/comprobantes').'/'.$pagodetalle->id.'.jpg') && $pagodetalle->status==1)
                                  <a data-toggle="modal" data-target="#modalcomprobante" class="btn btn-info btn-sm" data-pid="{{$pagodetalle->id}}" style="width:100%;" onclick="CargarComprobante(this);"><i class="fa fa-upload" aria-hidden="true"></i> Comprobante</a>
                                  @endif
                                  @if(file_exists(public_path('documentos/clientes/pagos/comprobantes').'/'.$pagodetalle->id.'.jpg') && $pagodetalle->status==1)
                                  <a data-toggle="modal" data-target="#modalcomprobante" class="btn btn-success btn-sm" data-pid="{{$pagodetalle->id}}" style="width:100%;" onclick="CargarComprobante(this);"><i class="fa fa-refresh" aria-hidden="true"></i> Cambiar Comp.</a>
                                  @endif
                                  
                                  </td>
                                  
                                
                                </tr>
                              @endforeach                                  
                              </tbody>
                            </table>
                          </div>
                        </div>
                        
                        
                      </div>

                      <div class="tab-pane fade" id="reciclaje" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab" style=" max-height: 420px; overflow-y:scroll;">
                        <table class="table table-hover text-nowrap">
                          <thead>
                            <tr>
                              <th>Obra</th>
                              <th>Material</th>
                              <th>Cantidad</th>
                              <th>Precio</th>
                              <th>Subtotal</th>
                              <th>IVA</th>
                              <th>Total</th>
                              <th>Fecha</th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($reciclajes as $reciclaje)
                            <tr>
                              <td title="{{$reciclaje->obra}}">{{strlen($reciclaje->obra)<30 ? $reciclaje->obra : mb_substr($reciclaje->obra,0,29,"UTF-8").' ...'}}</td>
                              <td>{{mb_substr($reciclaje->material,0,50,"UTF-8")}}</td>
                              <td>{{number_format($reciclaje->cantidad,2)}} m<sup>3</sup></td>
                              <td>$ {{number_format($reciclaje->precio)}}</td>
                              <td>$ {{number_format($reciclaje->precio*$reciclaje->cantidad,2)}}</td>
                              <td>% {{number_format($reciclaje->iva,2)}}</td>
                              <td>$ {{number_format(($reciclaje->precio*$reciclaje->cantidad)+(($reciclaje->precio*$reciclaje->cantidad)*$reciclaje->iva/100),2)}}</td>
                              <td>
                              {{FechaFormateada($reciclaje->fechacita)}}
                              </td>                            
                            </tr>
                          @endforeach                                  
                          </tbody>
                        </table>
                      </div>

                      <div class="tab-pane fade" id="pedidos" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab" style=" max-height: 420px; overflow-y:scroll;">
                        <table class="table table-hover text-nowrap">
                          <thead>
                            <tr>
                              <th>Obra</th>
                              <th>Producto</th>
                              <th>Subtotal</th>
                              <th>IVA</th>
                              <th>Total</th>
                              <th>Fecha</th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($pedidos as $pedido)
                            <tr>
                              <td title="{{$pedido->obra}}">{{strlen($pedido->obra)<30 ? $pedido->obra : mb_substr($pedido->obra,0,29,"UTF-8").' ...'}}</td>
                              <td title="{!!$pedido->producto!!}">{!!$pedido->producto!!}</td>
                              <td>$ {{number_format($pedido->subtotal,2)}}</td>
                              <td>% {{number_format($pedido->iva,2)}}</td>
                              <td>$ {{number_format($pedido->total,2)}}</td>
                              <td>
                              {{FechaFormateada($pedido->fechaentrega)}}
                              </td>                            
                            </tr>
                          @endforeach                                  
                          </tbody>
                        </table>
                      </div>
                      <!--<div class="tab-pane fade" id="transferencia" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab" style=" max-height: 420px; overflow-y:scroll;">
                        
                      </div>-->
                      
                    </div>
                  </div>
                <!-- /.card -->
                </div>
                
              </div>
              <!-- /.card-body -->
            </div>

          </div>
          <!-- /.col (RIGHT) -->
        </div>


        <div class="row">
          <div class="col-md-6">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Obras</h3>
              </div>
              <div class="card-body">
                <div style="height:350px; overflow-y:scroll;" >
                  @foreach($obras as $obra)
                    <div class="col-12" style="cursor:pointer;" data-id="{{$obra->id}}" onclick="AvanceEntregas('{{$obra->id}}');">
                      <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="far fa-building"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-number"  title="{{$obra->obra}}">{{strlen($obra->obra)<50 ? $obra->obra : mb_substr($obra->obra,0,49,"UTF-8").' ...'}}</span>
                          <span>{{$obra->superficie}} m<sup>3</sup></span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      
                      <!-- /.info-box -->
                    </div>
                    
                  @endforeach
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Avance General Reciclaje</h3>
                
              </div>
              <div class="card-body">
                <div class="avancematerial" style="height:350px;">
                  
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <!-- BAR CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Avance Reciclaje</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="avance">
                </div>
              </div>
              <!-- /.card-body -->
            </div>

          </div>
          <!-- /.col (RIGHT) -->
        </div>

        <div class="row">
          <div class="col-md-12">
            <!-- BAR CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Detalle Reciclaje</h3>
                  <div class="card-tools" id="detalle">
                 
                  </div>
              </div>
              <div class="card-body" id="detalleentregas" style="overflow:scroll;">
                <div class="avance">
                </div>
              </div>
              <!-- /.card-body -->
            </div>

          </div>
          <!-- /.col (RIGHT) -->
        </div>
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
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
@include('cliente.dashboard.modals.modalcomprobante')

</body>
</html>
