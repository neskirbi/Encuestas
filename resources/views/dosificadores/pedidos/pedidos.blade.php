<!DOCTYPE html>
<html lang="en">
<!--Jonathan-->
<head>
  @include('dosificadores.header')
  <title>{{GetSiglas(0)}} | Pedidos</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Main Sidebar Container -->
  @include('dosificadores.navigations.navigation')

  @include('dosificadores.sidebars.sidebar') 
`
  @include('dosificadores.sidebars.sidebar') 

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

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>
                <div class="card-tools">
                <form action="{{url('BuscarCodigo')}}" method="post">
                  @csrf
                  <div class="input-group">
                    <input type="text" name="codigo" placeholder="Codigo de Pedido" class="form-control">
                    <span class="input-group-append">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    </span>
                  </div>
                </form>
                </div>
              </div>
              
             
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
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                      <div class="row">                        
                          <div class="col-md-12">
                            <h3 class="card-title">Folio: {{($pedido->folio)}}</h3>                            
                          </div>
                        </div>
                        <div class="row">                        
                          <div class="col-md-12">
                            <h3 class="card-title"><b>{{($pedido->razonsocial)}}</b></h3>                            
                          </div>
                        </div>
                        <div class="row">                        
                          <div class="col-md-12">
                            <h3 class="card-title"><b>{{($pedido->obra)}}</b></h3>                            
                          </div>
                        </div>
                        <div class="row">                        
                          <div class="col-md-12">
                            <h3 class="card-title">Dirección{{($pedido->obra_domicilio)}}</h3>                            
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <b style="color:#ff0000;">Fecha de entrega:</b>  {{ FechaFormateadaTiempo($pedido->fechaentrega)}}
                          </div>

                          
                        </div>                   
                        

                      </div>
                      




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







                    </div>
                  </div>

                </div>
                
                <div class="row">
                  <div class="col-md-3" style="padding:5px;">
                    
                  </div>
                  <div class="col-md-3" style="padding:5px;"></div>
                  <div class="col-md-3" style="padding:5px;"></div>                  
                  <div class="col-md-3" style="padding:5px;">
                    <a href="pedidosd/{{$pedido->id}}" target="_blank" class="btn btn-info btn-block">Revisar&nbsp;<i class="fa fa-eye"></i></a>
                  </div>
                  
                </div>
                @endif
              </div>
            </div>
          
          </div>
        </div>
        @endforeach
        {{ $pedidos->links('pagination::bootstrap-4') }}
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
