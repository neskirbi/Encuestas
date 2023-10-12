<!DOCTYPE html>
<html lang="en">
<head>
  @include('directores.header')
  <title>{{GetSiglas(0)}} | Dashboard</title>

  
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
                <!-- /.row grafica pagos-->  
                <div class="row">
                  <div class="col-md-12">

                    <div class="card card-primary card-outline card-outline-tabs" style="height:520px;">
                      <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="graficaptab" data-toggle="pill" href="#graficapagos" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Vista General</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="pagostab" data-toggle="pill" href="#pagosdetalle" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Pagos</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="saldostab" data-toggle="pill" href="#saldosdetalle" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Saldos</a>
                            </li>
                        </ul>
                      </div>
                      <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                          <div class="tab-pane fade active show" id="graficapagos" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">  
                            <iframe src="{{url('GraficaPagosDiretor')}}" frameborder="0" width="100%" height="450px"></iframe>                 
                          </div>

                          <div class="tab-pane fade" id="pagosdetalle" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                            <iframe src="{{url('pagosdirector')}}" frameborder="0" width="100%" height="450px"></iframe>
                          </div>

                          <div class="tab-pane fade" id="saldosdetalle" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                            <iframe src="{{url('saldosdirector')}}" frameborder="0" width="100%" height="450px"></iframe>
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
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Citas</h5>
              </div>
              <div class="card-body">

                <div class="card card-primary card-outline card-outline-tabs" style="height:620px;">
                  <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="graficatab" data-toggle="pill" href="#grafica" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Vista General</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="citastab" data-toggle="pill" href="#citasdirector" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Citas</a>
                        </li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                      <div class="tab-pane fade active show" id="grafica" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">  
                        <!--citas-->
                        <div class="row">
                          <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                              <span class="info-box-icon bg-info elevation-1"><i class="fa fa-calendar" aria-hidden="true"></i></span>

                              <div class="info-box-content">
                                <span class="info-box-text">Citas</span>
                                <span class="info-box-number">{{number_format($citas)}} m<sup>3</sup></span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>
                          <!-- /.col -->
                          <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                              <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-calendar-o" aria-hidden="true"></i></span>

                              <div class="info-box-content">
                                <span class="info-box-text">Pendientes</span>
                                <span class="info-box-number">{{number_format($pendientes)}} m<sup>3</sup></span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>
                          <!-- /.col -->

                          <!-- fix for small devices only -->
                          <div class="clearfix hidden-md-up"></div>

                          <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                              <span class="info-box-icon bg-success elevation-1"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>

                              <div class="info-box-content">
                                <span class="info-box-text">Asistencia</span>
                                <span class="info-box-number">{{number_format($confirmadas)}} m<sup>3</sup></span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>
                          <!-- /.col -->
                          <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                              <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-calendar-times-o" aria-hidden="true"></i></span>

                              <div class="info-box-content">
                                <span class="info-box-text">Falta</span>
                                <span class="info-box-number">{{number_format($faltas)}} m<sup>3</sup></span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>
                          <!-- /.col -->
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <iframe src="{{url('GraficasCitasDirector')}}" frameborder="0" width="100%" height="450px"></iframe>                 
                            
                          </div>
                        </div>                  
                      </div>

                      <div class="tab-pane fade" id="citasdirector" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                        <iframe src="{{url('citasdirector')}}" frameborder="0" width="100%" height="450px"></iframe>
                      </div>
                    </div>
                  </div>
                </div>

                  
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="nav-icon fa fa-dollar" aria-hidden="true"></i> Reporte Mensual
                </h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <iframe src="{{url('GraficasMaterialMesDirector')}}" frameborder="0" width="100%" height="500px"></iframe>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Contratos</h5>
                <div class="card-tools">
                  <a href="{{url('contratosdetalle')}}" class="btn btn-info">Detalle</a>
                </div>
              </div>
              <div clas="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="contratos">
                      <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
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
  
  GraficaContratosDirector('{{$firmados}}','{{$sinfirmar}}');
</script>
@include('administracion.footer')
</body>
</html>
