<!DOCTYPE html>
<html lang="en">
<head>
  @include('recepcion.header')
  <title>{{GetSiglas(0)}} | Citas</title>
</head>

<style>
        .contenido{
            padding: 5px;
            border-radius:5px;
            background-color:#e5e4e2;
        }

        .contenido2{
            padding: 5px;
        }

        .letra{
            font-size:13px;
        }

        .letra2{
            font-size:10px;
        }

        .fotos{
            width:300px; 
            border:1px #ccc solid;
            border-radius:5px; 
            padding:10PX;
        }
    </style>
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
      
        
        <div class="col-12">
            <div class="card">
                
              <!-- /.card-header -->
                <div class="card-body">
                    <div>
                        <img src="{{asset('images/logo.png')}}" height="50px" style="float: left;">
                        <img src="{{asset('images/logo2.jpg')}}" height="50px" style="float: right;">
                    </div>
                    <br><br><br><br>
                    <form method="post" action="{{ url('cita') }}/{{$cita->id}}" id="formcita">
                    @csrf
                    <input name="_method" type="hidden" value="PUT">
                    <div class="contenido letra" style=" float: right; margin-right:0px;">Fecha: {{FechaFormateada($cita->fechacita)}}</div>
                    <br><br>

                    <div class="contenido letra" style="float: left;  ">Planta de reciclaje:</div>
                    <div class="contenido2 letra2" style="float: left; ">{{$cita->planta}}</div>
                    <div class="contenido2 letra" style="float: right; ">{{$cita->plantaauto}}</div>
                    <div class="contenido letra" style="float: right; ">No. Autorización <br> Planta de reciclaje:</div>

                    <br><br><br>
                    <div class="contenido" style=" ">
                    <table width="100%">
                    <tr>
                    <td class="letra">No. de registro generador(Resolutivo de Impacto Ambiental, numero de registro):</td>
                    <td class="letra">{{$cita->nautorizacion}}</td>
                    </tr>
                    <tr>
                    <td class="letra">Razón social de la persona física o moral generadora:</td>
                    <td class="letra">{{$cita->razonsocial}}</td>
                    </tr>
                    
                    </table>
                    <br>
                    <table width="100%">
                        <tr>
                        <td colspan="4" class="letra">Domicilio fiscal generador:</td>
                        </tr>
                        <tr>
                        <td class="letra">Calle</td>
                        <td  class="letra">{{$cita->calleynumerofis}}</td>
                        <td class="letra">Colonia</td>
                        <td  class="letra">{{$cita->coloniafis}}</td>
                        </tr>
                        <tr>
                        <td class="letra">C.P.</td>
                        <td  class="letra">{{$cita->cpfis}}</td>
                        <td class="letra">Alcaldia/Municipio</td>
                        <td  class="letra">{{$cita->municipiofis}}</td>
                        </tr>
                    </table>
                    <br>

                    <table width="100%">
                        <tr>
                        <td colspan="4" class="letra">Domicilio del origen de los residuos:</td>
                        </tr>
                        <tr>
                        <td class="letra">Calle</td>
                        <td  class="letra">{{$cita->calleynumeroobr}}</td>
                        <td class="letra">Colonia</td>
                        <td  class="letra">{{$cita->coloniaobr}}</td>
                        </tr>
                        <tr>
                        <td class="letra">C.P.</td>
                        <td  class="letra">{{$cita->cpobr}}</td>
                        <td class="letra">Alcaldia/Municipio</td>
                        <td  class="letra">{{$cita->municipioobr}}</td>
                        </tr>
                    </table>       
                    </div>
                    <br>
                    
                    <div class="contenido letra" style=" ">
                        <table width="100%">
                            <tr>
                            <td >Tipo de vehículo</td>
                            <td >Marca y modelo</td>
                            <td >Matrícula</td>
                            </tr>
                            <tr>
                            <td style=" border-bottom-style: dotted ;">{{$cita->vehiculo}}</td>
                            <td style=" border-bottom-style: dotted ;">{{$cita->marcaymodelo}}</td>
                            <td style=" border-bottom-style: dotted ;">{{$cita->matricula}}</td>
                            </tr>
                            
                            <tr>
                            <td>Tarjeton RAMIR:</td>
                            <td colspan="2">{{$cita->ramir}}</td>
                            </tr>
                        </table>
                    
                    </div>

                    <br>
                    <div class="contenido" >
                        <table width="100%" style="text-align: center;">
                            <tr >
                            <td class="letra" style=" border-bottom-style: dotted ;">Tipo de residuo</td>
                            <td class="letra" style=" border-bottom-style: dotted ;">Unidad</td>
                            <td class="letra" style=" border-bottom-style: dotted ;">Cantidad</td>
                            <td class="letra" style=" border-bottom-style: dotted ;">Precio Unitario</td>
                            <td class="letra" style=" border-bottom-style: dotted ;">Total</td>
                            </tr>

                            <tr>
                            <td>
                            <div class="input-group">
                                <input type="text" class="form-control" id="materialtemp" name="materialtemp" value="{{$cita->material}}" readonly>
                                <input type="text" style="display:none;" data-invalido="true" class="form-control" id="material" name="material" value="" >
                                <div class="input-group-append" style="cursor:pointer;">
                                    <div class="dropdown">
                                        <button class="input-group-text dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-pencil-alt mr-1"></i></button>
                                    
                                        <div class="dropdown-menu" style="height:300px; overflow-y:scroll;" aria-labelledby="dropdownMenuButton">
                                            @foreach($materialesobra as $materialesobra)
                                            <a class="dropdown-item" href="#material" data-material="{{$materialesobra->id_material}}" data-precio="{{$materialesobra->precio}}" onclick="CambiaMaterial(this);">{{$materialesobra->material}}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                               
                               
                            </div>


                            </td>
                            <td class="letra">{{$cita->unidades}}</sup></td>
                            <td class="letra">
                            <div class="form-group">
                                <center><input required type="number" min="1" name="cantidad" style="width:60%;" class="form-control" onchange="CalcularCostorev();" id="cantidad" placeholder="Catidad" aria-invalid="false" value="{{$cita->cantidad}}"></center>
                            </div>
                            </td>
                            <td class="letra">
                            <div class="form-group">
                                <center><input required type="text" min="1" name="precio" style="width:30%;" class="form-control" onchange="CalcularCostorev();" id="precio" placeholder="Catidad" aria-invalid="false" value="{{$cita->precio}}" readonly></center>
                            </div></td>
                            </td>
                            <td class="letra">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="text" class="form-control" id="calculo" size="4" value="{{$cita->cantidad * $cita->precio }}" disabled>
                                    </div>
                                </div>
                            </td>
                            </tr>
                        
                        </table>
                    
                    </div>

                    <br>
                    
                    <div class="contenido" style=" ">
                        <table width="100%">
                            <tr>
                            <td >Condiciones de trasporte de los residuos</td>
                            
                            <td>{{$cita->condicionesmaterial}}</td>
                            </tr>
                        
                        </table>
                    
                    </div>

                    <br>
                    
                    <div class="contenido" style=" ">
                        <table width="100%">
                            <tr>
                            <td width="50%" style=" border-bottom-style: dotted ;"><center>Entregó los residuos</center></td>
                            <td  style=" border-bottom-style: dotted ;"><center>Recibió residuos</center></td>
                            </tr>

                            <tr>
                            <td ><center>{{$cita->nombrecompleto}}</center></td>
                            <td ><center>{{strlen($cita->recibio)==0 ? Auth::guard('recepciones')->user()->administrador : $cita->recibio }}</center></td>
                            </tr>

                            <tr> 
                            <td class="letra" style="text-align: justify;">Manifiesto bajo protesta de decir verdad que conozco del contenido y volumen de los residuos entregados a la planta de reciclaje y que estos vienen libres de cualquier residuo peligroso de otra índole no especificado en la presente nota.</td>
                            <td ><center>{{strlen($cita->cargo)==0 ? Auth::guard('recepciones')->user()->cargo : $cita->cargo }}</center></td>
                            </tr>
                        
                        </table>
                    
                    </div>

                    <br>
                    <div class="contenido" style=" height:100px;">
                        <table width="100%">
                            <tr>
                            <td style=" border-bottom-style: dotted ;">Observaciones</td>
                        
                            </tr>

                            <tr>
                                <td >        
                                    <div class="form-group">
                                        <textarea disabled data-invalido="true"  min="1" name="observacion" class="form-control" id="observacion" placeholder="Observaciones" aria-invalid="false" >{{$cita->observacion}}</textarea>
                                    </div>
                                    
                                </td>
                            </tr>

                        
                        </table>
                    
                    </div>
                    <br>
                    <div class="contenido" style="float: left">
                        <table width="70%">
                            <tr >
                            <td class="letra" style=" border-bottom-style: dotted ;">Dirección del establecimiento</td>
                            </tr>

                            <tr>
                            <td class="letra">{{$cita->direccionplanta}}</td>
                            </tr>
                        
                        </table>
                        
                    </div>
                    <img src="{{asset('images/qr/boleta/'.$cita->qr)}}" alt="" style="float: right;">  
                    <br><br><br><br><br><br><br><br><br><br>   
                
               

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-info">                    
                                <div class="card-header">
                                    <h3 class="card-title">Datos del Chofer</h3>
                                    
                                    
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">   
                                            <div class="form-group">
                                                <label for="nombrecompleto">RECIBÍ LOS RESIDUOS DESCRITOS EN EL MANIFIESTO PARA SU TRANSPORTE.</label>
                                                <input type="text" class="form-control" name="nombrecompleto" id="nombrecompleto" placeholder="Nombre Completo" value="{{$cita->nombrecompleto}}" >
                                            </div>

                                        </div>
                        
                        
                                        <div class="col-md-6">
                                            <div class="form-group">   
                                                <label for="firmares">Firma</label>
                                                <br>     
                                                @if($cita->firmachof!='')   
                                                <img src="{{$cita->firmachof}}" alt="" width="340px" height="200px" id="imgfirma" style="border:2px #7B7B7B solid; border-radius:5px;"> 
                                                <canvas  id="draw-canvas" width="340px" height="200px" style="display:none;"></canvas>          
                                                @else
                                                <canvas  id="draw-canvas" width="340px" height="200px"></canvas>                    
                                                @endif
                                                <textarea data-invalido="true" id="draw-dataUrl" class="form-control" rows="5" name="firmachof" style="display:none;">{{$cita->firmachof}}</textarea>
                                                <br>
                                                <button type="button" class="btn btn-default" id="draw-clearBtn">Limpiar</button> 
                                            </div>
                                        </div>   
                                    </div>
                                  
                                </div>
                            </div>
                        </div>
                    </div>       
                

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-info">                    
                                <div class="card-header">
                                    <h3 class="card-title">Fotos del Material</h3>
                                    <div class="card-tools">
                                    <i class="fa fa-question-circle" id="ayuda" aria-hidden="true" title="Copiar imagen y después presionar Ctrl+V para agregar imagen copiada."></i>
                                    </div>
                                    
                                </div>
                                <div class="card-body"></div>
                            </div>
                        </div>                    
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <center>
                                <div class="fotos" style="cursor:pointer; margin:20px;" onclick="TomarFoto('btnfoto0');">
                                    <?php $foto0='1';?>
                                    @if(file_exists(public_path('images/citas/foto0/'.$cita->id.'.jpg')))
                                    <i class="fa fa-times float-right" aria-hidden="true" style="display:; cursor:pointer; position:relative; right:10px;" id="borrar0" onclick="BorrarFoto(0);"></i>
                                    <img src="{{asset('images/citas/foto0/'.$cita->id.'.jpg')}}" alt=""  id="foto0" style="max-width:280px;"> 
                                    @elseif(file_exists(public_path('images/citas/foto0/'.$cita->id.'.png')))
                                    <i class="fa fa-times float-right" aria-hidden="true" style="display:; cursor:pointer; position:relative; right:10px;" id="borrar0" onclick="BorrarFoto(0);"></i>
                                    <img src="{{asset('images/citas/foto0/'.$cita->id.'.png')}}" alt=""  id="foto0" style="max-width:280px;"> 
                                    @else
                                    <?php $foto0='';?>
                                    <i class="fa fa-times float-right" aria-hidden="true" style="display:none; cursor:pointer; position:relative; right:10px;" id="borrar0" onclick="BorrarFoto(0);"></i>
                                    <img title="{{file_exists(asset('images/citas/foto0/'.$cita->id.'.jpg')).asset('images/citas/foto0/'.$cita->id.'.jpg')}}" src="{{asset('images/ayuda/ctrlv.png')}}" alt=""  id="foto0" style="max-width:280px;">  
                                    @endif 
                                </div>
                                <input data-invalido="true" type="file" id="btnfoto0" capture="camera" style="display:none;" onchange="PreView(this,0)">
                            </center>
                        </div>

                        <div class="col-md-6">
                            <center>
                                <div class="fotos" style="cursor:pointer; margin:20px;" onclick="TomarFoto('btnfoto1');">
                                    <?php $foto1='1';?>
                                    @if(file_exists(public_path('images/citas/foto1/'.$cita->id.'.jpg')))
                                    <i class="fa fa-times float-right" aria-hidden="true" style="display:; cursor:pointer; position:relative; right:10px;" id="borrar1" onclick="BorrarFoto(1);"></i>
                                    <img src="{{asset('images/citas/foto1/'.$cita->id.'.jpg')}}" alt=""  id="foto1" style="max-width:280px;">
                                    @elseif(file_exists(public_path('images/citas/foto1/'.$cita->id.'.png')))
                                    <i class="fa fa-times float-right" aria-hidden="true" style="display:; cursor:pointer; position:relative; right:10px;" id="borrar1" onclick="BorrarFoto(1);"></i>
                                    <img src="{{asset('images/citas/foto1/'.$cita->id.'.png')}}" alt=""  id="foto1" style="max-width:280px;">
                                    @else
                                    <?php $foto1='';?>
                                    <i class="fa fa-times float-right" aria-hidden="true" style="display:none; cursor:pointer; position:relative; right:10px;" id="borrar1" onclick="BorrarFoto(1);"></i>
                                    <img title="{{file_exists(asset('images/citas/foto0/'.$cita->id.'.jpg')).asset('images/citas/foto0/'.$cita->id.'.jpg')}}" src="{{asset('images/ayuda/ctrlv.png')}}" alt=""  id="foto1" style="max-width:280px;"> 
                                    @endif 
                                </div>
                                <input data-invalido="true" type="file" id="btnfoto1" capture="camera" style="display:none;" onchange="PreView(this,1)">
                            </center>
                        </div>
                    </div>
                    <input type="text" name="latitud" id="latitud" style="display:none;">
                    <input type="text" name="longitud" id="longitud" style="display:none;">
                    </form>
                </div>               
                
                
                
              <!-- /.card-body -->
            </div>
            <div class="card-footer">
                <div style="col-md-12">
                   
                    <button onclick="ValidarCita('{{$cita->id}}',this);" class="btn btn-success float-right" id="confirmar" style="display:none;" >{{ $cita->confirmacion=='1' ? 'Actualizar' : 'Confirmar'}}</button>
                    <div class="alert alert-danger alert-dismissible" id="advertencia">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i> Alerta!</h5>
                        Primero debes dar permiso de ubicación para poder validar.
                    </div>
                </div>
               
            </div>
            <!-- /.card -->
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

@include('recepcion.footer')
</body>

<script>
window.addEventListener("paste", PegarFoto);
var fotos=['{{$foto0}}','{{$foto1}}'];
var cambio=false;
function PegarFoto(e) {
    for(var j=0;j<fotos.length;j++){
        if(fotos[j]=='')
        for (var i = 0; i < e.clipboardData.items.length; i++) {
            // get the clipboard item
            // obtengo el clipboard item
            var clipboardItem = e.clipboardData.items[0];
            var type = clipboardItem.type;

            // verifico si es una imagen
            if (type.indexOf("image") != -1) {

                // obtengo el contenido de la imagen BLOB
                var blob = clipboardItem.getAsFile();
                //Pasando la imagen a base64 y poniendola en un arreglo para depues cargarla
                var reader = new window.FileReader();
                reader.readAsDataURL(blob);
                reader.onload = function(result) {
                    fotos[j]=reader.result;      
                    $('#foto'+j).attr("src",fotos[j]);
                    cambio=true;
                    $('#borrar'+j).show();
                }
                return;

            } else {
                alert("No es una imagen lo que intenta copiar.");
                return;
            }
        }
    }
}

function BorrarFoto(foto){
    $('#foto'+foto).attr("src","{{asset('images/ayuda/ctrlv.png')}}");
    $('#borrar'+foto).hide();
    cambio=true;
    fotos[foto]='';
}

$( function() {
    $( "#ayuda" ).tooltip();
  } );

  function TomarFoto(id){
      console.log(id);
      $('#'+id).click();
  }

  function PreView(_this,foto){
    var id='btnfoto'+id;
    console.log(id);
    var output = document.getElementById(id);
    //output.src = URL.createObjectURL(_this.files[0]);
    console.log(_this.files[0]);
    
    var reader = new FileReader();
    reader.readAsDataURL(_this.files[0]);
    reader.onload = function () {
        //console.log(reader.result);
        fotos[foto]=reader.result;      
        $('#foto'+foto).attr("src",fotos[foto]);
        cambio=true;
        $('#borrar'+foto).show();
    };
    reader.onerror = function (error) {
        console.log('Error: ', error);
    };

  }
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


function funcionInit(){
	if (!"geolocation" in navigator) {
		return alert("Tu navegador no soporta el acceso a la ubicación. Intenta con otro");
	}

	const onUbicacionConcedida = ubicacion => {
        $("#latitud").val(ubicacion.coords.latitude);
        $("#longitud").val(ubicacion.coords.longitude);
        $('#confirmar').show();
        $('#advertencia').hide();
		console.log(ubicacion.coords.latitude);
	}
  
	const onErrorDeUbicacion = err => {
		console.log("Error obteniendo ubicación: ", err);
	}

	const opcionesDeSolicitud = {
		enableHighAccuracy: true, // Alta precisión
		maximumAge: 0, // No queremos caché
		timeout: 5000 // Esperar solo 5 segundos
	};
	// Solicitar
	navigator.geolocation.getCurrentPosition(onUbicacionConcedida, onErrorDeUbicacion, opcionesDeSolicitud);

}

funcionInit();

</script>
</html>
