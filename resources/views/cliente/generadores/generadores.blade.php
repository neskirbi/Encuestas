<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>CSMX | Generadores</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('cliente.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('cliente.sidebars.sidebar')

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
                <h3 class="card-title">Generadores</h3>

                <!--<div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>-->
                
              </div>
              <!-- /.card-header -->
              <div class="card-body" >
                <div class="p-2">
                  <a href="registrogenerador" class="btn btn-primary"><span><i class="fa fa-plus" aria-hidden="true"></i></span> Registrar Generador</a>
                </div>
                <div class="row">
                  <div class="col-md-12" style="overflow-x:scroll;">
                  @if(count($generadores))
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                        <th>Razón social</th>
                        <th>RFC</th>
                        <th>Persona</th> 
                        <th>Estatus</th> 
                        <th></th> 
                        </tr>
                      </thead>
                      <tbody>
                      
                        @foreach($generadores as $generador)
                          <tr>
                          <td>{{$generador->razonsocial}}</td>
                          <td>{{$generador->rfc}}</td>
                          <td>{{$generador->fisicaomoral}}</td>
                          <td>@if($generador->verificado==0)
                            <small class="badge badge-warning"><i class="fa fa-exclamation" aria-hidden="true"></i> Pendiente</small>
                            @else
                            <small class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i>  Verificado</small>
                            @endif</td>
                          <td>
                          <a href="generadores/{{$generador->id}}" class="btn btn-info btn-sm " ><i class="fa fa-eye" aria-hidden="true"></i> Ver</a>
                          <form action="generadores/{{$generador->id}}" method="POST"  class="d-inline p-2">
                              {{ csrf_field() }}
                              <input type="hidden" name="_method" value="DELETE">
                              @if($generador->verificado==0)
                              <button  id="borrar" class="borrar btn btn-danger btn-sm" data-texto="¿Deseas quitar este generador?"><i class="fa fa-times" aria-hidden="true"></i></button>
                              @endif
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

<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>

<!-- AdminLTE App, funcion de sidebar -->
<script src="dist/js/adminlte.js"></script>
@include('cliente.generadores.modals.modalgenerador')
@include('footer')
</body>
</html>
