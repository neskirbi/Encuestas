<!DOCTYPE html>
<html lang="en">
<head>
  @include('ventas.header')
  <title>CSMX | Citas</title>

  
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
                      <form class="px-4 py-3" action="{{url('citasventas')}}" method="GET">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-building"></i></span>
                          </div>
                          <input type="text" class="form-control" name="obra" id="obra" placeholder="Obra" @if(isset($filtros->obra)) value="{{$filtros->obra}}" @endif >
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-file-text" aria-hidden="true"></i></span>
                          </div>
                          <input type="text" class="form-control" name="folio" id="folio" placeholder="Folio" @if(isset($filtros->folio)) value="{{$filtros->folio}}" @endif >
                        </div>

                        <div class="dropdown-divider"></div>
                        <a href="citasventas" class="btn btn-default btn-sm">Limpiar</a>
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

                    @foreach($citas as $cita)
                    <div class="row">
                      <div class="col-md-12">
                          <div class="card">
                              <div class="card-body">
                                <div class="row">
                                      
                                  <div class="col-md-12">
                                    @if($cita->folio!=0)
                                    <span><b>Folio:</b> {{$cita->folio}}</span><br>
                                    @endif
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
                                      <div class="col-md-2">
                                        <div class="form-group">
                                          <label for="cantidad">Matrícula</label>
                                            <input  type="text" class="form-control" id="matricula"  value="{{$cita->matricula}}">
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="cantidad">Fecha Cita</label>
                                            <input  type="text" class="form-control" id="fechacita"  value="{{FechaFormateada($cita->fechacita).' '.date('H:i:s',strtotime($cita->fechacita))}}">
                                        </div>
                                      </div>
                                      <div class="col-md-2">
                                        <div class="form-group">
                                          <label for="cantidad">Cantidad</label>
                                          <div class="input-group">
                                            <input  type="text" class="form-control" id="cantidad"  value="{{$cita->cantidad}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text">m<sup>3</sup></span>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-2">
                                        <div class="form-group">
                                          <label for="precio">Precio</label>
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input  class="form-control" id="precio" type="text" value="{{number_format($cita->precio,2)}}">
                                          </div>
                                        </div>
                                      </div>
                                      
                                      
                                      </td>
                                    </div> 
                                    <div class="row">
                                      <div class="col-md-8">
                                        <a href="citasventas/{{$cita->id}}" target="_blank" class="btn btn-success" title="Revisar"><i class="fa fa-eye" aria-hidden="true"></i> Revisar</a>
                                      </div>                       
                                      
                                      @if($cita->confirmacion!=0 && $cita->confirmacion!=2)                                          
                                      <div class="col-md-2">
                                        <a href="manifiestodescarga/{{$cita->id}}" target="_blank" class="btn btn-info float-right" title="Descargar manifiesto"><i class="fa fa-download" aria-hidden="true"></i> Manifiesto</a>
                                      </div>
                                      @endif

                                      @if($cita->confirmacion==1)
                                      <div class="col-md-2">
                                        <a href="boleta/{{$cita->id}}" target="_blank" class="btn btn-info float-right" title="Descargar boleta"><i class="fa fa-download" aria-hidden="true"></i> Boleta</a>
                                      </div>
                                      @endif    
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

</body>
</html>
