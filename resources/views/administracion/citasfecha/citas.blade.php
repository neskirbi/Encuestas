<!DOCTYPE html>
<html lang="en">
<head>
  @include('administracion.header')
  <title>CSMX | Citas</title>

  
</head>
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
                <h3 class="card-title">Citas</h3>

                <div class="card-tools">
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Filtros <i class="fa fa-sliders" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" style="width:300px;">
                      <form class="px-4 py-3" action="{{url('citasfecha')}}" method="GET">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-building"></i></span>
                          </div>
                          <input type="text" class="form-control" name="obra" id="obra" placeholder="Obra" @if(isset($filtros->obra)) value="{{$filtros->obra}}" @endif >
                        </div>

                        <div class="dropdown-divider"></div>
                        <a href="citasfecha" class="btn btn-default btn-sm">Limpiar</a>
                        <button type="submit" class="btn btn-info btn-sm float-right">Aplicar</button>
                        
                      </form>
                      
                    </div>
                  </div>                 
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12" style="overflow-x:scroll;">
                    @if(count($citas))
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                        <th>Obra</th>
                        <th>Folio</th>
                        <th>Matrícula</th>
                        <th>Fecha y hora</th>
                        <th>Horario</th>         
                        <th>Estatus</th>
                        <th colspan="3">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      
                        @foreach($citas as $cita)
                          <tr>
                          <td title="{{$cita->obra}}">{{strlen($cita->obra)<31 ? $cita->obra : mb_substr($cita->obra,0,30,"UTF-8").'...'}}</td>
                          <td title="{{$cita->folio}}">{{$cita->folio}}</td>
                          <td>{{$cita->matricula}}</td>
                          <td><input type="datetime-local" class="form-control" value="{{str_replace(' ','T',$cita->fechacita)}}" data-id="{{$cita->id}}" onchange="CambiaFecha(this)"></td>
                          <td>{{date('H:i:s',strtotime($cita->fechacita))}}</td>
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
                            <a href="cita/{{$cita->id}}" class="btn btn-info btn-sm" ><i class="fa fa-eye" aria-hidden="true"></i> Revisar</a>
                          
                          </td>
                          <td>
                          @if($cita->confirmacion==1)
                            <a href="boleta/{{$cita->id}}" target="_blank" class="btn btn-info btn-sm " title="Descargar boleta"><i class="fa fa-download" aria-hidden="true"></i> Boleta</a>
                          @endif
                          </td>
                          <td>
                          @if($cita->tipo=='Reciclaje')
                            <a href="manifiestodescarga/{{$cita->id}}" target="_blank" class="btn btn-info btn-sm" title="Descargar manifiesto"><i class="fa fa-download" aria-hidden="true"></i> Manifiesto</a>
                          @endif
                          </td>
                            
                            
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
              <div class="card-footer">
              {{ $citas->appends($_GET)->links('pagination::bootstrap-4') }}
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
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<script>
  function CambiaFecha(_this){
    _this=$(_this);
    var id = _this.data('id');
    var fecha=_this.val().replace('T',' ');
    $.ajax({
        method:'post',
        url: Url()+"api/CambiaFecha",
        data:{id:id,fecha:fecha},
        context: document.body
    }).done(function(data) {
        if(data=='1'){ 
          $(_this).addClass('is-valid');
        }
        if(data=='0'){
          $(_this).addClass('is-invalid')
        }
    });
  }
</script>
@include('administracion.footer')
</body>
</html>
