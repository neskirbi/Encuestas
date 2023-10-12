<!DOCTYPE html>
<html lang="en">
<!--Jonathan-->
<head>
  @include('administracion.header')
  <title>{{GetSiglas(0)}} | Ventas</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Main Sidebar Container -->
  @include('administracion.navigations.navigation')

  @include('administracion.sidebars.sidebar') 

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
        
        <div class="row">
        
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-dollar"></i> Ventas</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @if(count($ventas))
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>Obra</th>
                        <th>Subtotal</th>
                        <th>Total</th> 
                        <th>Fecha Entrega</th>
                        <th>Estatus</th>
                        <th>Opciones</th>     
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($ventas as $venta)
                      <tr>
                        <td>{{strlen($venta->obra) > 30 ? mb_substr($venta->obra,0,29,"UTF-8") : $venta->obra}}</td>
                        <td>$ {{number_format($venta->subtotal,2)}}</td>
                        <td>$ {{number_format($venta->total,2)}}</td>
                        <td>
                          {{$venta->confirmacion != 2 ? 'Sin Asignar' : FechaFormateadaTiempo($venta->fechaentrega)}}
                        </td>
                        <td>
                            @if($venta->confirmacion == 0)
                            <small class="badge badge-danger"><i class="fa fa-check" aria-hidden="true"></i>  Rechazado</small>
                            @endif

                            @if($venta->confirmacion == 1)
                            <small class="badge badge-warning"><i class="fa fa-check" aria-hidden="true"></i>  Pendiente</small>
                            @endif

                            @if($venta->confirmacion == 2)
                            <small class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i>  Aceptado</small>
                            @endif
                        </td>
                        <td>
                            <a href="ventas/{{$venta->id}}" class="btn btn-info">Revisar&nbsp;<i class="fa fa-eye"></i></a>
                        </td>
                      </tr>
                      @endforeach              
                    </tbody>
                  </table>                  
                  {{ $ventas->links('pagination::bootstrap-4') }}
                  @endif
                </div>
                <div class="card-footer">
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
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="dist/js/adminlte.js"></script>


</body>
</html>
