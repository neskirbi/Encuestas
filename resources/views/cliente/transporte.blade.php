<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>CSMX | Datos</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
 
  @include('cliente.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('cliente.sidebars.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
     
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="images/profile/user4-128x128.jpg" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{$cliente->nombres}} {{$cliente->apellidos}}</h3>
                

                <p class="text-muted text-center">CSMX</p>

                <!--<ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Saldo</b> <a class="float-right">1,322</a>
                  </li>
                  <li class="list-group-item">
                    <b>M<sup>3</sup></b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Obras</b> <a class="float-right">13</a>
                  </li>
                </ul>-->

                <!--<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>-->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Datos de la cuenta</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm" novalidate="novalidate">
                <div class="card-body">
                  <div class="form-group">
                    <label for="nombres">Nombre(s)</label>
                    <input type="text" name="nombres" class="form-control" id="nombres" placeholder="nombres" aria-invalid="false" value="{{$cliente->nombres}}" readonly>
                  </div>

                  <div class="form-group">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" class="form-control" id="apellidos" placeholder="apellidos" aria-invalid="false" value="{{$cliente->apellidos}}" readonly>
                  </div>

                  <div class="form-group">
                    <label for="mail">Correo</label>
                    <input type="text" name="mail" class="form-control" id="mail" placeholder="mail" aria-invalid="false" value="{{$cliente->mail}}" readonly>
                  </div>


                </div>
               
              </form>
            </div>
            <!-- /.card -->

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Dirección</h3>
                <a href="#" data-toggle="modal" data-target="#modaldireccion" class="float-right"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm" novalidate="novalidate">
                <div class="card-body">
                  <div class="form-group">
                    <label for="callenumero">Calle y número</label>
                    <input type="text" name="callenumero" class="form-control" id="callenumero" placeholder="Calle y número" aria-invalid="false" value="{{$cliente->callenumero}}" readonly>
                  </div>

                  <div class="form-group">
                    <label for="colonia">Colonia</label>
                    <input type="text" name="colonia" class="form-control" id="colonia" placeholder="Colonia" aria-invalid="false" value="{{$cliente->colonia}}" readonly>
                  </div>

                  <div class="form-group">
                    <label for="municipio">Municipio</label>
                    <input type="text" name="municipio" class="form-control" id="municipio" placeholder="Municipio" aria-invalid="false" value="{{$cliente->municipio}}" readonly>
                  </div>


                  <div class="form-group">
                    <label for="estado">Estado</label>
                    <input type="text" name="estado" class="form-control" id="estado" placeholder="Estado" aria-invalid="false" value="{{$cliente->estado}}" readonly>
                  </div>


                </div>
               
              </form>
            </div>
          </div>

          <!-- /.col -->
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
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
@include('modals.modaldireccion')
</body>
</html>
