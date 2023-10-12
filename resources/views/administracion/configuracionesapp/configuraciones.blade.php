<!DOCTYPE html>
<html lang="en">
<head>
  @include('administracion.header')
  <title>CSMX | Configuración</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('administracion.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
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
          <div class="col-md-3">
            <div class="card card-danger card-outline">
              <div class="card-header">
              <h3 class="card-title">Configuraciones App</h3>

              
              </div>
              <div class="card-body p-0">
                  <input type="hidden" name="id_planta" id="id_planta" value="{{Auth::guard('administradores')->user()->id_planta}}">
                  <ul class="nav nav-pills flex-column">                 

                  <li class="nav-item ">
                        <a class="nav-link active show" onclick="VentanasTitulos(this);" data-text="Recompensa"  data-toggle="pill" href="#recompensa" role="tab">
                            <i class="fa fa-dollar" aria-hidden="true"></i> Recompensa
                            <!--<span class="badge bg-primary float-right">12</span>-->
                        </a>
                    </li>
                    
                  </ul>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <div class="col-md-9">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title" id="titulo">Recompensa</h3>
              </div>
              <div class="card-body">
                <div class="col-md-12">                   
                    <div class="row">
                        
                      <div class="tab-content" id="custom-tabs-four-tabContent" style="width:100%;"> 

                          <div class="tab-pane fade active show" id="validacion" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                              <form action="{{url('ConfiguracionRecompensa')}}" method="post" id="validacionform">
                                @csrf
                                  <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="tiempo">Precio/m<sup>3</sup></label>
                                            <div class="input-group mb-3">
                                              <input require type="number" min="0" step="0.01" class="form-control" id="recompensa" name="recompensa" value="{{$planta->recompensa}}">
                                              <div class="input-group-append">
                                              <span class="input-group-text"><i class="fa fa-dollar" aria-hidden="true"></i></span>
                                              </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                  </div>                                                                      
                              </form>
                              <button class="btn btn-info float-right" onclick="Submite('validacionform',this);" data-texto="¿Guardar los datos ?">Guardar</button>
                          </div>


                        </div>
                      </div>           
                        
                    </div>
                
                </div>
                
              </div>
              <!-- /.card-body -->
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
<script src="dist/js/adminlte.js"></script>

@include('administracion.footer')

<script>
  var si=0;
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
  var submitBtn = document.getElementById("draw-submitBtn");
  
  clearBtn.addEventListener("click", function (e) {
    // Definimos que pasa cuando el boton draw-clearBtn es pulsado
    clearCanvas();
  }, false);

  // Definimos que pasa cuando el boton draw-submitBtn es pulsado
  submitBtn.addEventListener("click", function (e) {
    var dataUrl = canvas.toDataURL();
    if(si)
      drawText.innerHTML = dataUrl;
    Submite('cuentaform',this);
  }, false);

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
    si=1;
    var punta = 3;
    console.log(e);
    drawing = true;
    lastPos = getMousePos(canvas, e);
  }, false);
  canvas.addEventListener("mouseup", function (e){
      drawing = false;
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
    si=0;
    $('#draw-canvas').show();
    $('#imgfirma').hide();
    drawText.innerHTML = '';
    canvas.width = canvas.width;
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
