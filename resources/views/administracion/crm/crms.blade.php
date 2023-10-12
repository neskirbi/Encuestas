<!DOCTYPE html>
<html lang="en">
<head>
  @include('administracion.header')
  <title>CSMX | CRM</title>

  
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
        <div class="row" >
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Prospectos </h3>
              </div>
            
              <div class="card-body">
                <div class="p-2">
                  <a href="crm/create" class="btn btn-primary"><span><i class="fa fa-plus" aria-hidden="true"></i></span> Candidato</a>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th>Nombre</th>
                          <th>Telefono</th>
                          <th>Correo</th>
                        </tr>
                      </thead>  
                      <tbody>
                        
                        @foreach($candidatos as $candidato)
                          <tr>
                            <td title="{{$candidato->nombre}}">{{strlen($candidato->nombre)<30 ? $candidato->nombre : substr($candidato->nombre,0,29).' ...'}}</td>
                            <td>{{$candidato->telefono}}</td>
                            <td>{{$candidato->correo}}</td>
                            <td>
                              <a href="crm/{{$candidato->id}}" class="btn btn-info btn-sm d-inline p-2" ><i class="fa fa-eye" aria-hidden="true"></i> Revisar</a>
                            </td>
                          </tr>

                        @endforeach
                         
                        
                      </tbody>
                        
                        
                    </table>
                  </div>
                </div>
              </div>
              <div class="card-footer">
              {{ $candidatos->links('pagination::bootstrap-4') }}
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
@include('administracion.footer')
</body>
</html>
