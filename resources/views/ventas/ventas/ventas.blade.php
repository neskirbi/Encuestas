<!DOCTYPE html>
<html lang="en">
<!--Jonathan-->
<head>
  @include('ventas.header')
  <title>{{GetSiglas(0)}} | Ventas</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Main Sidebar Container -->
  @include('ventas.navigations.navigation')

  @include('ventas.sidebars.sidebar') 

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
            <div class="callout callout-info">
              <div class="row">
                <div class="col-md-6">
                  <h5><i class="fa fa-tags"></i> Pedidos</h5>


                </div>
                

                <div class="col-md-6">
                  <a href="ventas/create" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Pedido</a>
                </div>
              </div>
              
              
            </div>
          </div>
        </div>
        


        <div class="row">
          <div class="col-md-12">
            <div class="btn-group float-right">
              <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filtros <i class="fa fa-sliders" aria-hidden="true"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right" style="width:300px;">
                <form class="px-4 py-3" action="{{url('ventas')}}" method="GET">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-building"></i></span>
                    </div>
                    <input type="text" class="form-control" name="obra" id="obra" placeholder="Obra" @if(isset($request->obra)) value="{{$request->obra}}" @endif >
                  </div>

                  <div class="dropdown-divider"></div>
                  <a href="{{url('ventas')}}" class="btn btn-default btn-sm">Limpiar</a>
                  <button type="submit" class="btn btn-info btn-sm float-right">Aplicar</button>
                  
                </form>
                
              </div>
            </div>                 
          </div>

        </div>
        
        
        @if(count($ventas))
        @foreach($ventas as $venta)    
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{FechaFormateada($venta->created_at)}}</h3>
                <div class="card-tools">
                  
                  <div class="col-md-2">{!!GetEstatusPedidos($venta->confirmacion)!!}</div>
                </div>
              </div>
              
              <div class="card-body">
                @if(count($venta->detalle))
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                      <div class="row">                        
                          <div class="col-md-12">
                            <h3 class="card-title">Folio: {{($venta->folio)}}</h3>                            
                          </div>
                        </div>
                        <div class="row">                        
                          <div class="col-md-12">
                            <h3 class="card-title"><b>{{($venta->obra)}}</b></h3>                            
                          </div>
                        </div>
                        <div class="row">                        
                          <div class="col-md-12">
                            <h3 class="card-title">Dirección{{($venta->obra_domicilio)}}</h3>                            
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <b style="color:#ff0000;">Fecha de entrega:</b>  {{ FechaFormateadaTiempo($venta->fechaentrega)}}
                          </div>

                          
                        </div>                   
                        

                      </div>
                    </div>
                  </div>

                </div>
                
                <div class="row">
                  <div class="col-md-3" style="padding:5px;">
                    <a href="{{url('cotizacion').'/'.$venta->id}}" target="_blank" class="btn btn-info btn-block"><i class="fa fa-file-text" aria-hidden="true"></i> Cotización</a>
                  </div>
                  <div class="col-md-3" style="padding:5px;"></div>
                  <div class="col-md-3" style="padding:5px;"></div>                  
                  <div class="col-md-3" style="padding:5px;">
                    <a href="ventas/{{$venta->id}}" target="_blank" class="btn btn-info btn-block">Revisar&nbsp;<i class="fa fa-eye"></i></a>
                  </div>
                  
                </div>
                @endif
              </div>
            </div>
          
          </div>
        </div>
        @endforeach
        {{ $ventas->links('pagination::bootstrap-4') }}
        @endif
        
      
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
