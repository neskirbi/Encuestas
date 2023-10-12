<!DOCTYPE html>
<html lang="en">
<head>
  @include('encuestas.header')
  <title>{{GetSiglas(0)}} | Hoteles</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('encuestas.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('encuestas.sidebars.sidebar')

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
                <h3 class="card-title"><i class="fa fa-building"></i> Hoteles</h3>

                
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <a href="{{url('hoteles/create')}}" class="btn btn-info"><i class="fa fa-building"></i> Agregar</a>
                <div class="row">
                  <div class="col-md-12" style="overflow-x:scroll;">
                    @if(count($hoteles))
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                        <th>Cliente</th>
                        <th>Hotel</th>
                        
                        <th>Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      
                        @foreach($hoteles as $hotelstr)
                        <?php 
                        $hotel=json_decode($hotelstr->json);
                        ?>
                        <tr>
                          <td title="{{$hotel->nombrepropietario}}">{{strlen($hotel->nombrepropietario)<31 ? $hotel->nombrepropietario : mb_substr($hotel->nombrepropietario,0,30,"UTF-8").'...'}}</td>
                          <td title="{{$hotel->nombrehotel}}">{{strlen($hotel->nombrehotel)<21 ? $hotel->nombrehotel : mb_substr($hotel->nombrehotel,0,20,"UTF-8").'...'}}</td>
                          
                          <td><a href="hoteles/{{$hotelstr->id}}" class="btn btn-info">Revisar <i class="fa fa-eye"></i> </a></td>                          
                      
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
              {{ $hoteles->appends($_GET)->links('pagination::bootstrap-4') }}
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
