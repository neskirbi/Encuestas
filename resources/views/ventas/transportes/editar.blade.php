<!DOCTYPE html>
<html lang="en">
<head>
  @include('ventas.header')
  <title>CSMX | Transporte</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('ventas.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('ventas.sidebars.sidebar')

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
                        <h3 class="card-title"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Agregar</h3>
                    </div>
                    <form method="post" action="{{url('transporte').'/'.$transporte->id}}" enctype="multipart/form-data">
                    @csrf                    
                    <input name="_method" type="hidden" value="PUT">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="transporte">Transporte</label>
                                            <input required type="text" class="form-control" name="transporte" id="transporte" placeholder="Transporte" value="{{$transporte->transporte}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                    <div class="form-group">
                                            <label for="capacidad">Capacidad</label>
                                            <div class="input-group">
                                                <input required type="number" min="0.0" step="0.01" class="form-control" name="capacidad" id="capacidad" placeholder="Capacidad" value="{{$transporte->capacidad}}">                                                
                                                <div class="input-group-append">
                                                    <span class="input-group-text">m<sup>3</sup></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="precio">Precio</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input required type="number" min="0.0" step="0.01" class="form-control" name="precio" id="precio" placeholder="Precio" value="{{$transporte->precio}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="producto">Descripci&oacute;n</label>
                                            <textarea required class="form-control" rows="5" name="descripcion" id="descripcion" placeholder="Descripci&oacute;n">{{$transporte->descripcion}}</textarea>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" id="footer" style='display:;'>
                        <button type="submit" class="btn btn-info">Guardar</button>
                    </div>
                    </form>
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
        

        function CategoriaTexto(){
            $('#texto').show();
            $('#select').hide();
            $('#categoria').val('');
            $('#categoria').removeAttr( 'required' );
            $('#categoriatexto').attr('required', 'required');
        }

        function CategoriaSelect(){
            $('#texto').hide();
            $('#select').show();
            $('#categoriatexto').val('');
            $('#categoriatexto').removeAttr( 'required' );
            $('#categoria').attr('required', 'required');
        }
        
    </script>


</body>
</html>
