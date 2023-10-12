<!DOCTYPE html>
<html lang="en">
<!--jonathan-->
<head>
  @include('finanzas.header')
  <title>{{GetSiglas(0)}} | Catálogos</title>
|
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('finanzas.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('finanzas.sidebars.sidebar')

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
                        <h3 class="card-title">Materiales</h3>
                    </div>
                    <div class="card-body" style="overflow:scroll;">                      
                        
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Categorías</th>
                                    <th>Material</th>
                                    <th>Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($materiales as $material)
                                <tr>
                                    <td title="{{$material->categoria}}">{{strlen($material->categoria) > 40 ? substr($material->categoria,0,39).'...' : $material->categoria}}</td>
                                    <td title="{{$material->material}}">{{strlen($material->material) > 40 ? substr($material->material,0,39).'...' : $material->material}}</td>
                                    <td>${{number_format($material->precio,2)}}</td>                                    
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                        
                        
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
   


</body>
</html>
