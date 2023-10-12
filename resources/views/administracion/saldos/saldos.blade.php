<!DOCTYPE html>
<html lang="en">
<head>
  @include('administracion.header')
  <title> {{GetSiglas(0)}} | Saldos</title>

  
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
          <div class="col-md-6">
            <!-- small box -->
            
            <div class="small-box bg-success">
            
              <div class="inner">
                <h3>$ {{number_format($saldo['pago']==null?0:$saldo['pago'],2)}}</h3>
                <p>Pagos</p>
              </div>
              <div class="icon">
                <i class="fas fa-money"></i>
              </div>
              <a href="#" class="small-box-footer"><!--Detalle <i class="fas fa-arrow-circle-right">-->&nbsp;</i></a>
            </div>
          </div>
          
          <!-- ./col -->
          <div class="col-md-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>$ {{number_format($saldo['consumo'],2)}}</h3>
                <p>Consumo</p>
              </div>
              <div class="icon">
              <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"><!--Detalle <i class="fas fa-arrow-circle-right">-->&nbsp;</i></a>
            </div>
          </div>

          <div class="col-md-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>$ {{number_format($saldo['condonado'],2)}}</h3>
                <p>Condonado</p>
              </div>
              <div class="icon">
              <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"><!--Detalle <i class="fas fa-arrow-circle-right">-->&nbsp;</i></a>
            </div>
          </div>
          <div class="col-md-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>$ {{number_format($saldo['total'],2)}}</h3>
                <p>Total</p>
              </div>
              <div class="icon">
              <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"><!--Detalle <i class="fas fa-arrow-circle-right">-->&nbsp;</i></a>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-dollar" aria-hidden="true"></i> Saldos</h3>
                

                <div class="card-tools">
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Filtros <i class="fa fa-sliders" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" style="width:300px;">
                      <form class="px-4 py-3" action="{{url('saldos')}}" method="GET">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-building"></i></span>
                          </div>
                          <input type="text" class="form-control" name="obra" id="obra" placeholder="Obra" @if(isset($filtros->obra)) value="{{$filtros->obra}}" @endif >
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="correcto" {{boolval($filtros->correcto)?'checked': ''}}>
                          <label class="form-check-label"><small class="badge badge-info float-right">Correctos</small></label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="atrasado" {{boolval($filtros->atrasado)?'checked': ''}}>
                          <label class="form-check-label"><small class="badge badge-danger float-right">Retrasado</small></label>
                        </div>
                        
                      

                        <div class="dropdown-divider"></div>
                        <a href="{{url('saldos')}}" class="btn btn-default btn-sm">Limpiar</a>
                        <button type="submit" class="btn btn-info btn-sm float-right">Aplicar</button>
                        
                      </form>
                      
                    </div>
                  </div>                 
                </div>



              </div>
              <div class="card-body " >
                @if(count($clientegastos))
                  
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                      <th>Obra</th>
                      <th>Pagos</th>
                      <th>Entregas</th>
                      <th>Pedidos</th>                      
                      <th>Condonado</th>
                      <th>Saldo</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($clientegastos as $clientegasto)
                    
                      <tr>
                        <td title="{{$clientegasto->obra}}">{{strlen($clientegasto->obra)<30 ? $clientegasto->obra : mb_substr($clientegasto->obra,0,29,"UTF-8").' ...'}}</td>
                        <td class="bg-success" title="Pagos: $ {{number_format($clientegasto->pagos==null?0:$clientegasto->pagos,2)}}">$ {{number_format($clientegasto->pagos==null?0:$clientegasto->pagos,2)}}</td>
                        <td class="bg-warning" title="Entregas: $ {{number_format($clientegasto->reciclaje==null?0:$clientegasto->reciclaje,2)}}">$ {{number_format($clientegasto->reciclaje==null?0:$clientegasto->reciclaje,2)}}</td>
                        <td class="bg-warning" title="Pedidos: $ {{number_format($clientegasto->pedidos==null?0:$clientegasto->pedidos,2)}}">$ {{number_format($clientegasto->pedidos==null? 0 :$clientegasto->pedidos,2)}}</td>
                        <td class="bg-danger" title="Condonado: $ {{number_format($clientegasto->condonado==null?0:$clientegasto->condonado,2)}}">$ {{number_format($clientegasto->condonado==null?0:$clientegasto->condonado,2)}}</td>
                        @if(($clientegasto->pagos+$clientegasto->condonado)-($clientegasto->reciclaje+$clientegasto->pedidos)<0)
                        <td title="Saldo: ${{number_format(($clientegasto->pagos+$clientegasto->condonado)-($clientegasto->reciclaje+$clientegasto->pedidos),2)}}"><small class="badge badge-danger float-right"><i class="fa fa-dollar"></i> {{number_format(($clientegasto->pagos+$clientegasto->condonado)-($clientegasto->reciclaje+$clientegasto->pedidos),2)}}</small></td>
                        @else                        
                        <td title="Saldo: ${{number_format(($clientegasto->pagos+$clientegasto->condonado)-($clientegasto->reciclaje+$clientegasto->pedidos),2)}}"><small class="badge badge-info float-right"><i class="fa fa-dollar"></i> {{number_format(($clientegasto->pagos+$clientegasto->condonado)-($clientegasto->reciclaje+$clientegasto->pedidos),2)}}</small></td>
                        @endif
                       

                      </tr>
                      @endforeach
                     
                    </tbody>
                  </table>
                @endif
                {{ $links->appends($_GET)->links('pagination::bootstrap-4') }}

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

</body>
</html>
