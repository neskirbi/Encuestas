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
              <span class="info-box-icon bg-info elevation-1"><i class="fa fa-calendar" aria-hidden="true"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Citas</span>
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
                <h3 class="card-title">    <i class="fa fa-truck"></i> Recolección</h3>

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
                  <!--<button data-toggle="modal" data-target="#modalcita" class="btn btn-primary"><span><i class="fa fa-plus" aria-hidden="true"></i></span> Registrar Cita</button>-->
                  <a href="recoleccion" class="btn btn-primary"><span><i class="fa fa-plus" aria-hidden="true"></i></span> Reservar Cita</a></div>
                </div>
                @if(count($recolecciones))
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>Origen</th>
                        <th>Tipo</th>
                        <th>Fecha cita</th>                    
                        <th>Estatus</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                      @foreach($recolecciones as $recoleccion)
                      <tr>
                        <td>{{$recoleccion->obra}}</td>
                        <td>{{$recoleccion->tipo}}</td>
                        <td>{{$recoleccion->fechacita}}</td>
                        <td>
                        @if($recoleccion->confirmacion==0)
                        <small class="badge badge-warning"><i class="fa fa-exclamation" aria-hidden="true"></i> Pendiente</small>
                        @elseif($recoleccion->confirmacion==1)
                        <small class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i>  Confirmado</small>
                        @elseif($recoleccion->confirmacion==2)
                        <small class="badge badge-danger"><i class="fa fa-check" aria-hidden="true"></i>  Falta</small>
                        @endif
                        </td>
                      </tr>
                      @endforeach
              
                    </tbody>
                  </table>
                 
                  @endif
                </div>
              <!-- /.card-body -->
              <div class="card-footer">
              {{ $recolecciones->links('pagination::bootstrap-4') }}
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
