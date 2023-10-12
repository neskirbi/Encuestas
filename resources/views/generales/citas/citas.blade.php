<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>{{GetSiglas(0)}} | Citas</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

 <!-- Navbar -->
 @if(Auth::guard('clientes')->check())
    @include('cliente.navigations.navigation')  
  @endif

  @if(Auth::guard('residentes')->check())
    @include('residentes.navigations.navigation')  
  @endif
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @if(Auth::guard('clientes')->check())
    @include('cliente.sidebars.sidebar') 
  @endif

  @if(Auth::guard('residentes')->check())
    @include('residentes.sidebars.sidebar') 
  @endif

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
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fa fa-building" aria-hidden="true"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Sitio <i class="fa fa-recicler" aria-hidden="true"></i></span>
                <span class="info-box-number">{{$citas_sitio_count}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-truck" aria-hidden="true"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Tránsito</span>
                <span class="info-box-number">{{$citas_transito_count}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Asistencia</span>
                <span class="info-box-number">{{$citas_asistidas_count}}</span>
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
                <span class="info-box-number">{{$citas_falta_count}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <div class="row">
        
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-recycle"></i> Reciclaje</h3>

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
              <div class="card-body" style="overflow-x:scroll;">
                <div class="p-2">
                  <!--<button data-toggle="modal" data-target="#modalcita" class="btn btn-primary"><span><i class="fa fa-plus" aria-hidden="true"></i></span> Registrar Cita</button>-->
                  <a href="reciclaje" class="btn btn-primary"><span><i class="fa fa-plus" aria-hidden="true"></i></span> Reservar Cita</a>
                </div>
                @if(Session::has('abrecita'))
                <script>
                  window.open('manifiesto/{{Session::get("abrecita")}}', "_blank"); // will open new tab on window.onload
                </script>
                @endif
                @if(count($citas))
                @foreach($citas as $cita)
                  <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                              <div class="row">
                                    
                                <div class="col-md-12">
                                  <h5 class="card-title"><b>{{strlen($cita->obra)<81 ? $cita->obra : mb_substr($cita->obra,0,80,"UTF-8").'...'}}</b></h5>
                                  @if($cita->confirmacion==0)
                                  <small class="badge badge-info float-right"><i class="fa fa-exclamation" aria-hidden="true"></i> En sitio</small>
                                  @elseif($cita->confirmacion==1)
                                  <small class="badge badge-success float-right"><i class="fa fa-check" aria-hidden="true"></i>  Confirmado</small>
                                  @elseif($cita->confirmacion==2)
                                  <small class="badge badge-danger float-right"><i class="fa fa-check" aria-hidden="true"></i>  Falta</small>
                                  @elseif($cita->confirmacion==3)
                                  <small class="badge badge-warning float-right"><i class="fa fa-check" aria-hidden="true"></i>  En Transito</small>
                                  @endif

                                  <p class="card-text">
                                  {{$cita->material}}
                                  </p>
                                    
                                    
                                  <div class="row">
                                    
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="cantidad">Fecha Cita</label>
                                          <input disabled type="text" class="form-control" id="fechacita"  value="{{FechaFormateada($cita->fechacita).' '.date('H:i:s',strtotime($cita->fechacita))}}">
                                      </div>
                                    </div>
                                    <div class="col-md-2">
                                      <div class="form-group">
                                        <label for="cantidad">Cantidad</label>
                                        <div class="input-group">
                                          <input disabled type="text" class="form-control" id="cantidad"  value="{{$cita->cantidad}}">
                                          <div class="input-group-append">
                                              <span class="input-group-text">m<sup>3</sup></span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    
                                    
                                    </td>
                                  </div> 
                                  <div class="row">

                                    <div class="col-md-2">
                                      @if($cita->confirmacion==0)
                                      <br>
                                      <a href="firma/{{$cita->id}}" class="btn btn-info " title="Firma de recepción de material por parte del transportista."><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Entregar </a>
                                      @endif
                                    </div>
                                    <div class="col-md-2">
                                       @if($cita->confirmacion==0)
                                       <br>
                                      <a href="EntregaQr/{{$cita->id}}" class="btn btn-info" title="Entregar con qr al transportista."><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Entregar QR </a>
                                      @endif
                                    </div>     
                                    
                                    <div class="col-md-4">
                                      
                                    </div>
                                    
                     
                                    
                                    <div class="col-md-2">
                                      @if($cita->confirmacion!=0 && $cita->confirmacion!=2) 
                                      <br>                                       
                                      <a href="manifiestodescarga/{{$cita->id}}" target="_blank" class="btn btn-info float-right" title="Descargar manifiesto"><i class="fa fa-download" aria-hidden="true"></i> Manifiesto</a>
                                      @endif
                                    </div>

                                    <div class="col-md-2">
                                      @if($cita->confirmacion==1)
                                      <br>
                                      <a href="boleta/{{$cita->id}}" target="_blank" class="btn btn-info float-right" title="Descargar boleta"><i class="fa fa-download" aria-hidden="true"></i> Boleta</a>
                                      @endif    
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12">
                                      @if($cita->confirmacion==0)
                                      <br>
                                      <span style="color:#ff0000;">¡¡Importante!! Capture los datos del transportista y firma para completar la información del manifiesto(Botón "Entregar") </span>
                                      @endif
                                    </div>
                                  </div>
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
              {{ $citas->links('pagination::bootstrap-4') }}
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
<script src="dist/js/adminlte.js"></script>


</body>
</html>
