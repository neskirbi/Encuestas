<!DOCTYPE html>

<html lang="en">

<head>

  @include('inspecciones.header')

  <title>Encuestas</title>



  

</head>

<body class="hold-transition sidebar-mini layout-fixed">

@include('toast.toasts')  

<div class="wrapper">



  <!-- Navbar -->

 

  @include('inspecciones.navigations.navigation')

  <!-- /.navbar -->



  <!-- Main Sidebar Container -->

  @include('inspecciones.sidebars.sidebar')



  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <div class="content-header">

     

    </div>

    <!-- /.content-header -->



    <!-- Main content -->

    <section class="content">

      <div class="container-fluid">

        <div class="callout callout-info">

            <h5>1.Datos del interesado</h5>

        </div>

        <form action="{{url('GuardarInforme')}}"  method="post" enctype='multipart/form-data'>

        @csrf



        
        

        

        <div class="row">

            <div class="col-md-12">

                <div class="card">                    

                    <div class="card-body">

        <?php

        $preguntasid=array();

        $fotosid=array();

        

        foreach($preguntas as $pregunta){

            

            

            switch($pregunta->tipo){



                case 0:

                    $preguntasid[]=$pregunta->id;

                    ?>

                  

                    <div class="row">     

                        <div class="col-md-12">

                            <div class="callout callout-info">

                                <h5>{{$pregunta->pregunta}}</h5>

                            </div>

                        </div>

                    </div>

                                    

                     



                    <?php

                break;





                case 1:

                    $preguntasid[]=$pregunta->id;

                    ?>

                  

                                   

                    <div class="row">

                        <div class="col-md-12">

                            <div class="form-group">

                                <label for="pregunta">{{$pregunta->pregunta}}</label>

                                <input disabled data-invalido="true" type="text" name="pregunta[]" id="pregunta"  class="form-control" aria-invalid="false" value="{{$respuestas[$pregunta->id]}}">

                            </div>

                        </div>

                    </div>


                    <?php

                break;

                

                case 2:

                   

                break;

                

                case 3:

                    $preguntasid[]=$pregunta->id;

                    $opciones=explode(',',$pregunta->opciones);

                    ?>

                                                    

                                    

                    <div class="row">

                        <div class="col-md-12">

                            <div class="form-group">

                                <label for="pregunta">{{$pregunta->pregunta}}</label>

                                <input disabled data-invalido="true" type="text" name="pregunta[]" id="pregunta"  class="form-control" aria-invalid="false" value="{{$respuestas[$pregunta->id]}}">

                            </div>

                        </div>

                    </div>

                    <?php

                break;



                case 4:

                    $fotosid[]=$pregunta->id;

                    ?>

                




                    <div class="row">
                                    

                        <div class="col-md-6">
                            <center>

                                <div class="form-group">

                                    <label for="">{{$pregunta->pregunta}}</label><br>

                                </div>

                            </center>

                        </div>

                        <div class="col-md-6">
                            <center>

                                <div class="form-group">

                                    <img src="{{asset('images/inspecciones/evidencia/'.$respuestas[$pregunta->id].'.jpg')}}" alt="" width="50%">

                                </div>

                            </center>

                        </div>


                    </div>

                    <?php

                break;

            }

        }


        ?>








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

    $(function () {

        bsCustomFileInput.init();

    });



</script>



</body>

</html>

