<!DOCTYPE html>
<html lang="en">
<head>
  @include('uia.header')
  <title>Encuestas</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('uia.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('uia.sidebars.sidebar')

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
                <h3 class="card-title"><i class="fa fa-group" aria-hidden="true"></i> Inspectores</h3>

                <div class="card-tools">
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Filtros <i class="fa fa-sliders" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" style="width:300px;">
                      <form class="px-4 py-3" action="{{url('inspectores')}}" method="GET">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                          </div>
                          <input type="text" class="form-control" name="inspector" id="inspector" placeholder="Inspector" @if(isset($filtros->inspector)) value="{{$filtros->inspector}}" @endif >
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-phone"></i></span>
                          </div>
                          <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" @if(isset($filtros->telefono)) value="{{$filtros->telefono}}" @endif >
                        </div>

                     
                        <div class="dropdown-divider"></div>
                        <a href="{{url('inspectores')}}" class="btn btn-default btn-sm">Limpiar</a>
                        <button type="submit" class="btn btn-info btn-sm float-right">Aplicar</button>
                        
                      </form>
                      
                    </div>
                  </div>                 
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">


                <div class="p-2">
                  <a href="{{url('inspectores/create')}}" class="btn btn-primary"><span><i class="fa fa-plus" aria-hidden="true"></i></span> Registrar Inspector</a>
                </div>



                <div class="row">
                  <div class="col-md-12" style="overflow-x:scroll;">
                    @if(count($inspectores))
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Nombre</th>
                          <th>Teléfono</th> 
                          <th>Correo</th> 
                          <th colspan="2">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                    
                        @foreach($inspectores as $inspector)
                        <tr>
                          <td title='{{$inspector->inspector}}'><i class="nav-icon fa fa-user" aria-hidden="true" ></i></td>
                          <td>{{$inspector->inspector}}</td>
                          <td title="{{$inspector->telefono}}">{{$inspector->telefono}}</td>
                          <td title="{{$inspector->mail}}">{{$inspector->mail}}</td>
                          <td><a href="{{url('inspectores/'.$inspector->id)}}" class="btn btn-info btn-block"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a></td>
                          <td>                                                
                            <form action="{{url('inspectores/'.$inspector->id)}}" method="post" >
                            @csrf
                            @method('DELETE')
                              <button class="btn btn-danger btn-block"><i class="fa fa-times" aria-hidden="true"></i> Eliminar</button>
                            </form>
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
              {{ $inspectores->appends($_GET)->links('pagination::bootstrap-4') }}
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

@include('uia.footer')
</body>
</html>
