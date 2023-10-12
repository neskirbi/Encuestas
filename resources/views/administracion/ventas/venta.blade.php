<!DOCTYPE html>
<html lang="en">
<!--jonathan-->
<head>
  @include('administracion.header')
  <title>{{GetSiglas(0)}} | Ventas</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

<!-- Navbar -->
@include('administracion.sidebars.sidebar') 

@include('administracion.navigations.navigation')

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
            @if($pedido->confirmacion==0)
            <div class="card-danger">
            @endif

            @if($pedido->confirmacion==1)
            <div class="card-warning">
            @endif

            @if($pedido->confirmacion==2)
            <div class="card-success">
            @endif
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-tags"></i> Detalle</h3>

                
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">       
                  <?php $subtotal=0;?>
                  <?php $orden=0;?>
                  @foreach($productos as $producto)
                  <div class="row">
                      <div class="col-md-12">
                          <div class="card">
                              <div class="card-body">
                                  <div class="row">
                                      <div class="col-md-3">
                                          <center><img src="{{$producto->portada=='' ? 'https://cdn.pixabay.com/photo/2017/01/25/17/35/picture-2008484_960_720.png' : $producto->portada}}" style="max-height:90px; border-radius:5px;" alt=""></center>
                                      </div>
                                      <div class="col-md-9">
                                          <h5 class="card-title"><b>{{$producto->producto}}</b></h5>

                                          <p class="card-text">
                                          {{$producto->descripcion}}
                                          </p>
                                          <div class="row">
                                            <div class="col-md-3">
                                              <div class="form-group">
                                                <label for="cantidad">Cantidad</label>
                                                <div class="input-group">
                                                  <input type="number" class="form-control" step="0.01" min="0" id="cantidad{{$orden}}" name="cantidad[]" value="{{$producto->cantidad}}" onkeyup="CalculaCosto({{$orden}})" onclick="CalculaCosto({{$orden}})">
                                                  <div class="input-group-append">
                                                      <span class="input-group-text">m<sup>3</sup></span>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="col-md-3">
                                              <div class="form-group">
                                                <label for="precio">Precio</label>
                                                <div class="input-group">
                                                  <div class="input-group-prepend">
                                                      <span class="input-group-text">$</span>
                                                  </div>
                                                  <input disabled class="form-control" id="precio{{$orden}}" type="text" value="{{number_format($producto->precio,2)}}">
                                                </div>
                                              </div>
                                            </div>
                                            <div class="col-md-3">
                                            </div>
                                            <div class="col-md-3">
                                              <div class="form-group">
                                                <label for="costo">Costo</label>                                                
                                                <input type="text" name="id[]" value="{{$producto->id}}" style="display:none;">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">$</span>
                                                    </div>
                                                    <input disabled class="form-control" id="costo{{$orden}}" name="costo" type="text" value="{{number_format($producto->precio*$producto->cantidad,2)}}">
                                                    <?php $subtotal+=$producto->precio*$producto->cantidad;?>
                                                </div>
                                              </div>                                            
                                            </div>
                                            </td>
                                          </div>
                                          <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-3"></div>
                                            <div class="col-md-3"></div>
                                            <div class="col-md-3"><button class="btn btn-primary">Generar Remision</button></div>
                                          </div> 
                                      </div>
                                  </div>
                              </div>
                          </div>
                          
                      </div>
                  </div>
                  <?php $orden++;?>
                  @endforeach
                  @foreach($transportes as $producto)
                  <div class="row">
                      <div class="col-md-12">
                          <div class="card">
                                                       
                              <div class="card-body">
                                <a class="btn btn-tool float-right borrar" href="{{url('QuitardelCarrito').'/'.$producto->id}}" data-texto="¿Deseas quitar a {{$producto->producto}} del carrito?">
                                  <i class="fas fa-times"></i>
                                </a>
                                  <div class="row">
                                      <div class="col-md-3">
                                          <center><img src="{{$producto->portada=='' ? 'https://cdn.pixabay.com/photo/2017/01/25/17/35/picture-2008484_960_720.png' : $producto->portada}}" style="max-height:90px; border-radius:5px;" alt=""></center>
                                      </div>
                                      <div class="col-md-9">
                                          <h5 class="card-title"><b>{{$producto->producto}}</b></h5>

                                          <p class="card-text">
                                          {{$producto->descripcion}}
                                          </p>
                                          <div class="row">
                                            <div class="col-md-3">
                                              <div class="form-group">
                                                <label for="cantidad">Cantidad</label>
                                                <div class="input-group">
                                                  <input type="number" step="1" min="0" class="form-control" id="cantidad{{$orden}}" name="cantidad[]" value="{{number_format($producto->cantidad,2)}}"  onkeyup="CalculaCosto({{$orden}})" onclick="CalculaCosto({{$orden}})">
                                                  <div class="input-group-append">
                                                      <span class="input-group-text"><i class="fa fa-truck" aria-hidden="true"></i></span>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="col-md-3">
                                              <div class="form-group">
                                                <label for="precio">Precio</label>
                                                <div class="input-group">
                                                  <div class="input-group-prepend">
                                                      <span class="input-group-text">$</span>
                                                  </div>
                                                  <input disabled class="form-control" id="precio{{$orden}}" type="text" value="{{number_format($producto->precio,2)}}">
                                                  
                                                  
                                                </div>
                                              </div>
                                            </div>
                                            <div class="col-md-3">
                                            </div>
                                            <div class="col-md-3">
                                              <div class="form-group">
                                                <label for="costo">Costo</label>
                                                  <input type="text" name="id[]" value="{{$producto->id}}" style="display:none;">
                                                  <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">$</span>
                                                    </div>
                                                    <input disabled class="form-control" id="costo{{$orden}}" name="costo" type="text" value="{{number_format($producto->precio*$producto->cantidad,2)}}">
                                                    <?php $subtotal+=$producto->precio*$producto->cantidad;?>
                                                </div>
                                              </div>                                            
                                            </div>
                                            </td>
                                          </div> 
                                      </div>
                                  </div>
                              </div>
                          </div>
                          
                      </div>
                  </div>
                  <?php $orden++;?>                  
                  @endforeach
                
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                        <div class="card-header">
                          <h5 class="card-title">Cotización</h5>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="costo">Instrucciones</label>
                                    <textarea disabled class="form-control" rows="10" name="instrucciones" placeholder="Comentarios">{{$pedido->instrucciones}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-3">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="costo">Subtotal</label>
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input disabled class="form-control" id="subtotal" type="text" value="{{number_format($subtotal,2)}}">
                                    </div>
                                  </div> 
                                </div>
                              </div>

                              <div class="row">                          
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="costo">IVA</label>
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                        <input disabled class="form-control" id="iva" type="text" value="{{number_format($pedido->iva,2)}}">
                                    </div>
                                  </div> 
                                </div>
                              </div>
                              <div class="row">                         
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="costo">Total</label>
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input disabled class="form-control" id="total" type="text" value="{{number_format($pedido->total,2)}}">
                                    </div>
                                  </div> 
                                </div>
                              </div>
                            </div>
                          </div>
                          
                        </div>
                        <div class="card-footer"></div>
                      </div>
                    </div>
                  </div>

                </div>
                <div class="card-footer">
                    
                <form action="" method="post" id='pedido'>                    
                  @csrf 
                  <div class="row">
                    <div class="col-md-16">
                        <div class="form-group">
                            <label for="costo">Fecha de entrega</label>
                            <input class="form-control" type="datetime-local" name="fechaentrega" id="fechaentrega" value="{{$pedido->confirmacion!= 2? '' :str_replace(' ','T',$pedido->fechaentrega)}}">
                        </div>
                    </div> 
                  </div>   
                  
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="costo">Comentario</label>
                            <textarea class="form-control" rows="10" name="comentario" placeholder="Comentario">{{$pedido->comentario}}</textarea>
                        </div>
                    </div> 
                  </div>   
                                      
                </form>
                <button class="btn btn-info" data-texto="¿Todos los datos son correctos?" onclick="Guardar('pedido',this,'{{url('GuardarPedido')}}/{{$pedido->id}}')"> <i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                    <div class="float-right">
                        @if($pedido->confirmacion!=0)
                        <button class="btn btn-danger" data-texto="El pedido será rechazado. ¿Desea continuar?" onclick="Rechazar('pedido',this,'{{url('RechazarPedido')}}/{{$pedido->id}}')"> <i class="fa fa-check"></i> Rechazar</button>
                        @endif

                        @if($pedido->confirmacion!=2)
                        <button class="btn btn-success" data-texto="¿Todos los datos son correctos?" onclick="Aceptar('pedido',this,'{{url('AceptarPedido')}}/{{$pedido->id}}')"> <i class="fa fa-check"></i> Aceptar</button>
                        @endif

                       
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

<script>
  function CalculaCosto(orden){
    console.log(orden);
    $('#costo'+orden).val($('#cantidad'+orden).val()*$('#precio'+orden).val().replace(',',''));
    FormatNumber('#costo'+orden);
    CalculaCotizacion();
  }

  function CalculaCotizacion(){
    var subtotal=0;
    var iva=$('#iva').val();
    $('input[name=costo]').each(function(){
      subtotal+=$(this).val().replaceAll(',','')*1;
    });
    $('#subtotal').val(subtotal);
    $('#total').val(subtotal+(subtotal*(iva/100)));
    FormatNumber('#subtotal');
    FormatNumber('#total');
  }

    function Guardar(form,_this,action){
        $('#fechaentrega').data('invalido',true);
        $('#'+form).attr('action',action);
        Submite(form,_this);
    } 

    function Rechazar(form,_this,action){
        $('#fechaentrega').data('invalido',true);
        $('#'+form).attr('action',action);
        Submite(form,_this);
    } 
    function Aceptar(form,_this,action){
        $('#fechaentrega').data('invalido',false);
        $('#'+form).attr('action',action);
        Submite(form,_this);
    }    
</script>
</body>
</html>
