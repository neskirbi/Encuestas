<!DOCTYPE html>
<html lang="en">
<head>
  @include('publicidad.header')
  
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css');}}">
  <title>{{GetSiglas(0)}} | Publicidad</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('publicidad.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('publicidad.sidebars.sidebar')

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
            <div class="card">
              <div class="card-header">
                <div class="card-title">Banner Citas</div>
              </div>
              <div class="card-body">
                <div class="row" >
                  <div class="col-md-12">
                    <center>
                      @if(isset($bannercitas->id))
                      <p>Enlace: {{$bannercitas->enlace}}</p>
                      <img src="{{asset('images/banners/citas/').'/'.$bannercitas->nombre}}" width="100%" alt="">
                      @else
                      <img src="{{asset('images/banners/citas/bannercitas.png')}}" width="100%" alt="">
                      @endif
                    </center>
                  </div>
                </div>
                <hr>
                <form action="{{url('CargarBCitas')}}" enctype="multipart/form-data" method="post">
                  @csrf
                <div class="row" >
                  <div class="col-md-12">
                    <div class="form-group">
                      <input required type="text" class="form-control" id="enlace" name="enlace" placeholder="Enlace">
                    </div>
                            
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                  <div class="input-group">
                    <div class="custom-file">
                      <input required type="file" class="custom-file-input" id="bannercitas" name="bannercitas">
                      <label class="custom-file-label" for="exampleInputFile">Cambiar Banner</label>
                      </div>
                      
                    </div>
                                        
                  </div>

                  <div class="col-md-6">
                  
                  </div>
                
                  <div class="col-md-2">
                    <button class="btn btn-primary btn-block">Cargar</button>
                  </div>
                </div>
                </form>
                
              </div>
              <div class="card-footer"></div>
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
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js');}}"></script>

<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});


function readURL(input) {
  console.log('Corriendo');
  if (input.files && input.files[0]) { //Revisamos que el input tenga contenido
    var reader = new FileReader(); //Leemos el contenido
    
    reader.onload = function(e) { //Al cargar el contenido lo pasamos como atributo de la imagen de arriba
      

      console.log("imagen:"+$('#background').length);
      if(!$('#background').length){
        var contenido='<center><img src="" alt="" id="background" width="100%" style="vertical-align: middle;"></center>';
        $("#contenedor").append(contenido);
        $('#background').attr('src', e.target.result);
      }else{
        $('#background').attr('src', e.target.result);
      }
      
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}

$("#fondo").change(function() { //Cuando el input cambie (se cargue un nuevo archivo) se va a ejecutar de nuevo el cambio de imagen y se verá reflejado.
  readURL(this);
});


function GenerarContenido(){
  _este=$('#contenido');
  
  
  console.log("body:"+$('#body').length);
  if(!$('#body').length){
    var contenido='<span style="background-color:#fff; border:1px #8B9195 solid; border-radius:3px; position:absolute;  left:550; margin-left:auto; margin-right:auto; top:'+$('#top').val()+'px; padding:'+$('#padding').val()+'px;" id="body">'+_este.val()+'</span>';
    $("#contenedor").append(contenido);
  }else{
    $("#body").html(_este.val());
    $("#body").css( 'top',$('#top').val()+'px');
    $("#body").css( 'padding',$('#padding').val()+'px');
    
    $("#body").css( 'position','absolute');

  }

}

function MuestaSus(_this){
  _este=$('#tipo option:selected');
  if(_este.data('tag').length!=0){
    $('#tag').html('Poner esta etiqueta para en nombre del '+_este.data('nombre')+': '+_este.data('tag'));
  }else{
    $('#tag').html('');
  }
  
}

$(function () {
    // Summernote
    $('#summernote').summernote({
      height: 300     
   });

    // 
  })
</script>

@include('transportistas.footer')
</body>
</html>
