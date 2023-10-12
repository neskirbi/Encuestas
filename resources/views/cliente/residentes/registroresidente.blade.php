<!DOCrequired TYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>CSMX | Generadores</title>
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
                                    </div>
                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <label for="generador">Generador</label>
                                            <select class="form-control" name="generador" id="generador">
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
                                            <label for="obra">Nombre de la obra</label>
                                            <input required type="text" name="obra" class="form-control" id="obra" placeholder="Nombre de la obra" aria-invalid="false" >
                                        </div>
                                    </div>
                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <label for="tipoobra">Tipo de obra</label>
                                            <select class="form-control" name="tipoobra" id="tipoobra" onchange="SubTipoObra(this);">
                                                <option value="">--Tipo Obra--</option>
                                                @foreach($tipoobras as $tipoobra)
                                                <option value="{{$tipoobra->id}}">{{$tipoobra->tipoobra}}</option>
                                                @endforeach
                                            </select>
                                        </div>                                   
                                        
                                    </div>

                                    <!--<div class="col-md-3"> 
                                        <div class="form-group">
                                            <label for="subtipoobra">Subtipo de obra</label>
                                            <select class="form-control" name="subtipoobra" id="subtipoobra">
                                                
                                            </select>
                                        </div>                                   
                                        
                                    </div>-->
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="calle">Calle</label>
                                            <input required type="text" name="calle" class="form-control" id="calle" placeholder="Calle" aria-invalid="false" >
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="numeroext">Número Ext.</label>
                                            <input required type="text" name="numeroext" class="form-control" id="numeroext" placeholder="Número Ext." aria-invalid="false" >
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="numeroint">Número Int.</label>
                                            <input required type="text" name="numeroint" class="form-control" id="numeroint" placeholder="Número Int." aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="colonia">Colonia</label>
                                            <input required type="text" name="colonia" class="form-control" id="colonia" placeholder="Colonia" aria-invalid="false" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="municipio">Alcaldía/Municipio</label>
                                            <input required type="text" name="municipio" class="form-control" id="municipio" placeholder="Alcaldía/Municipio" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="entidad">Entidad federativa</label>
                                            <!--<input  type="text" name="entidad" class="form-control" id="entidad" placeholder="Entidad federativa" aria-invalid="false" >-->
                                            <select  name="entidad" class="form-control" id="entidad">
                                                <option value="">--Entidad Federativa--</option>
                                                <option value="Aguascalientes">Aguascalientes</option>
                                                <option value="Baja California">Baja California</option>
                                                <option value="Baja California Sur">Baja California Sur</option>
                                                <option value="Campeche">Campeche</option>
                                                <option value="Chiapas">Chiapas</option>
                                                <option value="Chihuahua">Chihuahua</option>
                                                <option value="CDMX">Ciudad de México</option>
                                                <option value="Coahuila">Coahuila</option>
                                                <option value="Colima">Colima</option>
                                                <option value="Durango">Durango</option>
                                                <option value="Estado de México">Estado de México</option>
                                                <option value="Guanajuato">Guanajuato</option>
                                                <option value="Guerrero">Guerrero</option>
                                                <option value="Hidalgo">Hidalgo</option>
                                                <option value="Jalisco">Jalisco</option>
                                                <option value="Michoacán">Michoacán</option>
                                                <option value="Morelos">Morelos</option>
                                                <option value="Nayarit">Nayarit</option>
                                                <option value="Nuevo León">Nuevo León</option>
                                                <option value="Oaxaca">Oaxaca</option>
                                                <option value="Puebla">Puebla</option>
                                                <option value="Querétaro">Querétaro</option>
                                                <option value="Quintana Roo">Quintana Roo</option>
                                                <option value="San Luis Potosí">San Luis Potosí</option>
                                                <option value="Sinaloa">Sinaloa</option>
                                                <option value="Sonora">Sonora</option>
                                                <option value="Tabasco">Tabasco</option>
                                                <option value="Tamaulipas">Tamaulipas</option>
                                                <option value="Tlaxcala">Tlaxcala</option>
                                                <option value="Veracruz">Veracruz</option>
                                                <option value="Yucatán">Yucatán</option>
                                                <option value="Zacatecas">Zacatecas</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cp">C.P.</label>
                                            <input required type="text" name="cp" class="form-control" id="cp" placeholder="C.P." aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-1">                                    
                                        <img src="images/iconos/mapa.png" height="55px" alt="" style="cursor:pointer;" onclick="AbrirModal('modalmapa');">
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="latitud">Latitud</label>
                                            <input required type="text" name="latitud" class="form-control" id="latitud" onclick="AbrirModal('modalmapa');" placeholder="Latitud" aria-invalid="false" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="longitud">Longitud</label>                                           
                                            <input required type="text" name="longitud" class="form-control" id="longitud" onclick="AbrirModal('modalmapa');" placeholder="Longitud" aria-invalid="false" readonly>
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
                                    <button type="button" class="btn bg-info btn-sm" onclick="MasMateriales();">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="superficie">Volumen</label>
                                        <input required type="number" min=".01" step=".01" name="superficie" class="form-control" id="superficie" placeholder="Volumen" aria-invalid="false" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="superunidades">Unidades</label>
                                        <select class="form-control" name="superunidades" id="superunidades">
                                            <option value="">--Unidades--</option> 
                                            <option value="m&sup3;">m&sup3;</option>
                                        </select>
                                    </div>
                                </div>  
                                <div class="col-md-6 pull-right">
                                    
                                </div>
                               
                            </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="categoria">Categoría</label>
                                            <select class="form-control" name="categoria[]" id="categoria0" onchange="GetMateriales(0);">
                                                <option value="">--Categoría--</option>
                                                @foreach($categorias as $categoria)
                                                <option value="{{$categoria->id}}">{{$categoria->categoriamaterial}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="material">Material</label>
                                            <select class="form-control" name="material[]" id="material0" onkeyup="CalcularCosto(0);" onchange="CalcularCostoPorMaterialObra(0);" disabled>                                               
                                            </select>
                                        </div>
                                    </div>  
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="cantidad">Cantidad</label>
                                            <input required type="number" min=".01" step=".01" name="cantidad[]" class="form-control" id="cantidad0" placeholder="Catidad" aria-invalid="false" onchange="CalcularCostoPorMaterialObra(0);">
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="costo">Costo</label>
                                            <input  type="number" min="1" name="costo" class="form-control" id="costo0" placeholder="Costo" aria-invalid="false" readonly >
                                        </div>
                                    </div>

                                    <!--<div class="col-md-2">
                                        <div class="form-group">
                                            <label for="unidades">Unidades</label>
                                            <select class="form-control" name="unidades[]" id="unidades0">
                                                <option value="">--Unidades--</option>                                                
                                                <option value="T">T</option>
                                                <option value="m&sup3;">m&sup3;</option>
                                            </select>
                                        </div>
                                    </div>-->                                    
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
                                            <label for="total">Total</label>
                                            <input  type="text" min="1" name="total" class="form-control" id="total" placeholder="Total" aria-invalid="false" readonly value="0">
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
                                            <label for="telefono">Teléfono</label>
                                            <input required type="text" name="telefono" class="form-control" id="telefono" placeholder="Teléfono" aria-invalid="false" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="celular">Celular</label>
                                            <input required type="text" name="celular" class="form-control" id="celular" placeholder="Celular" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="correo">Correo</label>
                                            <input required type="text" name="correo" class="form-control" id="correo" placeholder="Correo" aria-invalid="false" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="correo2">Correo 2</label>
                                            <input required type="text" name="correo2" class="form-control" id="correo2" placeholder="Correo" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="acepto">Acepto</label>
                                            <p style="color:#007ACC; cursor:pointer;" onclick="TerminosyCondiciones();">Términos y Condiciones</p>
                                            <input required type="checkbox" name="acepto"  id="acepto"aria-invalid="false" disabled>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>                

                        


                    </div><!--End body-->
                    <div class="modal-footer" >
                        
                    </div>
                </form>
                <div>
                    
                    <button required type="submit" id="guardar" class="btn  btn-info float-right" onclick="GuardarObra();">Guardar</button>
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
    function initMap() {
        const myLatlng = { lat:  20.248882446801847, lng: -101.45472227050904 };
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 4,
          center: myLatlng,
        });
        // Create the initial InfoWindow.
        let infoWindow = new google.maps.InfoWindow({
          content: "Seleccione ubicación de la obra",
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
            const coorobra = { lat:  coordenadas.lat*1, lng: coordenadas.lng*1 };
            const marker = new google.maps.Marker({
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
      
    </script>
    
@include('MapsApi')


</body>
</html>
