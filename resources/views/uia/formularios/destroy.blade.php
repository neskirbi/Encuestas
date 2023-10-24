<!DOCTYPE html>

<html lang="en">

<head>

  @include('uia.header')

  <title>Encuestas</title>



  

</head>

<body class="hold-transition sidebar-mini layout-fixed">

@include('toast.toasts')  

<div class="wrapper">



  <!-- Navbar -->

 

  @include('uia.navigations.navigation')

  <!-- /.navbar -->



  <!-- Main Sidebar Container -->

  @include('uia.sidebars.sidebar')



  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <div class="content-header">

     

    </div>

    <!-- /.content-header -->



    <!-- Main content -->

    <section class="content">

      <div class="container-fluid">

        

        <div class="callout callout-danger">

            <h5>Eliminar: {{$encuesta->encuesta}} ?</h5>

        </div>



        <div class="row">

            <div class="col-md-12">

                <div class="card card-danger"> 
                    <div class="card-header">

                        <h3 class="card-title">Eliminar</h3>
                    </div>                   

                    <div class="card-body">    

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a class="btn btn-info" href="{{url('formularios')}}">  Cancelar</a>                                    
                                    <a class="btn btn-danger float-right" href="{{url('DestroyFormulario')}}/{{$encuesta->id}}"> </i> Eliminar</a>
                                </div>
                            </div>
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

  $.widget.bridge('uibutton', $.ui.button);



 

</script>

<!-- Bootstrap 4 -->

<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- ChartJS -->

<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>

<!-- Sparkline -->

<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>

<!-- JQVMap -->

<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>

<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>

<!-- jQuery Knob Chart -->

<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>

<!-- daterangepicker -->



<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>

<!-- Summernote -->

<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>

<!-- overlayScrollbars -->

<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

<!-- AdminLTE App, funcion de sidebar -->

<script src="{{asset('dist/js/adminlte.js')}}"></script>





<script>



    function PonExtra(_this){

        var opcion=$('#'+$(_this).attr('id')+' option:selected').val()*1;

        console.log(opcion);



        var html='';

        switch(opcion){



            case 0:

                console.log(opcion);

                html+='<div class="row">';

                html+='    <div class="col-md-12">';

                html+='        <div class="form-group">';

                html+='            <label for="pregunta">Encabezado</label>';

                html+='            <input required data-invalido="true" type="text" name="pregunta" id="pregunta"  class="form-control" aria-invalid="false">';

                html+='        </div>';

                html+='    </div>';

                html+='</div>';

            break;





            case 1:

                console.log(opcion);

                html+='<div class="row">';

                html+='    <div class="col-md-12">';

                html+='        <div class="form-group">';

                html+='            <label for="pregunta">Pregunta</label>';

                html+='            <input required data-invalido="true" type="text" name="pregunta" id="pregunta"  class="form-control" aria-invalid="false">';

                html+='        </div>';

                html+='    </div>';

                html+='</div>';

            break;



            case 2:

                console.log(opcion);

                html+='<div class="row">';

                html+='    <div class="col-md-12">';

                html+='        <div class="form-group">';

                html+='            <label for="pregunta">Pregunta</label>';

                html+='            <input required data-invalido="true" type="text" name="pregunta" id="pregunta"  class="form-control" aria-invalid="false">';

                html+='        </div>';

                html+='    </div>';

                html+='</div>';





                html+='<div class="row">';

                html+='    <div class="col-md-12">';

                html+='        <div class="form-group">';

                html+='            <label for="opciones">Opciones(Separadas por coma)</label>';

                html+='            <textarea required data-invalido="true" type="text" name="opciones" id="opciones"  class="form-control" aria-invalid="false"></textarea>';

                html+='        </div>';

                html+='    </div>';

                html+='</div>';

            break;



            case 3:

                console.log(opcion);

                html+='<div class="row">';

                html+='    <div class="col-md-12">';

                html+='        <div class="form-group">';

                html+='            <label for="pregunta">Pregunta</label>';

                html+='            <input required data-invalido="true" type="text" name="pregunta" id="pregunta"  class="form-control" aria-invalid="false">';

                html+='        </div>';

                html+='    </div>';

                html+='</div>';





                html+='<div class="row">';

                html+='    <div class="col-md-12">';

                html+='        <div class="form-group">';

                html+='            <label for="opciones">Opciones(Separadas por coma)</label>';

                html+='            <textarea required data-invalido="true" type="text" name="opciones" id="opciones"  class="form-control" aria-invalid="false"></textarea>';

                html+='        </div>';

                html+='    </div>';

                html+='</div>';

            break;



            case 4:

                console.log(opcion);

                html+='<div class="row">';

                html+='    <div class="col-md-12">';

                html+='        <div class="form-group">';

                html+='            <label for="pregunta">Imagen</label>';

                html+='            <input required data-invalido="true" type="text" name="pregunta" id="pregunta"  class="form-control" aria-invalid="false">';

                html+='        </div>';

                html+='    </div>';

                html+='</div>';

            

            break;


            case 5:

                console.log(opcion);

                html+='<div class="row">';

                html+='    <div class="col-md-12">';

                html+='        <div class="form-group">';

                html+='            <label for="pregunta">Ubicación </label>';

                html+='        </div>';

                html+='    </div>';

                html+='</div>';

            break;

            default:

            console.log(typeof opcion);

            break;

        }



        $('#extra').html(html);

    }



    $(function () {

        bsCustomFileInput.init();

    });

</script>

</body>

</html>

