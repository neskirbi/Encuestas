<!DOCTYPE html>
<html lang="en">
<head>
  @include('administracion.header')
  <title>CSMX | Agregar</title>

  
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
        <div class="row" >
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Cargar Fotos</h3>
                    </div>
                    <div class="card-body">
                        <input type="text" id="id" class="form-control" value="{{$id}}" style="display:none;">                      
                        <div class="row" id="formulario" style='display:;'>
                            <div class="col-md-12">                                
                                <b>Portada</b>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <center>
                                            <div style="border:solid #ccc 1px; border-radius:5px; padding:5px; min-width:100px; max-width:200px; min-height:100px; cursor:pointer; position:relative;">
                                            @if(isset($fotos[0]))
                                                <i class="fa fa-times float-right" aria-hidden="true" style="cursor:pointer;" id="borrar0" onclick="BorrarProductoFoto(0);"></i>
                                                <img src="{{$fotos[0]}}" height="100px" alt="" id="imagen0">
                                                <img src="https://cdn.pixabay.com/photo/2017/01/25/17/35/picture-2008484_960_720.png" style="display:none;" height="100px" alt="" id="imagent0" onclick="Click('foto0');">
                                            @else
                                            
                                                <i class="fa fa-times float-right" aria-hidden="true" style="display:none; cursor:pointer;" id="borrar0" onclick="BorrarProductoFoto(0);"></i>
                                                <img src="" height="100px" style="display:none;" id="imagen0">
                                                <img src="https://cdn.pixabay.com/photo/2017/01/25/17/35/picture-2008484_960_720.png" height="100px" alt="" id="imagent0" onclick="Click('foto0');">
                                            @endif
                                            </div>
                                            <input type="file" style="display:none;" id="foto0" onchange="MuestraImagen(this,0);">
                                        </center>
                                        
                                    </div>
                                </div>
                                <b>Fotos</b>
                                <hr>
                                <div class="row">
                                    @for($i=1;$i<5;$i++)
                                    <div class="col-md-3">
                                        <center>
                                        <div style="border:solid #ccc 1px; border-radius:5px; padding:5px; min-width:100px; max-width:200px; min-height:100px; cursor:pointer; position:relative;">
                                        @if(isset($fotos[$i]))
                                            <i class="fa fa-times float-right" aria-hidden="true" style="cursor:pointer;" id="borrar{{$i}}" onclick="BorrarProductoFoto({{$i}});"></i>
                                            <img src="{{$fotos[$i]}}" height="100px" alt="" id="imagen{{$i}}">
                                            <img src="https://cdn.pixabay.com/photo/2017/01/25/17/35/picture-2008484_960_720.png" style="display:none;" height="100px" alt="" id="imagent{{$i}}" onclick="Click('foto'+{{$i}});">
                                        @else
                                            <i class="fa fa-times float-right" aria-hidden="true" style="display:none; cursor:pointer;" id="borrar{{$i}}" onclick="BorrarProductoFoto({{$i}});"></i>
                                            <img src="" height="100px" style="display:none;" id="imagen{{$i}}">
                                            <img src="https://cdn.pixabay.com/photo/2017/01/25/17/35/picture-2008484_960_720.png" height="100px" alt="" id="imagent{{$i}}" onclick="Click('foto'+{{$i}});">
                                        @endif
                                        </div>
                                        <input type="file" style="display:none;" id="foto{{$i}}" onchange="MuestraImagen(this,{{$i}});">                                        
                                        </center>
                                    </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-info float-right" href="{{$_SERVER['HTTP_REFERER']}}">Finalizar</a>
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
        <div class="d-none d-sm-inline-block">
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

    <script>
      function Click(inputfile){
            $('#'+inputfile).click();
        }

        function MuestraImagen(_this,orden) {
            var file = _this.files[0];
            var reader = new FileReader();
            reader.onloadend = function() {
                $('#imagent'+orden).hide();
                $('#imagen'+orden).show();
                $('#imagen'+orden).attr('src',reader.result);
                $('#borrar'+orden).show();
                CargarFoto(orden,reader.result);
            }
            reader.readAsDataURL(file);
        }

        function CargarFoto(orden,base64){
            var id=$('#id').val();
            if(base64!=''){
                var fotopart=base64.match(/.{1,500000}/g);
                var index=0;
                while(index<fotopart.length){
                    $.ajax({
                        async:false,
                        method:'post',
                        url:  Url()+"api/CargarFotoProducto",
                        data:{id:id,foto:fotopart[index],orden:orden,index:index}
                    }).done(function(data) {
                        console.log(data);
                        index++;
                    }).fail(function() {
                        console.log( "error" );
                        index++;
                        
                    });
                }
            }
           
        }

        function BorrarProductoFoto(orden){
            var id=$('#id').val();
            $.ajax({
                async:false,
                method:'post',
                url:  Url()+"api/BorrarProductoFoto",
                data:{id:id,orden:orden}
            }).done(function(data) {//https://cdn.pixabay.com/photo/2017/01/25/17/35/picture-2008484_960_720.png
                console.log(data);
                $('#borrar'+orden).hide();
                $('#imagen'+orden).hide();
                $('#imagent'+orden).show();
            }).fail(function() {
                console.log( "error" );
                
                
            });
        }
    </script>


</body>
</html>
