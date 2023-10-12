<!DOCTYPE html>
<html lang="en">
<!--jonathan-->
<head>
  @include('dosificadores.header')
  <title>{{GetSiglas(0)}} | Pedido</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

 <!-- Navbar -->
 @include('dosificadores.sidebars.sidebar') 

@include('dosificadores.navigations.navigation')

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
        <?php $nremisiones=0;?>
        <div class="row">
          <div class="col-12">
            @if($pedido->confirmacion==0)
            <div class="callout callout-danger">
            @endif

            @if($pedido->confirmacion==1)
            <div class="callout callout-warning">
            @endif

            @if($pedido->confirmacion==2)
            <div class="callout callout-success">
            @endif

            @if($pedido->confirmacion==3)
            <div class="callout callout-info">
            @endif
              <h5><i class="fa fa-tags"></i> Detalle</h5>
            </div>
          </div>
        </div>
        
        <div class="row">
        
          <div class="col-12">
            
          
            <!-- /.card-header -->     
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
                                            <input disabled type="number" class="form-control" step="0.01" min="0" id="cantidad{{$orden}}" name="cantidad[]" value="{{$producto->cantidad}}" onkeyup="CalculaCosto({{$orden}})" onclick="CalculaCosto({{$orden}})">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                  @if($producto->id_producto!='')
                                                  {{$producto->unidades}}
                                                  @endif
                                                  @if($producto->id_transporte!='')
                                                  <i class="fa fa-truck" aria-hidden="true"></i> Viaje
                                                  @endif
                                                </span>
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
                                      <div class="col-md-3">
                                        @if($pedido->confirmacion==2 and $producto->id_producto!='')
                                        <button class="btn btn-primary btn-block" class="btn btn-primary" data-id="{{$producto->id}}" data-orden="{{$producto->orden}}" data-producto="{{$producto->producto}}" data-descripcion="{{$producto->descripcion}}" data-disponible="{{$producto->restantes}}" data-unidades="{{$producto->unidades}}" data-toggle="modal" data-target="#remisiones" onclick="CargarDatosRemision(this)"><i class="fa fa-file-text"></i> Generar Remisión</button>
                                        @endif
                                      </div>
                                    </div> 

                                    
                                </div>                                
                            </div>
                            @if(count($producto->remisiones))
                            <div class="row">
                              <div class="col-md-12">
                                <h5 class="card-title"><b>Remisiones</b></h5>                                
                              </div>                                
                            </div>
                            <div class="row">
                              <div class="col-md-12" style="overflow-x:scroll;">
                                <table class="table table-hover text-nowrap">
                                  <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Restantes</th>
                                    <th>Pedidos</th>
                                    <th>Entregados</th>
                                    <th>Referencia</th>
                                    <th>Estatus</th>
                                    <th colspan="2">Opciones</th>
                                  </tr>
                                  @foreach($producto->remisiones as $remision)
                                  <?php $nremisiones++;?>
                                  <tr>
                                    <td>{{$remision->orden}}/{{count($producto->remisiones)}}</td>
                                    <td>{{FechaFormateada($remision->created_at)}}</td>
                                    <td>{{$remision->restantes}}m<sup>3</sup></td>
                                    <td>{{$remision->pedidos}}m<sup>3</sup></td>
                                    <td>{{$remision->entregados}}m<sup>3</sup></td>
                                    <td>{{$remision->referencia}}</td>
                                    <td>
                                      @if($remision->confirmacion==0)
                                      <small class="badge badge-danger"><i class="fa fa-check" aria-hidden="true"></i>  Cancelado</small>
                                      @elseif($remision->confirmacion==1)
                                      <small class="badge badge-info"><i class="fa fa-exclamation" aria-hidden="true"></i> En Planta</small>
                                      @elseif($remision->confirmacion==2)
                                      <small class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i>  Entregado</small>
                                      @elseif($remision->confirmacion==3)
                                      <small class="badge badge-warning"><i class="fa fa-check" aria-hidden="true"></i>  En Transito</small>
                                      @endif
                                    </td>
                                    <td>
                                    @if($remision->confirmacion==1)                                    
                                      <a href="{{url('RemisionWeb')}}/{{$remision->id}}" target="_blank" class="btn btn-info" data-pid="{{$remision->id}}"><i class="fa fa-check" aria-hidden="true"></i> Entregar</a>
                                    @endif

                                    @if($remision->confirmacion==2)
                                    <!--<a target="_black"  data-salida="{{$remision->planta_salida}}" data-entrada="{{$remision->planta_entrada}}"  href="{{url('Remision').'/'.$remision->id}}" class="btn btn-info "><i class="fas fa-print"></i> Descargar</a>-->
                                    @endif
                                    
                                    </td>
                                    <td>
                                    @if($remision->confirmacion==1)                                    
                                      <a href="{{url('GenerarCodigoRecoleccion')}}/{{$remision->id}}" target="_blank" class="btn btn-success btn-sm" style="width:100%;" data-pid="{{$remision->id}}"><i class="fa fa-qrcode" aria-hidden="true"></i> Entregar con QR</a>
                                    @endif
                                   
                                    </td>

                                  </tr>
                                  @endforeach
                                </table>
                              </div>                              
                            </div> 
                            @endif
                        </div>
                    </div>
                    
                </div>
            </div>
            <?php $orden++;?>
            @endforeach
            
          
            
          </div>
            <!-- /.card -->
          
          
        </div>
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
                          <input disabled class="form-control" type="datetime-local" name="fechaentrega" id="fechaentrega" value="{{str_replace(' ','T',$pedido->fechaentrega)}}">
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
              
            </div>
            <!-- /.card-body -->
          </div>          
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <form action="" method="post" id='pedido'>                    
                  @csrf 
                   
                  
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="costo">Comentario</label>
                            <textarea disabled class="form-control" rows="10" name="comentario" placeholder="Comentario">{{$pedido->comentario}}</textarea>
                        </div>
                    </div> 
                  </div>   
                                      
                </form>
                
               
              </div>
              <div class="card-footer">
                
                </div>
               
                  

                       
              </div>
            </div>
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

@include('dosificadores.pedidos.modals.remision')

<script>
  
</script>
</html>
