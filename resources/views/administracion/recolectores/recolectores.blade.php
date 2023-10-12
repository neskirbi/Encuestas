<!DOCTYPE html>
<html lang="en">
<head>
  @include('administracion.header')
  <title>CSMX | Recolectores</title>

  
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
            
            
            @if(count($recolectores))
            <div class="callout callout-success">
                <h5>Recolectores</h5>
            </div>
            @endif
            @foreach($recolectores as $recolector)
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recolector</h3>
                            <div class="card-tools">
                                <div class="btn-group dropleft">
                                    <button class="btn btn-default " type="button" id="menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="menu">
                                        <a class="dropdown-item borrar" href="{{url('BorrarAdmin').'/'.$recolector->id}}" data-texto="¿Deseas quitar a {{$recolector->recolector}} de la planta?"><i class="fa fa-trash" aria-hidden="true"></i> Quitar</a>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                        <form action="{{url('recolectores').'/'.$recolector->id}}" id="{{$recolector->id}}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="PUT">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class='form-group'>
                                        <label for="nombre">Recolector</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{$recolector->recolector}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">                            
                               
                                <div class="col-sm-3">
                                    <div class='form-group'>
                                        <label for="mail">Correo</label>
                                        <input type="text" class="form-control" id="mail" onkeyup="Cambio(this)" data-mail="{{$recolector->mail}}" value="{{$recolector->mail}}">
                                    </div>
                                </div>
                               
                                <div class="col-sm-3">
                                    <div class='form-group'>
                                        <label for="pass">Contraseña</label>
                                        <input type="text" class="form-control" id="pass" name="pass" value="{{$recolector->pass}}">
                                    </div>
                                </div>
                              
                            </div>

                         
                        </div>                        
                        </form>
                        @if(Auth::guard('administradores')->user()->principal==1)
                        <div class="card-footer">
                            <button type="submit" class='btn btn-info float-right'  onclick="Submite('{{$recolector->id}}',this);" data-texto="¿Actualizar información para {{$recolector->recolector}}?">Guardar</button>
                        </div>  
                        @endif      
                    </div>
                    
                </div>
            </div>
            @endforeach

            
            
            <div class="row">
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Agregar Recolector</h3>                            
                        </div>                        
                        <form action="{{url('recolectores')}}" method="post">
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
                               
                                <div class="col-sm-5">
                                    <div class='form-group'>
                                        <label for="mail">Correo</label>
                                        <input required type="email" class="form-control" id="mail" name="mail" placeholder="Correo">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class='form-group'>
                                        <label for="mail">Teléfono</label>
                                        <input required type="number" class="form-control" id="telefono" name="telefono" placeholder="Teléfono">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class='form-group'>
                                        <label for="pass">Contraseña</label>
                                        <input required type="text" class="form-control" id="pass" name="pass" placeholder="Contraseña">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="tadmin">Tipo de Recolector</label>
                                        <select required class="form-control" name="tadmin" id="tadmin">
                                            <option value="">--Seleccione Opción--</option>
                                            <option value="1">Recolector</option>
                                        </select>
                                    </div> 
                                </div>
                            </div>                        
                        
                        </div>
                        <div class="card-footer">
                            <button type="submit" class='btn btn-info float-right'>Guardar</button>
                        </div>        
                        </form>
                    </div>                    
                </div>
            </div>
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
