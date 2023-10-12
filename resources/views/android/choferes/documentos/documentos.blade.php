<!DOCTYPE html>
<html lang="en">
<head>
  @include('android.choferes.header')
  <title>CSMX | Citas</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('android.choferes.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('android.choferes.sidebars.sidebar')

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
            <h3 class="card-title"><i class="nav-icon fa fa-user" aria-hidden="true"></i> Datos</h3>
          </div>
          <form action="{{url('UpdateChoferDocs')}}/{{$chofer->id}}" method="POST" id="RegistroChofer" enctype="multipart/form-data">
          @csrf          
          <input name="_method" type="hidden" value="PUT">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">   
                 
              @if($chofer->verificado==0)
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="ine">INE (Frente)</label>
                      <div class="input-group">
                      <div class="custom-file">
                      <input required type="file" class="custom-file-input" id="inefrente" name="inefrente">
                      <label class="custom-file-label" for="ine">INE (Frente)</label>
                      </div>
                      
                      </div>
                    </div>
                  </div>

                </div>
                @else
                      <label for="ine">INE (Frente)</label>
                @endif
                <div class="row">
                  <div class="col-md-12">
                    @if(!file_exists(public_path('documentos/choferes/ine/frente').'/'.$chofer->id.'.jpg'))
                    <img src="{{url('documentos/choferes/ine').'/noine.jpg'}}" class="card-img-top" style=" aspect-ratio: 5/3;">
                    @else
                    <img src="{{url('documentos/choferes/ine/frente').'/'.$chofer->id.'.jpg'}}"  style=" aspect-ratio: 5/3;" class="card-img-top">
                    @endif
                  </div>
                </div>
                @if($chofer->verificado==0)
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="ine">INE (Reverso)</label>
                      <div class="input-group">
                      <div class="custom-file">
                      <input required type="file" class="custom-file-input" id="inereverso" name="inereverso">
                      <label class="custom-file-label" for="ine">INE (Reverso)</label>
                      </div>
                      
                      </div>
                    </div>
                  </div>

                </div>
                @else
                      <label for="ine">INE (Reverso)</label>
                @endif

                <div class="row">
                  <div class="col-md-12">
                    @if(!file_exists(public_path('documentos/choferes/ine/reverso').'/'.$chofer->id.'.jpg'))
                    <img src="{{url('documentos/choferes/ine').'/noinereverso.jpg'}}" class="card-img-top" style=" aspect-ratio: 5/3;">
                    @else
                    <img src="{{url('documentos/choferes/ine/reverso').'/'.$chofer->id.'.jpg'}}"  style=" aspect-ratio: 5/3;" class="card-img-top">
                    @endif
                  </div>
                </div>
                
              </div>
            </div>
            <div class="card-footer">
              @if($chofer->verificado==0)
              <button type="submit" class="btn btn-primary">Guardar</button>
              @endif
            </div>
          </form>
        </div>
      </div>
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
