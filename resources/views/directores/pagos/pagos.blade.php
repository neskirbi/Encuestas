<!DOCTYPE html>
<html lang="en">
<head>
  @include('directores.header')
  <title>{{GetSiglas(0)}} | Pagos</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('directores.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('directores.sidebars.sidebar')

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


          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Pagos</h5>
              </div>
              <div class="card-body">


                <form action="{{url('pagosd')}}" method="get">
                  

                <div class="row">
          
                  <div class="col-md-4">
                    
                  </div>
                
                  <div class="col-md-2">
                      
                  </div>

                  <div class="col-md-2">
                      
                  </div>

                  <div class="col-md-2">
                      <div class="input-group ">
                          <input name="year" id="year" class="form-control" type="number" step="1" min="2021" value="{{isset($filtros->year) ? $filtros->year : date('Y')}}" >                                    
                          <div class="input-group-append">
                              <span class="input-group-text">Año</span>
                          </div>
                      </div>
                  </div>

                  
                  <div class="col-md-2">
                      <button class="btn btn-info btn-block"> Consultar</button>
                  </div>
                  
                  
                </div>
                </form>

                <br>


                <div class="row">
                  <div class="col-md-6">
                    <!-- small box -->
                    
                    <div class="small-box bg-success" title="Es el total de pagos acreditados a la planta.">
                    
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
                    <div class="small-box bg-warning" title="Es el total de reciclaje, transporte y compra de agregados con IVA.">
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
                    <div class="small-box bg-danger" title="Es el total de los pagos que se condonan a las obras.">
                      <div class="inner">
                        <h3 >$ {{number_format($saldo['condonado'],2)}}</h3>
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
                    <div class="small-box bg-info" title="Es el balance de la planta lo ideal es 0 &oacute; >0.">
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
                  <div class="col-md-12">
                    <!-- small box -->
                    
                    <div class="small-box bg-black" title="Es el volumen total que ha recibido la planta.">
                    
                      <div class="inner">
                        <h3> {{number_format($saldo['metros']==null?0:$saldo['metros'],2)}} m<sup>3</sup></h3>
                        <p>Cantidad</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="#" class="small-box-footer"><!--Detalle <i class="fas fa-arrow-circle-right">-->&nbsp;</i></a>
                    </div>

                  </div>
                </div>
                <!-- /.row grafica pagos-->  
                <div class="row" style="display:none;">
                  <div class="col-md-12">

                    <div class="card ">
                      <div class="card-header">
                        <h5 class="card-title">
                          Pagos
                        </h5>
                        
                      </div>
                      <div class="card-body">
                        <div class="row">                                
                          <div class="col-md-12">
                            <div class="pagos"></div> 
                          </div>
                        </div>                
                      </div>
                    </div>


                    
                  </div>
                </div>   
              </div>
            </div>
          </div>
        </div>
        
      <!-- /.container-fluid -->
      
      <!-- /.row grafica citas-->  
      
      
       
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
      
  
  GraficaPagosGastosDirector(HtmltoJson('{{$pagosmesp}}'),HtmltoJson('{{$citasmesp}}'),HtmltoJson('{{$pedidosmesp}}'),HtmltoJson('{{$metrosmesp}}'));
</script>
</body>
</html>
