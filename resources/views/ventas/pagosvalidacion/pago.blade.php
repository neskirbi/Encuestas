<!DOCTYPE html>
<html lang="en">
<head>
  @include('ventas.header')
  <title>CSMX | Citas</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('ventas.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('ventas.sidebars.sidebar')

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
            <form action="{{url('pagosv')}}/{{$pago->id}}" method="post">
            @csrf
            <input type="hidden" name="_method" value="PUT">
              
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" ><i class="fa fa-dollar" aria-hidden="true"></i> Pago</h3>                
              </div>
              <!-- /.card-header -->
              <div class="card-body" >              
                

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="matricula">Refrencia</label>
                        <input disabled type="text" class="form-control" id="referencia" name="referencia"  value="{{$pago->referencia}}">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="monto">Monto</label>
                        <input  type="text" class="form-control" id="monto" name="monto"  value="{{$pago->monto}}">
                    </div>
                  </div>
                </div>

                
               
                
                
                </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button class="btn btn-primary pull-right">Guardar</button>
              </div>
            </div>
            </form>
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
