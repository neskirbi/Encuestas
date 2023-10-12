<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>{{GetSiglas(0)}} | Citas</title>
  <style>

    #draw-canvas {
      border: 2px solid #CCCCCC;
      border-radius: 5px;
      cursor: crosshair;
    }

  </style>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<link rel="stylesheet" href="calendario/css/styles.css">
<div class="wrapper">

  <!-- Navbar -->
  @if(Auth::guard('clientes')->check())
    @include('cliente.navigations.navigation')  
  @endif

  @if(Auth::guard('residentes')->check())
    @include('residentes.navigations.navigation')  
  @endif
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @if(Auth::guard('clientes')->check())
    @include('cliente.sidebars.sidebar') 
  @endif

  @if(Auth::guard('residentes')->check())
    @include('residentes.sidebars.sidebar') 
  @endif

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
     
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      

      <!--Banner Publicidad-->
        <div class="row" >
          <div class="col-md-12">
            @if(isset($bannercitas->id))
            <!--
              <center>
              <a href="{{$bannercitas->enlace}}" target="_blank">
                <img src="{{asset('images/banners/citas/').'/'.$bannercitas->nombre}}" width="100%" alt="">
              </a>              
              </center>
              <br>
  -->
            @endif
          </div>
        </div>

       

        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fa fa-recycle" aria-hidden="true"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Reciclaje</span>
                <span class="info-box-number">Reservar Citas</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-1"></div>
          <!--<div class="col-12 col-sm-6 col-md-3" style="cursor:pointer; " onclick="VistasCitas('recoleccion');">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-truck"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Recolección</span>
                <span class="info-box-number">Reservar Citas</span>
              </div>
            </div>
          </div>-->

          <div class="col-12 col-sm-6 col-md-1"></div>
          <div class="col-12 col-sm-6 col-md-3" style="cursor:pointer; display:none;" onclick="VistasCitas('concreto');">
            <div class="info-box">
              <span class="info-box-icon bg-default elevation-1"><i class="fas fa-bus"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Concreto</span>
                <span class="info-box-number">Reservar Citas</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
        
        <div class="row" style="display:visile;">          
          <div class="col-md-12">
            <form method="post" action="citareciclaje">
            @csrf
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title" id="titulo"> 
                  <i class="fa fa-recycle"></i>
                   Reciclaje
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="obra">Obra</label>
                        <select required type="text" name="obra" class="form-control" id="obra" aria-invalid="false" onchange="MaterialesObra();PonPlanta(this);">
                        <option value="">--Seleccionar obra--</option>
                        <?php $pospago=0;?>
                        @foreach($obras as $obra)
                        <option value="{{$obra->id}}" title="{{$obra->obra}}" data-planta="{{$obra->planta}}">{{$obra->obra}}</option>
                        <?php if($obra->puedepospago==1){$pospago=1;}?>
                        @endforeach
                        </select>
                    </div>
                  </div>
                  
                  

                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="bmatricula">Buscar Vehículo (Placa)</label>
                        <input required autocomplete="off" onkeyup="BuscarPlaca(this);" type="text" class="form-control" id="bmatricula" placeholder="Buscar Matrícula" aria-invalid="false" >
                        <div id="ramir" style="font-size:14px; color:#ff0000;"></div>
                        
                        <div class="dropdown">
                            <div class="dropdown-menu" id="menu" aria-labelledby="dropdownMenuButton">                                
                            </div>
                        </div>
                        <input type="text" style="display:none;" name="vehiculo" class="form-control" id="vehiculo" aria-invalid="false" >
                    </div>
                  </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="bmatricula">Destino</label>
                        <input style="color:#f00;" disabled type="text" class="form-control" id="destino" placeholder="Destino" aria-invalid="false" >                        
                      </div>
                    </div>
                  </div>

                

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group" id="rowmaterial">
                        <label for="material">Material&nbsp;&nbsp;&nbsp;</label> <div style="float:right;">(Todos <input type="checkbox" id="todos" onchange="MaterialesObra();"> )</div> 
                        <select required type="text" name="material" class="form-control" id="material" aria-invalid="false" >
                        <option value="" data-precio="0">--Material--</option>                        
                        </select>
                    </div>

                    
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="nombres">Cantidad m<sup>3</sup></label>
                        <input required type="number" min="1" step="{{$pospago==1 ? '0.1' : '1'}}" name="cantidad" class="form-control" id="cantidad" placeholder="Catidad" aria-invalid="false" onkeyup="PuedeGastar();" >
                    </div>
                  </div>

                  <div class="col-md-4">                   
                    <div class="form-group" >
                        <label for="condicionmaterial">Condiciones de transporte del residuo</label>
                        <select required type="text" name="condicionmaterial" class="form-control" id="condicionmaterial" aria-invalid="false" >
                        <option value="">--Seleccionar--</option>
                        @foreach($condicionmateriales as $condicionmaterial)
                        <option value="{{$condicionmaterial->id}}">{{$condicionmaterial->condicion}}</option>
                        @endforeach                       
                        </select>
                    </div>
                  </div>

                </div>
                
                
          

                <div class="row">
                  <div class="col-md-7">
                    <div class="calendar">
                      <div class="calendar__info">
                        <div class="btn btn-block btn-outline-primary calendar__prev" id="prev-month"><i class="fas fa-arrow-left"></i></div>
                        <div class="calendar__month" id="month"></div>
                        <div class="calendar__year" id="year"></div>
                        <div class="btn btn-block btn-outline-primary calendar__next" id="next-month"><i class="fas fa-arrow-right"></i></div>
                      </div>

                      <div class="calendar__week">
                        <div class="calendar__day">Lunes</div>
                        <div class="calendar__day">Martes</div>
                        <div class="calendar__day">Miercoles</div>
                        <div class="calendar__day">Jueves</div>
                        <div class="calendar__day">Viernes</div>
                        <div class="calendar__day">Sabado</div>
                        <div class="calendar__day">Domingo</div>
                      </div>

                      <div class="calendar__dates" id="dates"></div>
                    </div>
                    
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                        <label>Horarios</label>
                        <select required multiple="" style="height:300px;" class="form-control" name="horacita" class="form-control" id="horacita"  aria-invalid="false"></select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <input required type="text" style="display:none;" name="fechacita" class="form-control" id="fechacita"  aria-invalid="false" >
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-7">
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">   
                      <label for="firmares">Firma</label> 
                      <br>  
                      @if(Auth::guard('residentes')->check() && $residente->firma!='')
                      <img src="{{$residente->firma}}" alt="" width="340px" height="200px" id="imgfirma"> 
                      <canvas  id="draw-canvas" width="340px" height="200px" style="display:none;"></canvas>
                      <textarea id="draw-dataUrl" class="form-control" rows="5" name="firmares" style="display:none;">{{$residente->firma}}</textarea>          
                      @else
                      <canvas  id="draw-canvas" width="340px" height="200px"></canvas>
                      <textarea id="draw-dataUrl" class="form-control" rows="5" name="firmares" style="display:none;"></textarea>                     
                      @endif                    
                      <br>
                      <span><b>{{$nombre}}</b></span>
                      <br>
                      <button type="button" class="btn btn-default" id="draw-clearBtn">Limpiar</button> 
                    </div>
                  </div>
                                        
                </div>
                <div class="row">
                  <div class="col-md-12">
                  </div>
                </div>  
                
              </div>
              <div class="card-footer">
                <!--Este es el boton de el formulario de las citas-->
                <button type="submit" id="guardar" style="display:none;" class="btn btn-primary">Guardar</button> 
                <!--Este boton guarda la firma primero y despues preciona el boton de submite de la cita--> 
                <div class="alert alert-danger" role="alert" id="alerta" style="display:none;">
                  ¡No cuenta con saldo suficiente!
                </div>              
                <button type="button" id="draw-submitBtn" class="btn btn-primary" id="guardar">Guardar</button>
              </div>
              </form>                
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

<script src="calendario/js/scripts.js?ver=<?php echo Version();?>"></script>
@include('generales.citas.modals.modalvehiculo')
@include('footer')
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
    $('#guardar').click();
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

function PuedeGastar(){
  var id_obra=$('#obra').val();
  var id_material=$('#material').val();
  var cantidad=$('#cantidad').val();
  //console.log(id_obra+'  '+id_material+'  '+cantidad);
  
  $.ajax({
            
    headers: { "APP-KEY": AppKey() },
    method:'post',
    url: Url()+"api/PuedeGastar",
    data:{id_obra:id_obra,id_material:id_material,cantidad:cantidad},
    context: document.body
    }).done(function(data) {
      console.log(data);
      
    if(parseInt(data.response)==0){
      $('#alerta').html(data.msn);
      $('#alerta').show();
      $('#draw-submitBtn').hide();
    }else if(parseInt(data.response)==1){
      $('#draw-submitBtn').show();
      $('#alerta').hide();
    }
    
  });
}


$(document).ready(function(){
  $("#bmatricula").on('paste', function(e){
    e.preventDefault();
    alert('Esta acción está prohibida.');
  })
  
  $("#bmatricula").on('copy', function(e){
    e.preventDefault();
    alert('Esta acción está prohibida.');
  })
});

function PonPlanta(_this){
  _this=$(_this);
  var planta=_this.children("option").filter(":selected").data('planta');
  $('#destino').val(planta);
}

</script>

</body>
</html>
