<!DOCTYPE html>
<html lang="en">
<!--jonathan-->
<head>
  @include('ventas.header')
  <title>CSMX | Catálogos</title>
|
  
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
                        <div class="card-title">Material</div>
                    </div>
                    <div class="card-body">
                    <form action="{{url('materiales')}}/{{$material->id}}" method="POST" id="formmaterial">
                        @csrf                 
                        <input name="_method" type="hidden" value="PUT">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select required class="form-control" id="categoria" name="categoria">
                                        <option value="{{$material->categoria}}">{{$material->categoria}}</option>
                                        <optgroup></optgroup>
                                        @foreach($categorias as $categoria)
                                        <option value="{{$categoria->categoria}}">{{$categoria->categoria}}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control" style="display:none;" id="categoriatext" name="categoriatext" placeholder="Categoría">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <a onclick="CategoriaTexto(this);" class="btn btn-info btn-sm" id="mas"><i class="nav-icon fa fa-plus" aria-hidden="true" ></i></a>
                                <a onclick="CategoriaSelect(this);" class="btn btn-danger btn-sm" id="menos" style="display:none;" ><i class="nav-icon fa fa-times" aria-hidden="true" ></i></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="material">Material</label>
                                    <input required type="text" class="form-control" id="material" name="material" placeholder="Material" value="{{$material->material}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="precio">Precio</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input required type="number" step="0.01" class="form-control" id="precio" name="precio" value="{{$material->precio}}">                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar</button>

                        </form>  

                
                    </div>
                    <div class="card-footer"></div>
                </div>
                <!-- /.card -->
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
    <script src="dist/js/adminlte.js"></script>
    @include('administracion.footer')


    <script>
        function CategoriaTexto(_this){           
            $(_this).hide();            
            $('#menos').show();
            $('#categoriatext').show();
            $('#categoria').hide(); 
            $('#categoria').val('');
            $('#categoriatext').val('');
            $('#categoria').removeAttr( 'required' );
            $('#categoriatext').attr('required', 'required');
        }

        function CategoriaSelect(_this){           
            $(_this).hide();          
            $('#mas').show();
            $('#categoriatext').hide();
            $('#categoria').show();
            $('#categoria').val('');
            $('#categoriatext').val('');
            $('#categoriatext').removeAttr( 'required' );
            $('#categoria').attr('required', 'required');
        }

    </script>


</body>
</html>
