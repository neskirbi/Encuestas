<!DOCTYPE html>
<html lang="en">
<head>
  @include('administracion.header')
  <title>CSMX | Plantas</title>

  
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
        <section class="col-lg-12 connectedSortable ui-sortable">
            <div class="row">
                <div class="col-12">
                    <div class="card-info">
                        <div class="card-header">
                            <h3 class="card-title">Datos de la Planta</h3>                            
                        </div>
                        <form action="{{url('planta').'/'.$planta->id}}" id="{{$planta->id}}" method="post">
                        @csrf
                        <input required="" id="_method" name="_method" type="hidden" value="PUT">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class='form-group'>
                                        <label for="planta">Planta</label>
                                        <input type="text" class="form-control" id="planta" name="planta" value="{{$planta->planta}}">
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    
                                </div>
                                <div class="col-sm-4">
                                    <div class='form-group'>
                                        <label for="plantaauto">Autorización</label>
                                        <input type="text" class="form-control" id="plantaauto" name="plantaauto" value="{{$planta->plantaauto}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">                            
                                <div class="col-sm-8">
                                    <div class='form-group'>
                                        <label for="direccion">Dirección</label>
                                        <input type="text" class="form-control" id="direccion" name="direccion" value="{{$planta->direccion}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class='form-group'>
                                        <label for="codigo">C&oacute;digo</label>
                                        <input type="text" class="form-control" id="codigo" name="codigo" value="{{$planta->codigo}}">
                                    </div>
                                </div> 
                            </div>
                                                         
                        </div>
                        </form>                         
                        @if(Auth::guard('administradores')->user()->principal==1) 
                        <div class="card-footer">
                            <button type="submit" class='btn btn-info float-right'  onclick="Submite('{{$planta->id}}',this);" data-texto="¿Todos los datos son correctos?">Guardar</button>
                        </div>
                        @endif                           
                    </div>

                </div>
            </div>
            

            <div class="callout callout-success">
                <h5>Administradores</h5>
            </div>
            @foreach($administradores as $administrador)
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Administrador</h3>
                            @if($administrador->principal==0 && Auth::guard('administradores')->user()->principal==1)
                            <div class="card-tools">
                                <div class="btn-group dropleft">
                                    <button class="btn btn-default " type="button" id="menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="menu">
                                        <a class="dropdown-item borrar" href="{{url('BorrarAdmin').'/'.$administrador->id}}" data-texto="¿Deseas quitar a {{$administrador->administrador}} de la planta?"><i class="fa fa-trash" aria-hidden="true"></i> Quitar</a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>                        
                        <form action="{{url('EditarAdmin').'/'.$administrador->id}}" id="{{$administrador->id}}" method="post">
                        @csrf
                        
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class='form-group'>
                                        <label for="administrador">Administrador</label>
                                        <input type="text" class="form-control" id="administrador" name="administrador" value="{{$administrador->administrador}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">                            
                                <div class="col-sm-4">
                                    <div class='form-group'>
                                        <label for="cargo">Cargo</label>
                                        <input type="text" class="form-control" id="cargo" name="cargo" value="{{$administrador->cargo}}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class='form-group'>
                                        <label for="mail">Correo</label>
                                        <input type="text" class="form-control" id="mail" onkeyup="Cambio(this)" data-mail="{{$administrador->mail}}" value="{{$administrador->mail}}">
                                    </div>
                                </div>
                               
                              
                            </div>
                        </div>                        
                        </form>
                        @if(Auth::guard('administradores')->user()->principal==1)
                        <div class="card-footer">
                            <button type="submit" class='btn btn-info float-right'  onclick="Submite('{{$administrador->id}}',this);" data-texto="¿Actualizar información para {{$administrador->administrador}}?">Guardar</button>
                        </div>  
                        @endif      
                    </div>
                    
                </div>
            </div>
            @endforeach

            
            
            @if(Auth::guard('administradores')->user()->principal==1)
            <div class="row">
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Agregar Administrador</h3>                            
                        </div>                        
                        <form action="{{url('AltaAdmin')}}" id="Nadmin" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class='form-group'>
                                        <label for="nombre">Nombre</label>
                                        <input required type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre Completo">
                                    </div>
                                </div>
                            </div>
                            <div class="row">                            
                                <div class="col-sm-4">
                                    <div class='form-group'>
                                        <label for="cargo">Cargo</label>
                                        <input required type="text" class="form-control" id="cargo" name="cargo" placeholder="Cargo">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class='form-group'>
                                        <label for="mail">Correo</label>
                                        <input required type="mail" class="form-control" id="mail" name="mail" placeholder="Correo">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="tadmin">Tipo de Administrador</label>
                                        <select required class="form-control" name="tadmin" id="tadmin">
                                            <option value="">--Seleccione Opción--</option>
                                            <option value="1">Administrador</option>
                                        </select>
                                    </div> 
                                </div>
                            </div>                        
                        </form>
                        </div>
                        <div class="card-footer">
                        <button type="submit" class='btn btn-info float-right' onclick="Submite('Nadmin',this);" data-texto="¿Todos los datos son correctos?">Guardar</button>
                        </div>        
                    </div>                    
                </div>
            </div>
            @endif
        </section>       
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
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<script>
    function Cambio(_this){
        _this=$(_this);
        if(_this.val()==_this.data('mail')){
            _this.removeAttr('name');
        }else{            
            _this.attr('name','mail');
        }
    }
</script>
@include('administracion.plantas.modals.modalplanta')
@include('footer')
</body>
</html>
