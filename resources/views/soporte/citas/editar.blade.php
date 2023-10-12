<!DOCTYPE html>
<html lang="en">
<head>
  @include('soporte.header')
  <title>{{GetSiglas(0)}} | Vehículos</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('soporte.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('soporte.sidebars.sidebar')

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
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title"><i class="nav-icon fa fa-truck" aria-hidden="true"></i> Editar Vehículos</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                <form method="POST" action="{{url('citassoporte')}}" id="formobra" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                      
                    
                      
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Fecha Cita</label>
                          <input required type="datetime-local" class="form-control" name="fechacita" >
                        </div>
                      </div>
                    </div>
                  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ramir">Folios por corregir (folios separados con comas)</label>
                                <textarea required type="text" rows="5" name="folios" class="form-control" id="folios" placeholder="Folios" aria-invalid="false" ></textarea>
                            </div>
                        </div>
                    </div>   
                      
                    
                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="razonsocial">Plantas(De que planta es la folio?)</label>
                              <select required name="planta" class="form-control" id="planta">
                              <option value=""></option> 
                                @foreach($plantas as $planta)
                                <option value="{{$planta->id}}">{{$planta->planta}}</option>  
                                @endforeach
                              </select>
                          </div>
                        </div>
                      </div> 
                      
                        
                        

                       
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="card-footer">
            
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

<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>

<script>
  
</script>
@include('soporte.footer')
</body>
</html>
