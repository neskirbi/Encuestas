<!DOCTYPE html>
<html lang="en">
<head>
  @include('recepcion.header')
  <title>{{GetSiglas(0)}} | Microgeneradores</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('recepcion.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('recepcion.sidebars.sidebar')

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
          <div class="col-md-12">
            @if($microgenerador->confirmacion==0)
            <div class="card card-danger">
            @endif
            @if($microgenerador->confirmacion==1)
            <div class="card card-default">
            @endif
            @if($microgenerador->confirmacion==2)
            <div class="card card-success">
            @endif
            
              <div class="card-header">
                  <h3 class="card-title">Cita</h3>
              </div>
              <div class="card-body">
                <form action="{{url('microgeneradoresa')}}/{{$microgenerador->id}}" method="POST">
                    @csrf                  
                    <input name="_method" type="hidden" value="PUT">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="nombre">Nombre Completo</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" maxlength="150" value="{{$microgenerador->nombre}}">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="nombre">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" maxlength="40" value="{{$microgenerador->telefono}}">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="correo">Correo</label>
                                <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo" maxlength="150" value="{{$microgenerador->correo}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="calle">Calle</label>
                            <input type="text" name="calle" class="form-control" id="calle" placeholder="Calle" aria-invalid="false" maxlength="500" value="{{$microgenerador->calle}}">
                            </div>
                        </div>
                        

                    
                        <div class="col-md-3">                                    
                            <div class="form-group">
                            <label for="numeroext">Número ext.</label>
                            <input type="text" name="numeroext" class="form-control" id="numeroext" placeholder="Número ext." aria-invalid="false" maxlength="50" value="{{$microgenerador->numeroext}}">
                            </div>
                        </div>
                    
                        
                                
                        <div class="col-md-3"> 
                            <div class="form-group">
                                <label for="numeroint">Número int.</label>
                                <input type="text" name="numeroint" class="form-control" id="numeroint" placeholder="Número int." aria-invalid="false" maxlength="50" value="{{$microgenerador->numeroint}}">
                            </div>
                        </div>
                                            
                        
                        <div class="col-md-3"> 
                            <div class="form-group">
                                <label for="colonia">Colonia</label>
                                <input type="text" name="colonia" class="form-control" id="colonia" placeholder="Colonia" aria-invalid="false" maxlength="500" value="{{$microgenerador->colonia}}">
                            </div>
                        </div>
                            

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="municipio">Municipio/Alcaldía</label>
                                <input type="text" name="municipio" class="form-control" id="municipio" placeholder="Municipio" aria-invalid="false" maxlength="50" value="{{$microgenerador->municipio}}">
                            </div>  
                        </div>
                    

                    
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cp">C.P.</label>
                                <input type="text" name="cp" class="form-control" id="cp" placeholder="CP" aria-invalid="false" maxlength="20" value="{{$microgenerador->cp}}">
                            </div>
                        </div>
                    </div>
                      
                  
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="transporte">Residuo</label><br>
                                <select class="form-control" name="material" id="material" aria-invalid="false" maxlength="150" onchange="Precio();">
                                    <option value="" data-precio="{{$microgenerador->precio}}">{{$microgenerador->material}}</option>
                                    <optgroup label=""></optgroup>
                                    <?php $categoria='';?>
                                    @foreach($materiales as $material)
                                        @if($categoria!=$material->categoriamaterial)
                                        <optgroup label="{{$material->categoriamaterial}}"></optgroup>
                                        <?php $categoria=$material->categoriamaterial; ?>
                                        @endif
                                        <option value="{{$material->id}}" data-precio="{{$material->precio}}">{{$material->material}}</option>
                                    @endforeach
                                </select>                                                                                
                            </div>
                        </div>
                        <div class="col-md-4">                   
                          <div class="form-group"> 
                              <label for="condicionmaterial">Medida</label>
                              <select type="text" name="condicionmaterial" class="form-control" id="condicionmaterial" aria-invalid="false" onchange="CambiaCondicion(); Precio();">
                                    <option value="{{$microgenerador->condicionmaterial}}">{!!$microgenerador->condicionmaterial==1 ? 'm<sup>3</sup>' : 'Costales'!!}</option>
                                    <optgroup ></optgroup>
                                    <option value="1">m<sup>3</sup></option>
                                    <option value="30">Costales</sup></option>
                              </select>
                          </div>
                      </div>
                    </div>
                        
                    
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nombres">Precio</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" min="0.1" step="0.1" class="form-control" name="precio" id="precio" placeholder="Precio" aria-invalid="false" value="{{$microgenerador->precio}}"  onchange="Precio();">
                                    
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nombres">Cantidad <span id="condicion">{!!$microgenerador->condicionmaterial==1 ? 'm<sup>3</sup>' : 'Costales'!!}</span></label>
                                <div class="input-group mb-3">
                                    <input required type="number" min="1" step="1" name="cantidad" class="form-control" id="cantidad" placeholder="Catidad" aria-invalid="false" onchange="Precio();" value="{{$microgenerador->cantidad}}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">m<sup>3</sup></span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="nombres">Subtotal</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input disabled type="text" min="0.1" step="0.1"  class="form-control" id="subtotal" placeholder="Catidad" aria-invalid="false" value="0">
                                    
                                </div>
                                
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="nombres">IVA</label>
                                <div class="input-group mb-3">
                                    <input disabled type="text" min="0.1" step="0.1"  class="form-control" id="iva" placeholder="IVA" aria-invalid="false" value="{{$iva}}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="nombres">Total</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input disabled type="text" min="0.1" step="0.1"  class="form-control" id="total" placeholder="Catidad" aria-invalid="false" value="0">
                                    
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                      
                      <div class="col-md-4">                   
                          <div class="form-group">
                              <label for="fechayhora">Seleccionar Fecha y Hora</label>
                              <input type="datetime-local" class="form-control" aria-invalid="false" name='fechayhora' id="fechayhora"  value="{{$microgenerador->fechayhora}}" >
                          </div>
                      </div>
                      
                  </div>
                  
                  <div class="modal-footer">
                    @if($microgenerador->confirmacion==1)
                        <a href="{{url('ConfirmarMicro')}}/{{$microgenerador->id}}" class="btn btn-success">Confirmar</a>
                    @endif
                      <button type="submit" class="btn btn-primary">Guardar</button>
                  </div>
                    
                    
                    
                </form>
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
    $(document).ready(function(){
         
        Precio();
    });
</script>
@include('recepcion.footer')
</body>
</html>
