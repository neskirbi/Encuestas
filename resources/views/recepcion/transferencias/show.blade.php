<!DOCTYPE html>
<html lang="en">
<head>
  @include('recepcion.header')
  <title>{{GetSiglas(0)}} | Salidas</title>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

  
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
        <div class="row" >
          <div class="col-md-12">
            
            @csrf
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Salida</h3>
              </div>
            
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="callout callout-success">
                      <h5>Información del Origen</h5>
                    </div>
                  </div>
                </div>

                <div class="row">
                    
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="id_origen">Origen</label>
                      <select disabled class="form-control" disabled name="id_origen" id="id_origen">
                        <option value="{{$origen->id}}">{{$origen->planta}}</option>
                       
                      </select>
                    </div>
                  </div>

                  
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="fechasalida">Fecha Salida</label>
                      <input disabled type="datetime-local" name="fechasalida" class="form-control" id="fechasalida" value="{{GetDateTimeNow()}}">
                    </div>                      
                  </div>

                </div>

                <div class="row">
                    
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="entrego">Entregó</label>
                      <input disabled type="text" name="entrego" class="form-control" id="entrego" placeholder="Entrega" maxlength="100" aria-invalid="false" value="{{$transferencia->entrego}}">
                    </div>
                  </div>

                  
                </div>

                <div class="row">

                  <div class="col-md-12">
                    <div class="form-group">
                      <textarea disabled  min="1" name="observacion_entrego" class="form-control" id="observacion_entrego" placeholder="Observaciones" aria-invalid="false" >{{$transferencia->observacion_entrego}}</textarea>
                    </div>
                  </div>   
                                
                  

                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="callout callout-success">
                      <h5>Información Transporte</h5>
                    </div>
                  </div>
                </div>

                


                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label for="chofer">Chofer</label>
                      <input disabled type="text" name="chofer" class="form-control" id="chofer" placeholder="Chofer" maxlength="100" aria-invalid="false" value="{{$transferencia->chofer}}">
                    </div>                      
                  </div>

                </div>


                <div class="row">    
                
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="vehiculo">Vehículo</label>
                      <input disabled type="text" name="vehiculo" class="form-control" id="vehiculo" placeholder="Vehículo" maxlength="250" aria-invalid="false" value="{{$transferencia->vehiculo}}">
                    </div>
                  </div>
                
                
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="marcaymodelo">Marca y Modelo</label>
                      <input disabled type="text" name="marcaymodelo" class="form-control" id="marcaymodelo" placeholder="Marca y Modelo" maxlength="100" aria-invalid="false" value="{{$transferencia->marcaymodelo}}">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="matricula">Matrícula</label>
                      <input disabled type="text" name="matricula" class="form-control" id="matricula" placeholder="Matricula" maxlength="100" aria-invalid="false" value="{{$transferencia->matricula}}">
                    </div>                      
                  </div>
                </div>

      
                <div class="row">
                  <div class="col-md-12">
                    <div class="callout callout-success">
                      <h5>Información Material</h5>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="material">Material</label>
                      <select disabled class="form-control" disabled name="material" id="material">                        
                        <option value="{{$material->id}}">{{$material->categoria.' '.$material->material}}</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <label for="cantidad_envio">Cantidad</label>
                    <div class="input-group mb-3">
                      <input disabled type="text" name="cantidad_envio" class="form-control" id="cantidad_envio" placeholder="Cantidad" maxlength="100" aria-invalid="false" value="{{$transferencia->cantidad_envio}}">
                    
                      <div class="input-group-append">
                        <span class="input-group-text">m<sup>3</sup></span>
                      </div>
                    </div>
                                         
                  </div>
                  
                </div>


                <div class="row">
                  <div class="col-md-12">
                    <div class="callout callout-success">
                      <h5>Información del Destino</h5>
                    </div>
                  </div>
                </div>

                <div class="row">
                    
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="id_destino">Destino</label>
                      <select disabled class="form-control" disabled name="id_destino" id="id_destino">                        
                        <option value="{{$destino->id}}">{{$destino->planta}}</option>                        
                      </select>
                    </div>
                  </div>

                  
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="fecha_recibio">Fecha Entrega</label>
                      <input disabled type="datetime-local" name="fecha_recibio" class="form-control" id="fecha_recibio" value="{{$transferencia->fecha_recibio==$transferencia->fecha_entrego ? GetDateTimeNow() : $transferencia->fecha_recibio}}">
                    </div>                      
                  </div>

                </div>

                <div class="row">
                    
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="recibio">Recibio</label>
                      <input disabled type="text" name="recibio" class="form-control" id="recibio" placeholder="Recibio" maxlength="100" aria-invalid="false" value="{{$transferencia->recibio=='' ? GetNombre() : $transferencia->recibio}}">
                    </div>
                  </div>

                  
                </div>

                <div class="row">

                 
                                
                  <!--<div class="col-md-6">
                      <div class="form-group">   
                          <label for="firmares">Firma</label>
                          <br>                               
                          <canvas  id="draw-canvas" width="340px" height="200px"></canvas>    
                          <textarea data-invalido="true" id="draw-dataUrl" class="form-control" rows="5" name="firmares" style="display:none;"></textarea>
                          <br>
                          <button type="button" class="btn btn-default" id="draw-clearBtn">Limpiar</button> 
                      </div>
                  </div>   -->

                </div>


                
                
              </div> 
              <div class="card-footer">
                @if($transferencia->id_destino==GetIdPlanta())
                <a href="{{url('transferencias_confirmar/'.$transferencia->id)}}" type="submit" class="btn  btn-info float-right">{{$transferencia->confirmacion==0 ? 'Confirmar' : 'Guardar'}}</a> 
                @endif
              </div> 
             
              
              
            </div>
          </div>
        </div>       
      </div>
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
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
<script>
(function() { // Comenzamos una funcion auto-ejecutable

    // Obtenenemos un intervalo regular(Tiempo) en la pamtalla
  window.requestAnimFrame = (function (callback) {
    return window.requestAnimationFrame ||
    window.webkitRequestAnimationFrame ||
    window.mozRequestAnimationFrame ||
    window.oRequestAnimationFrame ||
    window.msRequestAnimaitonFrame ||
    function (callback) {
      window.setTimeout(callback, 1000/60);
      // Retrasa la ejecucion de la funcion para mejorar la experiencia
    };
  })();

  // Traemos el canvas mediante el id del elemento html
  var canvas = document.getElementById("draw-canvas");
  var ctx = canvas.getContext("2d");


  // Mandamos llamar a los Elemetos interactivos de la Interfaz HTML
  var drawText = document.getElementById("draw-dataUrl");
  var clearBtn = document.getElementById("draw-clearBtn");
  //var submitBtn = document.getElementById("draw-submitBtn");
  clearBtn.addEventListener("click", function (e) {
    // Definimos que pasa cuando el boton draw-clearBtn es pulsado
    clearCanvas();
  }, false);

  // Definimos que pasa cuando el boton draw-submitBtn es pulsado
  /*submitBtn.addEventListener("click", function (e) {
    var dataUrl = canvas.toDataURL();
    drawText.innerHTML = dataUrl;
    GuardarFirma();
  }, false);*/

  // Activamos MouseEvent para nuestra pagina
  var drawing = false;
  var mousePos = { x:0, y:0 };
  var lastPos = mousePos;
  canvas.addEventListener("mousedown", function (e){
    /*
      Mas alla de solo llamar a una funcion, usamos function (e){...}
      para mas versatilidad cuando ocurre un evento
    */
    var tint = '#000000';
    
    console.log(tint);
    var punta = 3;
    console.log(e);
    drawing = true;
    lastPos = getMousePos(canvas, e);
    
  }, false);
  canvas.addEventListener("mouseup", function (e){
      drawing = false;
      
    var dataUrl = canvas.toDataURL();
    drawText.innerHTML = dataUrl;
  }, false);
  canvas.addEventListener("mousemove", function (e){
      mousePos = getMousePos(canvas, e);
  }, false);

  // Activamos touchEvent para nuestra pagina
  canvas.addEventListener("touchstart", function (e){
    mousePos = getTouchPos(canvas, e);
    e.preventDefault(); 
    // Prevent scrolling when touching the canvas
    var touch = e.touches[0];
    var mouseEvent = new MouseEvent("mousedown", {
        clientX: touch.clientX,
        clientY: touch.clientY
    });
    canvas.dispatchEvent(mouseEvent);
  }, false);

  canvas.addEventListener("touchend", function (e) {
    e.preventDefault(); // Prevent scrolling when touching the canvas
    var mouseEvent = new MouseEvent("mouseup", {});
    canvas.dispatchEvent(mouseEvent);
  }, false);

  canvas.addEventListener("touchleave", function (e) {
    // Realiza el mismo proceso que touchend en caso de que el dedo se deslice fuera del canvas
    e.preventDefault(); // Prevent scrolling when touching the canvas
    var mouseEvent = new MouseEvent("mouseup", {});
    canvas.dispatchEvent(mouseEvent);
  }, false);

  canvas.addEventListener("touchmove", function (e) {
    e.preventDefault(); // Prevent scrolling when touching the canvas
    var touch = e.touches[0];
    var mouseEvent = new MouseEvent("mousemove", {
        clientX: touch.clientX,
        clientY: touch.clientY
    });  
    canvas.dispatchEvent(mouseEvent);
  }, false);

  // Get the position of the mouse relative to the canvas
  function getMousePos(canvasDom, mouseEvent) {
    var rect = canvasDom.getBoundingClientRect();
    /*
      Devuelve el tamaño de un elemento y su posición relativa respecto
      a la ventana de visualización (viewport).
    */
    return {
        x: mouseEvent.clientX - rect.left,
        y: mouseEvent.clientY - rect.top
    };
  }

  // Get the position of a touch relative to the canvas
  function getTouchPos(canvasDom, touchEvent) {
    var rect = canvasDom.getBoundingClientRect();
    console.log(touchEvent);
    /*
    Devuelve el tamaño de un elemento y su posición relativa respecto
    a la ventana de visualización (viewport).
    */
    return {
        x: touchEvent.touches[0].clientX - rect.left, // Popiedad de todo evento Touch
        y: touchEvent.touches[0].clientY - rect.top
    };
  }

  // Draw to the canvas
  function renderCanvas() {
    if (drawing) {
      var tint = '#000000';
      var punta = 3;
      ctx.strokeStyle = tint;
      ctx.beginPath();
      ctx.moveTo(lastPos.x, lastPos.y);
      ctx.lineTo(mousePos.x, mousePos.y);
      //Tamaño del puntero
      ctx.lineWidth = punta;
      ctx.stroke();
      ctx.closePath();
      lastPos = mousePos;
    }
  }

  function clearCanvas() {
        canvas.width = canvas.width;      
        drawText.innerHTML = '';
        $('#draw-canvas').show();
        $('#imgfirma').hide();
  }

  // Allow for animation
  (function drawLoop () {
    requestAnimFrame(drawLoop);
    renderCanvas();
  })();

})();

</script>

</body>
</html>
