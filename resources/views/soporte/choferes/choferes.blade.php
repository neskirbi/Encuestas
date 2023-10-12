<!DOCTYPE html>
<html lang="en">
<head>
  @include('soporte.header')
  <title>{{GetSiglas(0)}} | Choferes</title>

  
</head>
<style>
  .sammy-nowrap-2 {
    max-width: 100%;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
</style>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('soporte.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('soporte.sidebars.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
     
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row" >
          <div class="col-md-12">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"><i class="nav-icon fa fa-group" aria-hidden="true"></i> Choferes</h3>
              </div>
              <div class="card-body">
                
                <div class="row">
                  @foreach($choferes as $chofer) 
                  
                  <div class="col-md-3">           
                    <div class="card">
                      @if(!file_exists(public_path('documentos/choferes/ine/frente').'/'.$chofer->id.'.jpg'))
                      <img src="{{url('documentos/choferes/ine').'/noine.jpg'}}" class="card-img-top" style=" aspect-ratio: 5/3;">
                      @else
                      <img src="{{url('documentos/choferes/ine/frente').'/'.$chofer->id.'.jpg'}}"  style=" aspect-ratio: 5/3;" class="card-img-top">
                      @endif
                      <div class="card-body">
                        <p class="sammy-nowrap-2" style="font-size:.8em; font-weight: bold;">{{$chofer->nombres.' '.$chofer->apellidos}}</p>                        
                        <font style="font-size:14px; ">{{$chofer->telefono}}</font><br>
                        <br>
                        <div class="row" > 
                          <div class="col-md-6">
                            @if($chofer->verificado==0) 
                            <form action="{{url('ConfirmaChofer')}}/{{$chofer->id}}" method="post">
                              @csrf
                              <input name="_method" type="hidden" value="PUT">
                              <button class="btn btn-success btn-sm" ><i class="fa fa-check" aria-hidden="true"></i> </button>
                            </form>
                            @else
                            <form action="{{url('SuspendeChofer')}}/{{$chofer->id}}" method="post">
                              @csrf
                              <input name="_method" type="hidden" value="PUT">
                              <button class="btn btn-danger btn-sm" ><i class="fa fa-times" aria-hidden="true"></i> </button>
                            </form>
                            @endif
                          </div>

                          <div class="col-md-6">
                            <a href="choferes/{{$chofer->id}}" class="float-right btn btn-info btn-sm" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                          </div>  

                        </div>
                      </div>  
                    </div>
                  </div>
                  @endforeach
                </div>
                
                
              </div>
              <div class="card-footer">
                {{ $choferes->appends($_GET)->links('pagination::bootstrap-4') }}
              </div>
            </div>
          </div>
        </div>
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

<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>

<script>
  
</script>
@include('soporte.footer')
</body>
</html>
