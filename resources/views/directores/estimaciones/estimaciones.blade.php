<!DOCTYPE html>
<html lang="en">
<head>
  
  @include(GetCabecera())
  <title>{{GetSiglas(0)}} | Estimaciones</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  @include('toast.toasts')  
  <div class="wrapper">

  
  @include(GetNavigation())
  @include(GetSideBar())

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
                      <form class="px-4 py-3" action="estimaciones">
                        
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-user"></i></span>
                          </div>
                          <input type="text" class="form-control" name="generador" id="generador" placeholder="Generador" @if(isset($filtros->generador)) value="{{$filtros->generador}}" @endif >
                        </div>

                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-building"></i></span>
                          </div>
                          <input type="text" class="form-control" name="obra" id="obra" placeholder="Obra" @if(isset($filtros->obra)) value="{{$filtros->obra}}" @endif >
                        </div>

                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-recycle"></i></span>
                          </div>
                          <input type="text" class="form-control" name="planta" id="planta" placeholder="Planta" @if(isset($filtros->planta)) value="{{$filtros->planta}}" @endif >
                        </div>


                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="exelente" id="exelente" @if(isset($filtros->exelente)) checked @endif>
                          <span class=" badge" style="color:#fff; background-color:#28A745;">Exelente</span>                                                      
                        </div>
                        
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="correcto" id="correcto" @if(isset($filtros->correcto)) checked @endif>
                          <span class=" badge" style="color:#fff; background-color:#7FFF00;">Correcto</span>                                                      
                        </div>

                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="patrasado" id="patrasado" @if(isset($filtros->patrasado)) checked @endif>
                          <span class=" badge" style="color:#fff; background-color:#FFF200;">Poco Atrasado</span>                                                      
                        </div>

                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="atrasado" id="atrasado" @if(isset($filtros->atrasado)) checked @endif>
                          <span class=" badge" style="color:#fff; background-color:#FF7F00;">Atrasado</span>                                                      
                        </div>

                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="matrasado" id="matrasado" @if(isset($filtros->matrasado)) checked @endif>
                          <span class=" badge" style="color:#fff; background-color:#FD003A;">Muy Atrasado</span>                                                      
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="publica" id="publica" @if(isset($filtros->publica)) checked @endif>
                            <span class=" badge" style="color:#000; ">Publica</span>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="privada" id="privada" @if(isset($filtros->privada)) checked @endif>
                            <span class=" badge" style="color:#000; ">Privada</span> 
                            </div>
                          </div>
                        </div>

                        
                                                                                
                        
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="terminada" id="terminada" @if(isset($filtros->terminada)) checked @endif>
                            <span class=" badge" style="color:#000; ">Terminada</span>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="curso" id="curso" @if(isset($filtros->curso)) checked @endif>
                            <span class=" badge" style="color:#000; ">En curso</span> 
                            </div>
                          </div>
                        </div>

                        
                      
                        <div class="dropdown-divider"></div>
                        <a href="estimaciones" class="btn btn-default btn-sm">Limpiar</a>
                        <button type="submit" class="btn btn-info btn-sm float-right">Aplicar</button>
                        
                      </form>
                      
                    </div>
                  </div>
                
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body ">
              
                <div class="row">
                  <div class="col-md-12" style="overflow-x:scroll;">
                    @if(count($obras))
                    <table class="table table-hover text-nowrap" id="obras">
                      <thead>
                        <tr>
                        <th>Obra</th>             
                        <th>Declarado</th>
                        <th>Entregado</th>
                        <th>Restante</th>
                        <th>Días</th>
                        <th>Días restante</th>
                        <th>Restante/Día</th>
                        <th>Status</th>
                        <th>Datos</th>
                        </tr>
                      </thead>
                      <tbody>
                      
                        @foreach($obras as $obra)
                        <?php $factor=$obra->declarado == 0 ? 0 : ( $obra->lana/$obra->declarado);?>
                        <tr>
                          <td title="{{$obra->obra}}">{{strlen($obra->obra)>40 ? mb_substr($obra->obra,0,40,"UTF-8").'...' : $obra->obra}}</td>
                          <td style="text-align: right;">$ {{number_format($obra->lana,2)}} </td> 
                          <td style="text-align: right;"> $ {{number_format(($obra->entregado*$factor),2)}} </td>
                          <td style="text-align: right;">$ {{number_format((($obra->declarado - $obra->entregado)*$factor),2)}} </sup></td>                      
                          <td style="text-align: right;">{{number_format($obra->dias)}}</td>                                              
                          <td style="text-align: right;">{{number_format($obra->restante > $obra->dias ? $obra->dias : $obra->restante)}}</td>
                          @if(($obra->restante <= 0 ))
                          <td style="text-align: right;">$ {{number_format((($obra->declarado - $obra->entregado)*$factor),2)}} </td>
                          @else
                          <td style="text-align: right;">$ {{number_format((($obra->declarado - $obra->entregado)/$obra->restante*$factor),2)}} </td>
                          @endif
                          @if($obra->restante < $obra->dias)
                            @if($obra->status >= -20)
                            <td title="{{$obra->status}}"><small class="badge " style="color:#fff; background-color:#28A745;"><i class="fa fa-check" aria-hidden="true"></i>  Exelente</small></td>
                            @endif
                            <td
                            @if($obra->status < -20 && $obra->status >= -40)
                            <td title="{{$obra->status}}"><small class="badge " style="color:#fff; background-color:#7FFF00;"><i class="fa fa-check" aria-hidden="true"></i>  Correcto</small></td>
                            @endif
                            @if($obra->status < -40 && $obra->status >= -60)
                            <td title="{{$obra->status}}"><small class="badge " style="color:#fff; background-color:#FFF200;"><i class="fa fa-check" aria-hidden="true"></i>  Poco Atrasado</small></td>
                            @endif
                            @if($obra->status < -60 && $obra->status >= -80)
                            <td title="{{$obra->status}}"><small class="badge " style="color:#fff; background-color:#FF7F00;"><i class="fa fa-check" aria-hidden="true"></i>  Atrasado</small></td>
                            @endif
                            @if($obra->status < -80 )
                            <td title="{{$obra->status}}"><small class="badge " style="color:#fff; background-color:#FD003A;"><i class="fa fa-check" aria-hidden="true"></i>  Muy Atrasado</small></td>
                            @endif
                          @else
                          <td title="{{$obra->status}}"><small class="badge " style="color:#fff; background-color:#000;"><i class="fa fa-check" aria-hidden="true"></i> Por comenzar</small></td>
                          @endif
                        
                          <td>
                            Contacto.{{$obra->contacto}} <br> Tel.{{$obra->telefono}} <br> Cel.{{$obra->celular}}  <br> Correo.{{$obra->correo}}  <br> Correo.{{$obra->correo2}}
                          
                          </td>
                          
                        
                        </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                    
                    @endif
                  </div>
                </div>
                
                
              </div>
              <div class="card card-footer">
                {{ $links->appends($_GET)->links('pagination::bootstrap-4') }}
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
  $.widget.bridge('uibutton', $.ui.button);

 
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->

<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<


</body>
</html>
