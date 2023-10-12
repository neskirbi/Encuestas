<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>CSMX | Registro Obra</title>
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
        
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Registro de Obra</h3>            
                </div>
                <!-- /.card-header -->
                    <form method="POST" action="obras" id="formobra" enctype="multipart/form-data">
                    @csrf
                    
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
                                            <select class="form-control" name="generador" id="generador" aria-invalid="false" >
                                                <option value="">--Generador--</option>
                                                @foreach($generadores as $generador)
                                                <option value="{{$generador->id}}">{{$generador->razonsocial}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="planta">Planta</label>
                                            <select name="planta" id="planta" class="form-control" onchange="ReiniciaMateriales();">
                                                <option value="">---Planta---</option>
                                                @foreach($plantas as $planta)
                                                <option value="{{$planta->id}}">{{$planta->planta}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="obra">Nombre de la obra</label>
                                            <input required type="text" name="obra" class="form-control" id="obra" placeholder="Nombre de la obra" minlength="1" maxlength="500" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="distancia">Distancia a la planta</label>
                                            <div class="input-group">
                                                <input type="number" step="0.1" min="0" name="distancia" id="distancia"  class="form-control" aria-invalid="false" value="0.0">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Km</span>
                                                </div>                                                
                                            </div>                                            
                                        </div>
                                    </div>
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nautorizacion">Numero de autorización</label>
                                            <input data-invalido="true" type="text" name="nautorizacion" id="nautorizacion"  class="form-control" aria-invalid="false" >
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    

                                    <div class="col-md-3">
                                        <label for="pp">Publica/Privada</label>
                                        <div class="form-group">
                                            <div class="form-check">
                                            <input class="form-check-input" value="1" type="radio" name="pp">
                                            <label class="form-check-label">Publica</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" value="0" type="radio" name="pp">
                                            <label class="form-check-label">Privada</label>
                                            </div>                                        
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ncontrato">Numero de contrato</label>
                                            <input data-invalido="true" type="text" name="ncontrato" id="ncontrato"  class="form-control" aria-invalid="false" >
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
                                            <input type="checkbox" id="tc{{$i}}" data-id="{{$i}}" value="tipoobra" data-tipo="{{$tipoobra->tipoobra}}" onclick="CargarTipo(this)" class="checkgrande" style="width:20px;">
                                            <label for="tc{{$i}}">{{$tipoobra->tipoobra}}</label>
                                            <input data-invalido="true" type="text"  id="si{{$i}}" name="tipoobra[]" style="display:none;">
                                        </div>   
                                        
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input  data-invalido="true" disabled class="form-control volumen" type="number" step="0.01" min="0" id="v{{$i}}" data-id="{{$i}}" onkeyup="CargarTipo(this); VolumenTotal();" placeholder="Superficie">
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
                                                        <input type="checkbox" value="subtipoobra" id="sc{{$index}}" data-id="{{$i}}{{$index}}" data-subtipo="{{$temp[1]}}" onclick="CargarSubtipo(this);" class="checkgrande" style="width:20px;">
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
                                <script>
                                    var totalobra = {{$i}};
                                </script>
                                @endforeach

                                <div class="row" style="display:none;">
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label for="obra" id="tag">Total</label>
                                            <div class="input-group">
                                                <input data-invalido="true" type="text" name="cantidadobra" class="form-control" id="cantidadobra"  aria-invalid="false" step="0.01" min="0"  >
                                                <div class="input-group-append">
                                                    <span class="input-group-text">m<sup>2</sup></span>
                                                </div>
                                            </div>

                                            
                                        </div>
                                    </div>
                                </div>

                                <div calss="row">
                                    <div class="col-md-8">
                                        <div id="map" style=" height: 350px; width:100%;"></div>
                                    </div>
                                    
                                </div>

                                <div calss="row">
                                    <div class="col-md-8">
                                        <br>                                        
                                        <div class="form-group">
                                            <input data-invalido="true"  type="text" id="search_location" class="form-control" placeholder="Buscar dirección">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="latitud">Latitud</label>
                                            <input required type="text" name="latitud" class="form-control" id="latitud" placeholder="Latitud" aria-invalid="false" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="longitud">Longitud</label>                                           
                                            <input required type="text" name="longitud" class="form-control" id="longitud" placeholder="Longitud" aria-invalid="false" readonly>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="calle">Calle</label>
                                            <input required type="text" name="calle" class="form-control" id="calle" placeholder="Calle" minlength="4" maxlength="150" aria-invalid="false" >
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="numeroext">Número Ext.</label>
                                            <input required type="text" name="numeroext" class="form-control" id="numeroext" placeholder="Número Ext." minlength="1" maxlength="10" aria-invalid="false" >
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="numeroint">Número Int.</label>
                                            <input required type="text" name="numeroint" class="form-control" id="numeroint" placeholder="Número Int." minlength="1" maxlength="10" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="colonia">Colonia</label>
                                            <input required type="text" name="colonia" class="form-control" id="colonia" placeholder="Colonia"  minlength="1" maxlength="150" aria-invalid="false" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cp">C.P.</label>
                                            <input required type="text" name="cp" class="form-control" id="cp" placeholder="C.P."  minlength="1" maxlength="10" aria-invalid="false" >
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="entidad">Entidad federativa</label>
                                            <!--<input  type="text" name="entidad" class="form-control" id="entidad" placeholder="Entidad federativa" aria-invalid="false" >-->
                                            <select  name="entidad" class="form-control" id="entidad" aria-invalid="false" onchange="MunicipiosApi(this,1);">
                                                <option value="">--Entidad Federativa--</option>
                                                @foreach($entidades as $entidad)
                                                <option value="{{$entidad->entidad}}">{{$entidad->entidad}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="municipio">Alcaldía/Municipio</label>
                                            <select  name="municipio" class="form-control" id="municipio" aria-invalid="false" data-mun="municipio" >                                               
                                            </select>
                                        </div>
                                    </div>
                                   
                                </div>

                               

                               
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fechainicio">Inicio</label>                                           
                                            <input required type="date" name="fechainicio" class="form-control" id="fechainicio" aria-invalid="false">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fechafin">Fin</label>                                           
                                            <input required type="date" name="fechafin" class="form-control" id="fechafin" aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Material</h3>                                
                            </div>
                            <div class="card-body">
                                <div class="float-right">
                                    <button type="button" class="btn bg-danger btn-sm" onclick="MenosMateriales();">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn bg-info btn-sm" onclick="MasMateriales();" id="mas">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="superficie">Volumen</label>
                                            <input required type="number" data-invalido="true" min=".01" step=".01" name="superficie" class="form-control" id="superficie" placeholder="Volumen" aria-invalid="false" readonly value="0">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="superunidades">Unidades</label>
                                            <select class="form-control" name="superunidades" id="superunidades" aria-invalid="false" data-invalido="true">                                                
                                                <option value="m&sup3;">m&sup3;</option>
                                            </select>
                                        </div>
                                    </div>  
                                    <div class="col-md-6 pull-right">
                                        
                                    </div>
                                
                                </div>
                               
                                <div id="contenedor">
                                       
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="subtotal">Subtotal</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input  type="text" min="1" name="subtotal" class="form-control" id="subtotal" aria-invalid="false" readonly value="0">
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="iva">IVA</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                                <input  type="text" min="1" name="iva" class="form-control" id="iva" aria-invalid="false" readonly value="{{$iva}}">
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="total">Total</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input  type="text" min="1" name="total" class="form-control" id="total" aria-invalid="false" readonly value="0">
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Datos del responsable de la obra</h3>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contacto">Nombre del Contacto</label>
                                            <input required type="text" name="contacto" class="form-control" id="contacto" placeholder="Nombre del Contacto"  minlength="1" maxlength="100" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telefono">Teléfono(Debe contener 10 dígitos)</label>
                                            <input required type="text" name="telefono" class="form-control" id="telefono" placeholder="Teléfono"  minlength="1" maxlength="50" aria-invalid="false" onkeyup="ValidarTelefonos();">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="celular">Celular(Debe contener 10 dígitos)</label>
                                            <input required type="text" name="celular" class="form-control" id="celular" placeholder="Celular"  minlength="1" maxlength="50" aria-invalid="false" onkeyup="ValidarTelefonos();">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="correo">Correo Contacto</label>
                                            <input required type="text" name="correo" class="form-control" id="correo" placeholder="Correo"  minlength="1" maxlength="100" aria-invalid="false" onkeyup="ValidarCorreos();">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="correo2">Correo Contacto</label>
                                            <input required type="text" name="correo2" class="form-control" id="correo2" placeholder="Correo"  minlength="1" maxlength="100" aria-invalid="false" onkeyup="ValidarCorreos();">
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
                                            <input type="checkbox" class="checkgrande" name="aplicaplan"  id="aplicaplan" aria-invalid="false" >
                                        </div>
                                        
                                    </div>

                                </div>


                                <div class="row">
                               
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contraramir">¿Requiere contrato RAMIR?</label><br>
                                            <input type="checkbox" class="checkgrande" name="contraramir"  id="contraramir" aria-invalid="false" >
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contrasindicato">¿Requiere contrato de transporte con sindicato?</label><br>
                                            <input type="checkbox" class="checkgrande" name="contrasindicato"  id="contrasindicato" aria-invalid="false" >
                                        </div>
                                        
                                    </div>
                                </div>

                               
                            </div>
                        </div>   
                        


                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Póliza de Responsabilidad Civil</h3>
                            </div>
                            <div class="card-body">
                                
                                <div class="row">
                               
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="polizarc">¿Requiera cotización de Póliza de Responsabilidad Civil?</label><br>
                                            <input type="checkbox" class="checkgrande" name="polizarc"  id="polizarc" aria-invalid="false" onchange="HabilitaValor(this);">
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="valorobra">Cuál es el valor de la obra?</label><br>
                                            <input data-invalido="true" disabled type="number" class="form-control" name="valorobra"  id="valorobra" aria-invalid="false" min="0" >
                                        </div>
                                        
                                    </div>
                                    @include('widgets.ModalAlerta')
                                </div>
                            </div>
                        </div> 
                        
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Unidad de Inspección Ambiental</h3>
                            </div>
                            <div class="card-body">

                                
                                
                                <div class="row">
                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <label for="uia">Unidad de Inspección Ambiental</label>
                                            <select  data-invalido="true" class="form-control" name="uia" id="uia" aria-invalid="false" >
                                                <option value="">--UIA--</option>
                                                @foreach($uias as $uia)
                                                <option value="{{$uia->id}}">{{$uia->uia}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        
                        
                        
                    </div>
                    <!--End body-->
                    </form>
                    <div class="card-footer" >
                        <button required type="submit" id="guardar" class="btn  btn-info float-right" onclick="GuardarObra(this);">Guardar</button>
                    </div>
                
            </div>
            <br>          
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
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);

 
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
<script>

    var markers = [];
    var marker;
    var geocoder;
    function initMap(zoom=4) {
        var initialLat = $('#latitud').val()*1;
        var initialLong = $('#longitud').val()*1;
        initialLat = initialLat?initialLat:{{GetLatMexico()}};
        initialLong = initialLong?initialLong:{{GetLonMexico()}};

        const myLatlng = { lat:  initialLat, lng:  initialLong };
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: zoom,
          center: myLatlng,
        });

        marker = new google.maps.Marker({
            map: map,
            draggable: true,
            position: myLatlng
        });
        
        markers.push(marker);
        
        geocoder = new google.maps.Geocoder();
        // Create the initial InfoWindow.
        let infoWindow = new google.maps.InfoWindow({
          content: "Seleccione ubicación de la obra",
          position: myLatlng,
        });

       
        infoWindow.open(map,marker);

        // Configure the click listener.
         
        map.addListener("click", (mapsMouseEvent) => {
            // Close the current InfoWindow.
            infoWindow.close();
            DeleteMarkers();
            // Create a new InfoWindow.
            infoWindow = new google.maps.InfoWindow({
              position: mapsMouseEvent.latLng,
            });
            var coordenadas=mapsMouseEvent.latLng.toJSON();
            $('#latitud').val(coordenadas.lat);
            $('#longitud').val(coordenadas.lng);
            const coorobra = { lat:  coordenadas.lat*1, lng: coordenadas.lng*1 };
            marker = new google.maps.Marker({
                position: coorobra,
                map,
                title:$('#obra').val()
            });
             //Add marker to the array.
            markers.push(marker);
            infoWindow.setContent('La obra se localiza:<br>Latitud:'+coordenadas.lat+'<br>Longitud:'+coordenadas.lng);
          
            infoWindow.open(map,marker);
          
        });
    }

$(document).ready(function () {
    //load google map
        
        /*
         * autocomplete location search
         */
        var PostCodeid = '#search_location';
        $(function () {
            $(PostCodeid).autocomplete({
                source: function (request, response) {
                    geocoder.geocode({
                        'address': request.term
                    }, function (results, status) {
                        response($.map(results, function (item) {
                            //console.log(results);
                            return {
                                label: item.formatted_address,
                                value: item.formatted_address,
                                lat: item.geometry.location.lat(),
                                lon: item.geometry.location.lng()
                            };
                        }));
                    });
                },
                select: function (event, ui) {
                    var direccionarray=ui.item.value.split(',');
                    //console.log('Calle: '+direccionarray[0]);
                   

                    
                    $('#latitud').val(ui.item.lat);
                    $('#longitud').val(ui.item.lon);
                    //var latlng = new google.maps.LatLng(ui.item.lat, ui.item.lon);
                    //marker.setPosition(latlng);
                    
                    initMap(16);
                }
            });
        });
        
        /*
         * Point location on google map
         
        $('.get_map').click(function (e) {
            var address = $(PostCodeid).val();
            geocoder.geocode({'address': address}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                    marker.setPosition(results[0].geometry.location);
                    $('.search_addr').val(results[0].formatted_address);
                   

                    $('.search_latitude').val(marker.getPosition().lat());
                    $('.search_longitude').val(marker.getPosition().lng());
                } else {
                    alert("Geocode was not successful for the following reason: " + status);
                }
            });
            e.preventDefault();
        });
    
        //Add listener to marker for reverse geocoding
        /*google.maps.event.addListener(marker, 'drag', function () {
            geocoder.geocode({'latLng': marker.getPosition()}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        $('.search_addr').val(results[0].formatted_address);
                        $('.search_latitude').val(marker.getPosition().lat());
                        $('.search_longitude').val(marker.getPosition().lng());
                    }
                }
            });
        });*/
    });


    

    function ValidarCorreos(){
        var correo=$('#correo');
        var correo2=$('#correo2');

        /*
        if(correo.val()==correo2.val())
        {            
           ParaTodo(correo,true);
           ParaTodo(correo2,true);
           return;
        }
*/
        
        if(correo.val().replaceAll(' ','').length==0 || correo2.val().replaceAll(' ','').length==0)
        {            
           ParaTodo(correo,true);
           ParaTodo(correo2,true);
           return;
        }

        if(!correo.val().includes('.') || !correo.val().includes('@') || !correo2.val().includes('.') || !correo2.val().includes('@'))
        {            
           ParaTodo(correo,true);
           ParaTodo(correo2,true);
           return;
        }



        ParaTodo(correo,false);
        ParaTodo(correo2,false);
    }


    function ValidarTelefonos(){
    var telefono=$('#telefono');
    var celular=$('#celular');

    if(telefono.val()==celular.val())
    {            
       ParaTodo(telefono,true);
       ParaTodo(celular,true);
       return;
    }

    
    if(telefono.val().replaceAll(' ','').length!=10 || celular.val().replaceAll(' ','').length!=10)
    {            
       ParaTodo(telefono,true);
       ParaTodo(celular,true);
       return;
    }

   


    ParaTodo(telefono,false);
    ParaTodo(celular,false);
}

    function ParaTodo(elemento,bandera){
        if(bandera){
            elemento.removeClass('is-valid');
            elemento.addClass('is-invalid');
            $('#guardar').hide();
        }else{
            elemento.removeClass('is-invalid');
            elemento.addClass('is-valid');
            $('#guardar').show();
        }
    }


    function HabilitaValor(_this){
        _this=$(_this);
        if(_this.is(':checked')){
            $('#valorobra').removeAttr('disabled');
            MostrarModalAlerta('Una póliza de responsabilidad civil para una obra es un tipo de seguro que brinda protección en caso de que se produzcan daños o lesiones a terceros durante la realización de una construcción, reforma o cualquier tipo de obra. Esta póliza cubre los gastos legales y las indemnizaciones que puedan surgir como resultado de reclamaciones de terceros por lesiones personales o daños a la propiedad causados por la obra. Al contratar esta póliza, el contratista o propietario de la obra se protege contra posibles reclamaciones y asegura que, en caso de ocurrir un accidente o un perjuicio a terceros, los costos asociados serán cubiertos por la compañía de seguros.');
        }else{
            $('#valorobra').attr('disabled','disabled');
            $('#valorobra').val('');
        }
    }

    
      
</script>

@include('MapsApi')


@include('footer')
</body>
</html>
