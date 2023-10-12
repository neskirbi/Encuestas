<!DOCTYPE html>
<html lang="en">
<head>
  @include('ventas.header')
  <title>{{GetSiglas(0)}} | Catálogo</title>

  
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-tags"></i> Catálogo</h3>
                <div class="card-tools">
                  <a class="btn btn-default pull-right" target="_blank" onclick="VerCarrito();">
                    <i class="fa fa-shopping-cart"></i>
                    <!--<span class="badge badge-warning navbar-badge"><font id="capacidad">2</font></span>-->
                  </a>
                  <br>
                  <div class="form-group">
                    <select required type="text" name="obra" class="form-control" id="obra" aria-invalid="false" onchange="CatalogoObra(0); ">
                      <option value="">--Seleccionar obra--</option>
                      @foreach($obras as $obra)
                      <option value="{{$obra->id}}" title="{{$obra->obra}}">{{strlen($obra->obra)<50 ? $obra->obra : mb_substr($obra->obra,0,49,"UTF-8").' ...'}}</option>
                      
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group" style="display:none;" id="buscarproducto">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="Buscar" onkeyup="FiltrarProductos(this);">
                      <div class="input-group-append">
                      <span class="input-group-text"><i class="fa fa-binoculars" aria-hidden="true"></i></span>
                      </div>
                    </div>
                  </div>
                  
                </div>                
              </div>
              
              <!-- /.card-body -->
             
            </div>
            <div class="row">
              <div class="col-md-12">
                <div id="catalogo"></div>  
              </div>
            </div>
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
<script src="dist/js/adminlte.js"></script>
<script>
  function FiltrarProductos(_this){
    var filtro=$(_this).val().toLowerCase();
    $('.filtro').each(function(){
      if($(this).data('filtro').toLowerCase().includes(filtro)){
        $(this).show();
        
      }else{
        console.log($(this).data('filtro'));
        $(this).hide();
      }
    });

  }

  function VerCarrito(){
    if($('#obra').val().length>0){
      window.open(Url()+"Carritov/"+$('#obra').val());
    }else{
      alert('Seleccione una obra para ver el carrito.');
    }
  }
</script>


</body>
</html>
