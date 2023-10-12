<!DOCTYPE html>
<html lang="en">
<head>
  @include('ventas.header')
  <title>CSMX | Citas</title>

  
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
        
        <div class="row">        
          <div class="col-12">
            <form action="{{url('citasventas')}}/{{$cita->id}}" method="post">
            @csrf
            <input type="hidden" name="_method" value="PUT">
              
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" title="{{$cita->obra}}"><i class="fa fa-building" aria-hidden="true"></i> {{strlen($cita->obra)<81 ? $cita->obra : mb_substr($cita->obra,0,80,"UTF-8").'...'}}</h3>                
              </div>
              <!-- /.card-header -->
              <div class="card-body" >              
                

              <div class="row">                 
                  <div class="col-md-5">
                    <div class="form-group">
                      <label for="cantidad">Cantidad</label>
                        <input  type="text" class="form-control" id="cantidad" name="cantidad"  value="{{$cita->cantidad}}">
                    </div>
                  </div>
                </div>

                <?php $categoria='';?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group" id="rowmaterial">
                        <label for="material">Material&nbsp;&nbsp;&nbsp;</label>
                        <select required type="text" name="material" class="form-control" id="material" aria-invalid="false" >
                          
                          <option value="{{$materialobra->id}}" data-precio="0">{{$materialobra->material.' $'.$materialobra->precio}}</option> 
                          @foreach($materialesobra as $material)
                          @if($categoria!=$material->categoriamaterial)
                          <optgroup label="{{$material->categoriamaterial}}"></optgroup>
                          <?php $categoria=$material->categoriamaterial;?>
                          @endif
                          <option value="{{$material->id}}" data-precio="">{{$material->material.' $'.$material->precio}}</option>    
                          @endforeach                    
                        </select>
                    </div>
                  </div>
                </div>
                
                
                </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button class="btn btn-primary pull-right">Guardar</button>
              </div>
            </div>
            </form>
            <!-- /.card -->
          </div>
          
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

</body>
</html>
