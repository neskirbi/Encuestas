<!DOCTYPE html>
<html lang="en">
<head>
  @include('ventas.header')
  <title>{{GetSiglas(0)}} | Pedidos</title>

  
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
              <div class="callout callout-warning">
              <h5><i class="fa fa-tags"></i> Detalle</h5>
            </div>
          </div>
        </div>


        <?php $subtotal=0;?>
        <?php $orden=0;?>
        <form action="pedidos" method="post" id='pedido'>
        @csrf  
        @foreach($productos as $producto)
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <a class="btn btn-tool float-right borrar" href="{{url('QuitardelCarrito').'/'.$producto->id}}" data-texto="¿Deseas quitar a {{$producto->producto}} del carrito?">
                  <i class="fas fa-times"></i>
                </a>
                <div class="row">
                  <div class="col-md-3">
                    <center><img src="{{!file_exists(public_path($producto->portada)) ? 'https://cdn.pixabay.com/photo/2017/01/25/17/35/picture-2008484_960_720.png' : url($producto->portada)}}" style="max-height:90px; border-radius:5px;" alt=""></center>
                  </div>
                  <div class="col-md-9">
                    <h5 class="card-title">
                      <b>{{$producto->producto}}</b>
                    </h5>
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
                                @if($producto->id_producto!='')
                                <span class="input-group-text">m<sup>3</sup></span>
                                @elseif($producto->id_transporte!='')                                  
                                <span class="input-group-text"><i class="fa fa-truck" aria-hidden="true"></i></span>
                                @endif
                                
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
              
              <div class="card-body">
                <div class="row">
                  <div class="col-md-9">
                    <textarea data-invalido="false" class="form-control" rows="10" name="instrucciones" placeholder="Comentarios"></textarea>
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
                              <input disabled class="form-control" id="iva" type="text" value="{{number_format($iva,2)}}">
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
                              <input disabled class="form-control" id="total" type="text" value="{{number_format(($subtotal*($iva/100))+$subtotal,2)}}">
                          </div>
                        </div> 
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
              
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Datos de la Entrega</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-3">
                      <div class="form-group">
                          <label for="costo">Fecha de Entrega</label>
                          <input class="form-control" type="datetime-local" name="fechaentrega" id="fechaentrega" value="">
                      </div>
                  </div> 
                </div> 

                <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label for="obra">Obra</label>
                          <textarea disabled name="obra" id="obra" class="form-control">{{$obra->obra}}</textarea>
                          
                      </div>
                  </div> 
                </div> 
                <div class="row">
                  <div class="col-md-8">
                      <div class="form-group">
                          <label for="calle">Calle</label>
                          <input disabled class="form-control" type="text" name="calle" id="calle" value="{{$obra->calle}}">
                      </div>
                  </div> 
                  <div class="col-md-2">
                      <div class="form-group">
                          <label for="numeroext">Ext.</label>
                          <input disabled class="form-control" type="text" name="numeroext" id="numeroext" value="{{$obra->numeroext}}">
                      </div>
                  </div> 
                  <div class="col-md-2">
                      <div class="form-group">
                          <label for="numeroint">Int.</label>
                          <input disabled class="form-control" type="text" name="numeroint" id="numeroint" value="{{$obra->numeroint}}">
                      </div>
                  </div> 
                </div> 
                <div class="row">
                  <div class="col-md-9">
                      <div class="form-group">
                          <label for="colonia">Colonia</label>
                          <input disabled class="form-control" type="text" name="colonia" id="colonia" value="{{$obra->colonia}}">
                      </div>
                  </div> 
              </div> 

              <div class="row">
                  <div class="col-md-3">
                      <div class="form-group">
                          <label for="cp">CP</label>
                          <input disabled class="form-control" type="text" name="cp" id="cp" value="{{$obra->cp}}">
                      </div>
                  </div> 
               
                  <div class="col-md-4">
                      <div class="form-group">
                          <label for="municipio">Municipio</label>
                          <input disabled class="form-control" type="text" name="municipio" id="municipio" value="{{$obra->municipio}}">
                      </div>
                  </div> 
                  <div class="col-md-4">
                      <div class="form-group">
                          <label for="entidad">Entidad</label>
                          <input disabled class="form-control" type="text" name="entidad" id="entidad" value="{{$obra->entidad}}">
                      </div>
                  </div> 
                </div> 
              </div>
              <div class="card-footer">
                @if(0)<a class="btn btn-info float-right" data-texto="¿Todos los datos son correctos?" onclick="Submite('pedido',this);"> <i class="fa fa-file-text" aria-hidden="true"></i> Generar Pedido</a>@endif
                
              </div>
            </div>
            <!-- /.card-body -->
          </div>          
        </div>
        </form>  
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
</script>
</body>
</html>
