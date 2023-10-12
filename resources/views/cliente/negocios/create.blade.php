<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>CSMX | Registro negocio</title>
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
                    <h3 class="card-title"><i class="fa fa-industry" aria-hidden="true"></i> Registro de Establecimiento</h3>            
                </div>
                <!-- /.card-header -->
                    <form method="POST" action="{{url('negocios')}}" id="formnegocio" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="card-body">  

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Datos del Establecimiento</h3>
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
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="negocio">Nombre del Establecimiento</label>
                                            <input required type="text" name="negocio" class="form-control" id="negocio" placeholder="Nombre del Establecimiento" minlength="1" maxlength="500" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <label for="tiponegocio">Tipo de Establecimiento</label>
                                            <select class="form-control" name="tiponegocio" id="tiponegocio" aria-invalid="false">
                                                <option value="">--Tipo Establecimiento--</option>
                                                @foreach($tiponegocios as $tiponegocio)
                                                <option value="{{$tiponegocio->id}}">{{$tiponegocio->tiponegocio}}</option>
                                                @endforeach
                                            </select>
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
                                            <label for="municipio">Alcaldía/Municipio</label>
                                            <input required type="text" name="municipio" class="form-control" id="municipio" placeholder="Alcaldía/Municipio"  minlength="1" maxlength="150" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cp">C.P.</label>
                                            <input required type="text" name="cp" class="form-control" id="cp" placeholder="C.P."  minlength="1" maxlength="10" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class='row'>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="entidad">Entidad Federativa</label>
                                            <!--<input  type="text" name="entidad" class="form-control" id="entidad" placeholder="Entidad federativa" aria-invalid="false" >-->
                                            <select  name="entidad" class="form-control" id="entidad" aria-invalid="false" >
                                                <option value="">--Entidad Federativa--</option>
                                                @foreach($entidades as $entidad)
                                                <option value="{{$entidad->id}}">{{$entidad->entidad}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="planta">Prestador de Servicio</label>
                                            <select name="planta" id="planta" class="form-control">
                                                <option value="">---Prestador de Servicio---</option>
                                                @foreach($plantas as $planta)
                                                <option value="{{$planta->id}}">{{$planta->planta}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div calss="row">
                                    <div class="col-md-8">
                                        <label for="map">Ubicación del Establecimiento</label>
                                        <div id="map" style=" height: 350px; width:100%;"></div>
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
                                            <label for="fechainicio">Inicio de Contrato</label>                                           
                                            <input required type="date" name="fechainicio" class="form-control" id="fechainicio" aria-invalid="false">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fechafin">Fin de Contrato</label>                                           
                                            <input required type="date" name="fechafin" class="form-control" id="fechafin" aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       

                       
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Documentación</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            
                                            <label for="rfc">Plan de manejo(pdf)</label>
                                            <div class="input-group">
                                                <div class="custom-file">                                    
                                                    <input  type="file" class="custom-file-input" id="plan" name="plan">
                                                    <label class="custom-file-label" for="plan">Plan de manejo(pdf)</label>                                    
                                                </div>                      
                                            </div>
                                        </div>
                                    </div> 
                                </div>
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
                                            <label for="correo">Correo Contacto</label>
                                            <input required type="text" name="correo" class="form-control" id="correo" placeholder="Correo"  minlength="1" maxlength="100" aria-invalid="false" >
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telefono">Teléfono</label>
                                            <input required type="text" name="telefono" class="form-control" id="telefono" placeholder="Teléfono"  minlength="1" maxlength="50" aria-invalid="false" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="celular">Celular</label>
                                            <input required type="text" name="celular" class="form-control" id="celular" placeholder="Celular"  minlength="1" maxlength="50" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                               
                               
                            </div>
                        </div>                
                        
                        
                        
                    </div><!--End body-->
                    </form>
                    <div class="card-footer" >
                        <button required type="submit" id="guardar" class="btn  btn-info float-right" onclick="GuardarNegocio();">Guardar</button>
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
    var markers = [];
    function initMap() {
        const myLatlng = { lat:  20.248882446801847, lng: -101.45472227050904 };
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 4,
          center: myLatlng,
        });
        // Create the initial InfoWindow.
        let infoWindow = new google.maps.InfoWindow({
          content: "Seleccione ubicación",
          position: myLatlng,
        });
        infoWindow.open(map);
        // Configure the click listener.
         
        map.addListener("click", (mapsMouseEvent) => {
            // Close the current InfoWindow.
            infoWindow.close();
            DeleteMarkers()
            // Create a new InfoWindow.
            infoWindow = new google.maps.InfoWindow({
              position: mapsMouseEvent.latLng,
            });
            var coordenadas=mapsMouseEvent.latLng.toJSON();
            $('#latitud').val(coordenadas.lat);
            $('#longitud').val(coordenadas.lng);
            const coornegocio = { lat:  coordenadas.lat*1, lng: coordenadas.lng*1 };
            const marker = new google.maps.Marker({
            position: coornegocio,
            map,
            title:$('#negocio').val()
            });
             //Add marker to the array.
            markers.push(marker);
            infoWindow.setContent('La negocio se localiza:<br>Latitud:'+coordenadas.lat+'<br>Longitud:'+coordenadas.lng);
          
            infoWindow.open(map,marker);
          
        });
    }
      
</script>

@include('MapsApi')


@include('footer')
</body>
</html>
