<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>{{GetSiglas(0)}} | Pedidos</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

 <!-- Navbar -->
 @if(Auth::guard('clientes')->check())
    @include('cliente.navigations.navigation')  
  @endif

  @if(Auth::guard('residentes')->check())
    @include('residentes.navigations.navigation')  
  @endif
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @if(Auth::guard('clientes')->check())
    @include('cliente.sidebars.sidebar') 
  @endif

  @if(Auth::guard('residentes')->check())
    @include('residentes.sidebars.sidebar') 
  @endif

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
          <div class="callout callout-info">
            <h5><i class="fa fa-tags"></i> Pedidos</h5>
          </div>
        </div>
      </div>
      
      @if(count($pedidos))
      @foreach($pedidos as $pedido)    
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{FechaFormateada($pedido->created_at)}}</h3>
              <div class="card-tools">
                
                <div class="col-md-2">{!!GetEstatusPedidos($pedido->confirmacion)!!}</div>
              </div>
            </div>
            <div class="card-body">
              @if(count($pedido->detalle))
              @foreach($pedido->detalle as $detalle)              
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="row">
                        
                        <div class="col-md-2">
                        <center><img data-id="{{$detalle->id_producto.$detalle->id_transporte}}" src="{{!file_exists(public_path($detalle->portada)) ? 'https://cdn.pixabay.com/photo/2017/01/25/17/35/picture-2008484_960_720.png' : url($detalle->portada)}}" style="max-width:92px; border-radius:5px;" alt=""></center>
                        </div>
                        <div class="col-md-4">
                          <h3 class="card-title"><b>{{FechaFormateada($pedido->fechaentrega)}}</b></h3>
                          <br>                        
                          <h6>{{$detalle->producto}}</h6>
                          
                        </div>

                        <div class="col-md-4"></div>

                        
                      </div>                   
                      

                    </div>
                  </div>
                </div>
              </div>
              <hr>
              @endforeach
              
              <div class="row">
                <div class="col-md-3" style="padding:5px;"><center>
                  <a href="{{url('cotizacion').'/'.$pedido->id}}" target="_blank" class="btn btn-primary btn-sm" style="width:100%;"><i class="fa fa-file-text" aria-hidden="true"></i> Cotización
                </a></center></div>
                <div class="col-md-3" style="padding:5px;">
                
                </div>
                <div class="col-md-3" style="padding:5px;">
                

                
                <center>                  
                @if($pedido->confirmacion==1)
                  <a data-toggle="modal" data-target="#modalpago" class="btn btn-success btn-sm" style="width:100%;" data-pid="{{$pedido->id}}" data-obra="{{$pedido->id_obra}}" data-total="{{$pedido->total}}" onclick="CargarPago(this);"><i class="fa fa-dollar" aria-hidden="true"></i> Transferencia</a>
                @elseif($pedido->status==1)
                  <a href="transferencia/{{$pedido->id_pago}}" target="_blank" class="btn btn-success btn-sm"  style="width:100%;"><i class="fa fa-download" aria-hidden="true"></i> L. Captura</a>
                
                @endif
                </center></div>
               
                <div class="col-md-3" style="padding:5px;"><center><a href="{{url('pedidos').'/'.$pedido->id}}" class="btn btn-primary btn-sm" style="width:100%;"><i class="fa fa-eye" aria-hidden="true"></i> Revisar</a></center></div>
                
              </div>
              @endif
            </div>
          </div>
         
        </div>
      </div>
      @endforeach
      @endif
     
      {{ $pedidos->links('pagination::bootstrap-4') }}
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
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
<script>

  function CargarPago(_this){
    $('#pid').val($(_this).data('pid'));
    $('#pmonto').val($(_this).data('total'));
    $('#pmonto').blur();
    $('#pobra').val($(_this).data('obra'));
    $('#pobra').change();
  }

 
</script>

</body>
</html>
