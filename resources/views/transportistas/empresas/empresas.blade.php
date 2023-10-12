<!DOCTYPE html>
<html lang="en">
<head>
  @include('transportistas.header')
  <title> {{GetSiglas(0)}} | Empresas</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('transportistas.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('transportistas.sidebars.sidebar')

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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">EMPRESAS TRANSPORTISTA </h3>
              </div>
            
              <div class="card-body">
                <div class="p-2">
                  <a href="empresas/create" class="btn btn-primary"><span><i class="fa fa-plus" aria-hidden="true"></i></span> Registrar Empresa</a>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th>Razón Social</th>
                          <th>Ramir</th>
                          <th>Opciones</th>
                        </tr>
                      </thead>  
                      <tbody>
                        
                        @foreach($transportes as $transporte)
                          <tr>
                            <td title="{{$transporte->razonsocial}}">{{strlen($transporte->razonsocial)<30 ? $transporte->razonsocial : mb_substr($transporte->razonsocial,0,29,"UTF-8").' ...'}}</td>
                            <td>{{$transporte->ramir}}</td>
                            <td>
                              <a href="empresas/{{$transporte->id}}" class="btn btn-info btn-sm d-inline p-2" ><i class="fa fa-eye" aria-hidden="true"></i> Revisar</a>
                            </td>
                          </tr>

                        @endforeach
                         
                        
                      </tbody>
                        
                        
                    </table>
                  </div>
                </div>
              </div>
              <div class="card-footer">
              {{ $transportes->links('pagination::bootstrap-4') }}
              </div>
            </div>
          </div>
        </div>
      </div>
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
@include('transportistas.footer')
</body>
</html>
