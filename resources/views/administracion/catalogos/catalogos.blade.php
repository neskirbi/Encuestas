<!DOCTYPE html>
<html lang="en">
<!--jonathan-->
<head>
  @include('administracion.header')
  <title>CSMX | Catálogos</title>
|
  
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
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#catmateriales" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="true">Categorías Materiales</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#materiales" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="true">Materiales</a>
                                </li>
                            
                            </ul>
                        </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">                       
                            
                            <div class="tab-pane fade active show" id="catmateriales" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                                <div class="p-2">
                                    <button onclick="LimpiarInfoCategoriaMaterialAdmin();"  data-toggle="modal" data-target="#modalcategoriamaterial" class="btn btn-primary"><span><i class="fa fa-plus" aria-hidden="true"></i></span> Categoría Material
                                    </button>
                                </div>
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Categorías</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($categoriasmateriales as $categoriamaterial)
                                        <tr>
                                            <td>{{$categoriamaterial->categoriamaterial}}</td>
                                            <td>
                                                <button onclick="AbrirModal('modalcategoriamaterial'); CargarInfoCategoriaMaterialAdmin(this);" class="btn btn-outline-info"  data-id="{{$categoriamaterial->id}}" data-categoriamaterial="{{$categoriamaterial->categoriamaterial}}">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
                                                </button>
                                                <a href="borrarcategoriamaterialadm/{{$categoriamaterial->id}}" class="btn btn-danger borrar" data-texto="¿Está seguro de borrar la categoría y todos los materiales que pertenecen a ella?">
                                                    <i class="fa fa-times" aria-hidden="true"></i> Borrar
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="materiales" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                                <div class="p-2">
                                    <button onclick="LimpiarInfoMaterialAdmin();" data-toggle="modal" data-target="#modalmaterial" class="btn btn-primary"><span><i class="fa fa-plus" aria-hidden="true"></i></span> Material
                                    </button>
                                </div>
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Material</th>
                                            <th>Precio</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($materiales as $material)
                                        <tr>
                                            <td>{{$material->material}}</td>
                                            <td>{{$material->precio}}</td>
                                            <td>
                                                <button onclick="AbrirModal('modalmaterial'); CargarInfoMaterialAdmin(this);" class="btn btn-outline-info"  data-id="{{$material->id}}" data-categoriamaterial="{{$material->id_categoriamaterial}}" data-material="{{$material->material}}" data-precio="{{$material->precio}}">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
                                                </button>
                                                <a href="borrarmaterialadm/{{$material->id}}" class="btn btn-danger borrar" data-texto="¿Está seguro de borrar el material?">
                                                    <i class="fa fa-times" aria-hidden="true"></i> Borrar
                                                </a>
                                            </td>

                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
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
    @include('administracion.catalogos.modals.modalcategoriamaterial')
    @include('administracion.catalogos.modals.modalmaterial')
    @include('administracion.footer')


</body>
</html>
