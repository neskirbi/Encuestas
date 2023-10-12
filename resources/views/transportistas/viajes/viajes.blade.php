<!DOCTYPE html>
<html lang="en">
<head>
  @include('transportistas.header')
  <title>{{GetSiglas(0)}} | Viajes</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    @include('toast.toasts')  
<div class="wrapper">

 <!-- Navbar -->
    @include('transportistas.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
    @include('transportistas.sidebars.sidebar')
  

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
              <span class="info-box-icon bg-info elevation-1"><i class="fa fa-calendar" aria-hidden="true"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Citas <i class="fa fa-recicler" aria-hidden="true"></i></span>
                <span class="info-box-number">{{$citas_count}}</span>
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
                <span class="info-box-number">{{$citas_pendientes_count}}</span>
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
                <h3 class="card-title"><i class="fa fa-recycle"></i> Viajes</h3>

            
                
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x:scroll;">
                
                @if(Session::has('abrecita'))
                <script>
                  window.open('manifiesto/{{Session::get("abrecita")}}', "_blank"); // will open new tab on window.onload
                </script>
                @endif
                @if(count($citas))
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>Origen</th>
                        <th>Tipo</th>
                        <th>Fecha cita</th>                    
                        <th>Estatus</th>
                        <th colspan="4">Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                      @foreach($citas as $cita)
                        <tr>
                        <td title="{{$cita->obra}}">{{strlen($cita->obra)<30 ? $cita->obra : mb_substr($cita->obra,0,29,"UTF-8").' ...'}}</td>
                        <td>{{$cita->tipo}}</td>
                        <td>{{FechaFormateada($cita->fechacita)}}</td>
                        <td>
                        @if($cita->confirmacion==0)
                        <small class="badge badge-info"><i class="fa fa-exclamation" aria-hidden="true"></i> En sitio</small>
                        @elseif($cita->confirmacion==1)
                        <small class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i>  Confirmado</small>
                        @elseif($cita->confirmacion==2)
                        <small class="badge badge-danger"><i class="fa fa-check" aria-hidden="true"></i>  Falta</small>
                        @elseif($cita->confirmacion==3)
                        <small class="badge badge-warning"><i class="fa fa-check" aria-hidden="true"></i>  En Transito</small>
                        @endif
                      </td>
                      <td>
                        <a href="viajes/{{$cita->id}}"  class="btn btn-info btn-sm d-inline p-2" title="Descargar boleta"><i class="fa fa-map" aria-hidden="true"></i> Recorrido</a>
                      </td>
                        
                        
                        <td>
                        @if($cita->confirmacion==3 || $cita->confirmacion==1)
                          <!--Manifiesto siempre visible si no es falta-->
                          <a href="manifiestodescarga/{{$cita->id}}" target="_blank" class="btn btn-info btn-sm d-inline p-2" title="Descargar manifiesto"><i class="fa fa-download" aria-hidden="true"></i> Manifiesto</a>
                        @endif
                        </td>
                       
                      
                    
                      </tr>
                      @endforeach
              
                    </tbody>
                  </table>
                  
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
