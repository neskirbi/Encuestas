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
                        <h3 class="card-title"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Agregar</h3>
                    </div>
                    <form method="post" action="{{url('productos').'/'.$producto->id}}" enctype="multipart/form-data">
                    @csrf                    
                    <input name="_method" type="hidden" value="PUT">
                    <div class="card-body">
                    <div class="row" id="select">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select required class="form-control" name="categoria" id="categoria" >
                                        <option value="{{$producto->categoria}}">{{$producto->categoria}}</option>
                                        <option value=""></option>
                                        @foreach($categorias as $categoria)
                                        <option value="{{$categoria->categoria}}">{{$categoria->categoria}}</option>
                                        @endforeach
                                    </select>
                                </div>
                               
                            </div>
                            <div class="col-md-1"><a class="btn btn-info btn-sm" onclick="CategoriaTexto();"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
                        </div>
                        <div class="row" id="texto" style="display:none;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input  type="text" class="form-control" name="categoriatexto" id="categoriatexto" placeholder="Categoría">
                                </div>
                            </div>
                            <div class="col-md-1"><a class="btn btn-danger btn-sm" onclick="CategoriaSelect();"><i class="fa fa-minus" aria-hidden="true"></i></a></div>

                        </div>
                        <hr>
                        <div class="row" id="body" style='display:;'>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="producto">Producto</label>
                                            <input required type="text" class="form-control" name="producto" id="producto" placeholder="Producto" value="{{$producto->producto}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="precio">Precio</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input required type="number" min="0.0" step="0.01" class="form-control" name="precio" id="precio" placeholder="Precio" value="{{$producto->precio}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="transporte">Requiere transporte?</label>
                                            <input type="checkbox" class="form-control" name="transporte" id="transporte" {{$producto->transporte ? 'checked' : ''}}>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="producto">Descripci&oacute;n</label>
                                            <textarea required class="form-control" rows="5" name="descripcion" id="descripcion" placeholder="Descripci&oacute;n">{{$producto->descripcion}}</textarea>
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
