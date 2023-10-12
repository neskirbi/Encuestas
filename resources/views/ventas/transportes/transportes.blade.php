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
                            <h3 class="card-title"><i class="fa fa-truck" aria-hidden="true"></i> Transportes</h3>
                        </div>
                        <div class="card-body">
                            <a href="{{url('cargar')}}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Transporte</a>
                            <br><br>
                            
                            <?php $categoria=''; ?>
                            @foreach($transportes as $transporte)
                           
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <center><img src="{{!file_exists(public_path($transporte->portada)) ? 'https://cdn.pixabay.com/photo/2017/01/25/17/35/picture-2008484_960_720.png' : url($transporte->portada)}}" style="max-height:90px; border-radius:5px;" alt=""></center>
                                                </div>
                                                <div class="col-md-9">
                                                    <h5 class="card-title">{{$transporte->transporte}}</h5>

                                                    <p class="card-text">
                                                    {{$transporte->descripcion}}
                                                    </p>
                                                    <table>
                                                        <tr>
                                                            <td style="width:120px;"><a href="{{url('productofotos').'/'.$transporte->id}}" class="card-link">Agregar Fotos</a></td>
                                                            <td style="width:90px;"><a href="{{url('transporte').'/'.$transporte->id}}" class="card-link">Editar</a></td>
                                                            <td style="width:150px;">
                                                            <form action="{{url('transporte').'/'.$transporte->id}}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger borrar" data-texto="Está seguro de borrar {{$transporte->transporte}}?"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</button>
                                                            </form>
                                                            </td>
                                                        </tr>
                                                    </table>  
                                                </div>
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            @endforeach
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
    <script src="dist/js/adminlte.js"></script>


</body>
</html>