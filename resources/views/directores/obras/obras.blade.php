<!DOCTYPE html>
<html lang="en">
<head>
  @include('directores.header')
  <title>CSMX | Obras</title>

  
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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Obras</h3>

                <div class="card-tools">
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Filtros <i class="fa fa-sliders" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" style="width:300px;">
                      <form class="px-4 py-3" action="{{url('contratosdetalle')}}" method="GET">

                      <div class="row">
                          <div class="col-md-6">
                            <div class="form-check">
                              <input onchange="Checks(this);" type="checkbox" class="form-check-input" data-no="nopuedepospago" name="puedepospago" id="puedepospago" @if(isset($filtros->puedepospago)) checked @endif >
                              <span class=" badge" style="color:#000; ">Pospago</span>                            
                              </label>
                            </div>
                        </div>
                            <div class="col-md-6">
                            <div class="form-check">
                              <input onchange="Checks(this);" type="checkbox" class="form-check-input" data-no="puedepospago" name="nopuedepospago" id="nopuedepospago" @if(isset($filtros->nopuedepospago)) checked @endif>
                              <span class=" badge" style="color:#000; ">Sin Pospago</span>                            
                              </label>
                            </div>
                        </div>
                      </div>
                        

                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-check">
                              <input onchange="Checks(this);" type="checkbox" class="form-check-input" data-no="notransporte" name="transporte" id="transporte" @if(isset($filtros->transporte)) checked @endif >
                              <span class=" badge" style="color:#000; ">Transporte</span>                            
                              </label>
                            </div>
                          </div>
                              <div class="col-md-6">
                              <div class="form-check">
                              <input onchange="Checks(this);" type="checkbox" class="form-check-input" data-no="transporte" name="notransporte" id="notransporte" @if(isset($filtros->notransporte)) checked @endif>
                              <span class=" badge" style="color:#000; ">Sin Transporte</span>                            
                              </label>
                            </div>
                          </div>
                        </div>
                        

                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-check">
                              <input onchange="Checks(this);" type="checkbox" class="form-check-input" data-no="nocontrato" name="contrato" id="contrato" @if(isset($filtros->contrato)) checked @endif >
                              <span class=" badge" style="color:#000; ">Contrato</span>                            
                              </label>
                            </div>
                          </div>
                              <div class="col-md-6">
                              <div class="form-check">
                              <input onchange="Checks(this);" type="checkbox" class="form-check-input" data-no="contrato" name="nocontrato" id="nocontrato" @if(isset($filtros->nocontrato)) checked @endif>
                              <span class=" badge" style="color:#000; ">Sin Contrato</span>                            
                              </label>
                            </div>
                          </div>
                        </div>
                        

                        <div class="dropdown-divider"></div>
                        <a href="{{url('contratosdetalle')}}" class="btn btn-default btn-sm">Limpiar</a>
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
                    @if(count($obras))
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>                      
                          <th>Obra</th>
                          <th>Tipo de Obra</th>  
                          <th>Transporte</th>
                          <th>Pospago</th>
                          <th>Contrato</th>
                          <th>Residuos $</th>
                          <th>Transporte $</th>
                          <th>Total(Sin IVA)</th>
                          <th>Contratos</th>
                        </tr>
                      </thead>
                      <tbody>                    
                        @foreach($obras as $obra)
                        <tr>
                          <td title="{{$obra->obra}}"><a href="contratosdetalle/{{$obra->id}}">{{strlen($obra->obra)<30 ? $obra->obra : mb_substr($obra->obra,0,29,"UTF-8")}}</a></td>
                          <td>{{CodificaTipoObra($obra->tipoobra)}}</td>
                          <td>
                          @if($obra->trans)
                            <center><i class="fas fa-check"></i></center>
                          @endif
                          </td>
                          <td>
                          @if($obra->puedepospago)
                            <center><i class="fas fa-check"></i></center>
                          @endif
                          </td>
                          <td>
                          @if($obra->contrato)
                            <center><i class="fas fa-check"></i></center>
                          @endif
                          </td>
                          <td>
                            $ {{number_format($obra->materiales,2)}}
                          </td>
                          <td>
                            $ {{number_format($obra->transporte,2)}}
                          </td>
                          <td>
                            $ {{number_format($obra->materiales+$obra->transporte,2)}}
                          </td>
                          <td>
                            @if($obra->contrato)
                              <a href="documentos/clientes/contratos/{{$obra->id}}.pdf" target="_blank" class="btn btn-info btn-sm d-inline p-2" > <i class="fa fa-download" aria-hidden="true"></i> Contrato</a>
                            @endif
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

  function Checks(_this){
    console.log($(_this).data('no'));
    if($(_this).is(':checked')){

      if($('#'+$(_this).data('no')).is(':checked')){
      
        $('#'+$(_this).data('no')).prop('checked', false);
      }
    }
  }
</script>

@include('administracion.footer')
</body>
</html>
