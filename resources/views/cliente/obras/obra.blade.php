<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>CSMX | Obra</title>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  
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
        
            @if($obra->verificado==0)
            <div class="card card-default">
            @else
            <div class="card card-success">
            @endif
                <div class="card-header">
                    <h3 class="card-title">Registro de Obra</h3>            
                </div>
                <!-- /.card-header -->
                
                <div class="card-body">  

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Datos de la obra</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label for="generador">Generador</label>
                                        <input readonly type="text"  class="form-control" id="generador" value="{{$obra->razonsocial}}" aria-invalid="false" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="planta">Planta</label>
                                        <input readonly type="text"  class="form-control" id="planta" value="{{$planta->planta}}" aria-invalid="false" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="obra">Nombre de la obra</label>
                                        <input readonly type="text"  class="form-control" id="obra" value="{{$obra->obra}}" aria-invalid="false" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="distancia">Distancia a la planta</label>
                                        <div class="input-group">
                                            <input disabled data-invalido="true" type="number" step="0.1" min="0" name="distancia" id="distancia"  class="form-control" aria-invalid="false" value="{{$obra->distancia}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Km</span>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nautorizacion">Numero de autorización</label>
                                        <input readonly data-invalido="true" type="text"   class="form-control" value="{{$obra->nautorizacion}}" aria-invalid="false" >
                                    </div>
                                </div>
                                

                                
                            
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="nautorizacion">Publica/Privada</label>
                                    <div class="form-group">
                                        <div class="form-check">
                                        <input class="form-check-input" value="1" type="radio" name="pp" {{$obra->publica==1 ? 'checked' : '' }}>
                                        <label class="form-check-label">Publica</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" value="0" type="radio" name="pp" {{$obra->publica==0 ? 'checked' : '' }}>
                                        <label class="form-check-label">Privada</label>
                                        </div>                                        
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ncontrato">Numero de contrato</label>
                                        <input disabled data-invalido="true" type="text" name="ncontrato" id="ncontrato"  class="form-control" aria-invalid="false" value="{{$obra->ncontrato}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="tipoobra">Tipo de obra</label>
                                </div>
                                <div class="col-md-6">
                                    <label for="tipoobra">Subtipo de obra</label>
                                </div>
                            </div>
                            @foreach($tipoobras as $i=>$tipoobra)
                            <div class="row">
                            
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <input type="checkbox" id="tc{{$i}}" data-id="{{$i}}" value="tipoobra" data-tipo="{{$tipoobra->tipoobra}}" onclick="CargarTipo(this)" class="checkgrande tipo" style="width:20px;">
                                        <label for="tc{{$i}}">{{$tipoobra->tipoobra}}</label>
                                        <input data-invalido="true" type="text"  id="si{{$i}}" name="tipoobra[]" style="display:none;">
                                    </div>   
                                    

                                    <div class="form-group">
                                        <div class="input-group">
                                            <input disabled class="form-control volumen" data-invalido="true" type="number" step="0.01" min="0" id="v{{$i}}" data-id="{{$i}}" onkeyup="CargarTipo(this); VolumenTotal();" placeholder="Superficie">
                                            <div class="input-group-append">
                                                <span class="input-group-text">m<sup>2</sup></span>
                                            </div>
                                        </div>
                                    </div>  
                                    
                                    
                                </div>
                                

                                <div class="col-md-6"> 
                                    <div class="form-group">

                                            @foreach(explode(';;',$tipoobra->subtipoobra) as $index=>$subtipoobra)
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <?php $temp=explode('::',$subtipoobra); ?>
                                                    <input type="checkbox" id="sc{{$index}}" data-id="{{$i}}{{$index}}" data-subtipo="{{$temp[1]}}" onclick="CargarSubtipo(this);" class="checkgrande subtipo" style="width:20px;">
                                                    <label for="sc{{$index}}">{{$temp[1]}}</label>
                                                    <input data-invalido="true" type="text" value="" id="s{{$i}}{{$index}}" name="subtipoobra[]" style="display:none;">
                                            
                                                </div>
                                            </div>

                                            @endforeach
                                        </select>
                                    </div>                                   
                                    
                                </div>

                        
                            </div>
                            <!--Guardando la cantidad de checks para calcular el volumen total-->
                            
                            @endforeach
                            
                          
                            <div class="row" style="display:none;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="obra" id="tag">Total</label>
                                        <div class="input-group">
                                            <input disabled type="text" name="cantidadobra" class="form-control" id="cantidadobra"  aria-invalid="false" step="0.01" min="0" value="{{number_format($obra->cantidadobra,2)}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text">m<sup>2</sup></span>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="calle">Calle</label>
                                        <input readonly type="text"  class="form-control" id="calle" value="{{$obra->calle}}" aria-invalid="false" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="numeroext">Número Ext.</label>
                                        <input readonly type="text"  class="form-control" id="numeroext" value="{{$obra->numeroext}}" aria-invalid="false" >
                                    </div>
                                </div>
                                
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="numeroint">Número Int.</label>
                                        <input readonly type="text"  class="form-control" id="numeroint" value="{{$obra->numeroint}}" aria-invalid="false" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="colonia">Colonia</label>
                                        <input readonly type="text"  class="form-control" id="colonia" value="{{$obra->colonia}}" aria-invalid="false" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cp">C.P.</label>
                                        <input readonly type="text"  class="form-control" id="cp" value="{{$obra->cp}}" aria-invalid="false" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="entidad">Entidad federativa</label>
                                        <input readonly  type="text"  class="form-control" id="entidad" value="{{$obra->entidad}}" aria-invalid="false" >
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="municipio">Alcaldía/Municipio</label>
                                        <input readonly type="text"  class="form-control" id="municipio" value="{{$obra->municipio}}" aria-invalid="false" >
                                    </div>
                                </div>
                            </div>
                            <div calss="row">
                                <div class="col-md-8">
                                    <div id="map" style=" height: 350px; width:100%;"></div>
                                </div>
                            </div>

                            <div class="row">
                                
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="latitud">Latitud</label>
                                        <input readonly type="text"  class="form-control" id="latitud" value="{{$obra->latitud}}" aria-invalid="false" readonly>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="longitud">Longitud</label>                                           
                                        <input readonly type="text"  class="form-control" id="longitud" value="{{$obra->longitud}}" aria-invalid="false" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fechainicio">Inicio</label>                                           
                                        <input readonly type="text"  class="form-control" id="fechainicio" value="{{$obra->fechainicio}}" aria-invalid="false">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fechafin">Fin</label>                                           
                                        <input readonly type="text"  class="form-control" id="fechafin" value="{{$obra->fechafin}}" aria-invalid="false">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($obra->aplicaplan) 
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Plan de manejo de residuos</h3>
                            @if($obra->verificado==0)
                            <div class="card-tools">
                            <a href="#" data-toggle="modal" data-target="#modalplanmanejo" class="float-right"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            </div>
                            @endif
                        </div>
                        <div class="card-body">

                            <div class="row">
                               
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vigenciaplan">Vigencia del plan de manejo</label>                                           
                                        <input readonly type="text"  class="form-control"  value="{{$obra->vigenciaplan}}" aria-invalid="false">
                                    </div>
                                    
                                </div>
                            </div>

                                                      

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="declaratoria">Declaratoria o manifestación de impacto ambiental</label>
                                            <iframe id="inlineFrameExample"
                                                title="identificación"
                                                width="100%"
                                                height="200"
                                                src="{{asset('documentos/obras/declaratoria').'/'.$obra->declaratoria}}">
                                            </iframe>
                                            <a target="_blank" class="btn btn-default" href="{{asset('documentos/obras/declaratoria').'/'.$obra->declaratoria}}">Ver</a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="planmanejo">Plan de manejo de residuos</label>
                                            <iframe id="inlineFrameExample"
                                                title="identificación"
                                                width="100%"
                                                height="200"
                                                src="{{asset('documentos/obras/plan').'/'.$obra->planmanejo}}">
                                            </iframe>
                                            <a target="_blank" class="btn btn-default" href="{{asset('documentos/obras/plan').'/'.$obra->planmanejo}}">Ver</a>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    @endif

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Material</h3>
                            
                        </div>
                        <div class="card-body">
                          @foreach($materiales as $material)
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="categoria">Categoría</label>
                                        <input readonly type="text" min="1"  class="form-control" value="{{$material->categoriamaterial}}" aria-invalid="false" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="material">Material</label>
                                        <input readonly type="text" min="1"  class="form-control"  value="{{$material->material}}" aria-invalid="false" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cantidad">Cantidad</label>
                                        <div class="input-group">
                                        <input readonly type="text" min="1"  class="form-control"  value="{{number_format($material->cantidad,2)}}" aria-invalid="false" >
                                            <div class="input-group-append">
                                                <span class="input-group-text">m<sup>3</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="precio0">Precio unitario</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input  type="text" min="1" class="form-control" placeholder="Precio" aria-invalid="false" value="{{number_format($material->precio,2)}}" readonly >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="costo">Importe</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input readonly type="text" class="form-control" placeholder="Importe" aria-invalid="false" value="{{number_format($material->precio*$material->cantidad,2)}}"  >
                                        </div>
                                        
                                    </div>
                                </div>                                 
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                    
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Datos del contacto</h3>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contacto">Nombre del Contacto</label>
                                            <input readonly  type="text" name="contacto" class="form-control" id="contacto" placeholder="Nombre del Contacto"  minlength="1" maxlength="100" aria-invalid="false"  value="{{$obra->contacto}}">
                                        </div>
                                    </div>
                                </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telefono">Teléfono</label>
                                        <input readonly type="text"  class="form-control" id="telefono" value="{{$obra->telefono}}" aria-invalid="false" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="celular">Celular</label>
                                        <input readonly type="text"  class="form-control" id="celular" value="{{$obra->celular}}" aria-invalid="false" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="correo">Correo</label>
                                        <input readonly type="text"  class="form-control" id="correo" value="{{$obra->correo}}" aria-invalid="false" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="correo2">Correo 2</label>
                                        <input readonly type="text"  class="form-control" id="correo2" value="{{$obra->correo2}}" aria-invalid="false" >
                                    </div>
                                </div>
                            </div>
                            

                            
                        </div>
                    </div>     



                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Adicionales</h3>
                        </div>
                        <div class="card-body">

                            
                            <div class="row">
                                                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="aplicaplan">¿Aplica Plan de Manejo?</label><br>
                                        @if($obra->aplicaplan)
                                        <input type="checkbox" class="checkgrande" name="aplicaplan"  id="aplicaplan" aria-invalid="false" checked>
                                        @else
                                        <input type="checkbox" class="checkgrande" name="aplicaplan"  id="aplicaplan" aria-invalid="false" >
                                        @endif
                                    </div>
                                    
                                </div>

                             
                            </div>

                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contraramir">¿Requiere contrato RAMIR?</label><br>
                                        @if($obra->contraramir)
                                        <input type="checkbox" class="checkgrande" name="contraramir"  id="contraramir" aria-invalid="false" checked>
                                        @else
                                        <input type="checkbox" class="checkgrande" name="contraramir"  id="contraramir" aria-invalid="false" >
                                        @endif
                                    </div>
                                    
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contrasindicato">¿Requiere contrato de transporte con sindicato?</label><br>
                                        @if($obra->contrasindicato)
                                        <input type="checkbox" class="checkgrande" name="contrasindicato"  id="contrasindicato" aria-invalid="false" checked>
                                        @else
                                        <input type="checkbox" class="checkgrande" name="contrasindicato"  id="contrasindicato" aria-invalid="false" >
                                        @endif
                                    </div>
                                    
                                </div>
                            </div>

                            <hr>
                            
                        </div>
                    </div> 
                    
                  

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Póliza RC</h3>
                        </div>
                        <div class="card-body">
                            
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="polizarc">¿Quiere Poliza de RC?</label><br>
                                        @if($obra->polizarc)
                                        <input type="checkbox" class="checkgrande" name="polizarc"  id="polizarc" aria-invalid="false"  checked>
                                        @else
                                        <input type="checkbox" class="checkgrande" name="polizarc"  id="polizarc" aria-invalid="false" >
                                        @endif
                                        
                                    </div>
                                    
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="valorobra">¿Cual es el valor de la obra?</label><br>
                                        <input disabled type="number" class="form-control" name="valorobra"  id="valorobra" aria-invalid="false" min="0" value="{{$obra->valorobra}}" >
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>   

                    
                       
                    <form action="{{url('AsignarUia/'.$obra->id)}}" method="post">
                        @csrf
                        @method('put')
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Unidad de Inspección Ambiental</h3>
                            </div>
                            <div class="card-body">

                                
                                
                                <div class="row">
                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <label for="uia">Unidad de Inspección Ambiental</label>
                                            <select required class="form-control" name="uia" id="uia" aria-invalid="false" >
                                                @if(isset($uia))
                                                <option value="{{$uia->id}}">{{$uia->uia}}</option>
                                                @else
                                                <option value="">--UIA--</option>
                                                @endif
                                                <optgroup></optgroup>
                                                @foreach($uias as $uia)
                                                <option value="{{$uia->id}}">{{$uia->uia}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-info">Asignar</button>
                            </div>
                        </div> 
                    </form>
                    


                </div><!--End body-->
               
                
            </div><br>
 
          
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
  $.widget.bridge('uibutton', $.ui.button);

 
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
<script>
      function initMap() {
        const myLatlng = { lat:  $('#latitud').val()*1, lng: $('#longitud').val()*1 };
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 19,
          center: myLatlng,
        });
        const marker = new google.maps.Marker({
            position: myLatlng,
            map,
            title:$('#obra').val()
        });
        
        // Create the initial InfoWindow.
        let infoWindow = new google.maps.InfoWindow({
          content: $('#obra').val(),
          position: myLatlng,
        });
        infoWindow.open(map,marker);
        // Configure the click listener.
        /*map.addListener("click", (mapsMouseEvent) => {
          // Close the current InfoWindow.
          infoWindow.close();
          // Create a new InfoWindow.
          infoWindow = new google.maps.InfoWindow({
            position: mapsMouseEvent.latLng,
          });
          var coordenadas=mapsMouseEvent.latLng.toJSON();
          $('#latitud').val(coordenadas.lat);
          $('#longitud').val(coordenadas.lng);
          infoWindow.setContent('La obra se localiza:<br>Latitud:'+coordenadas.lat+'<br>Longitud:'+coordenadas.lng);
          infoWindow.open(map);
        });*/
      }

      
    </script>
    @if(gettype($obra->tipoobra)=='array')
    @foreach($obra->tipoobra as $to)
    <script>
        LlenarTipoObra(HtmltoJson('{{($to)}}'));
    </script>
    @endforeach
    @endif

    @if(gettype($obra->subtipoobra)=='array')
    @foreach($obra->subtipoobra as $st)
    
    @if(gettype($st)=='string')
    <script>
        LlenarSubtipoObra(HtmltoJson('{{($st)}}'));
    </script>
    @endif
    @endforeach
    
    @endif
    
    @include('MapsApi')
    
    @include('cliente.obras.modals.modalplandemanejo')
</body>
</html>
