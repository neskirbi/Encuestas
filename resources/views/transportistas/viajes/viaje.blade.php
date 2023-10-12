<!DOCTYPE html>
<html lang="en">
<head>
  @include('transportistas.header')
  <title>{{GetSiglas(0)}} | Citas</title>
</head>

<style>
        .contenido{
            padding: 5px;
            border-radius:5px;
            background-color:#e5e4e2;
        }

        .contenido2{
            padding: 5px;
        }

        .letra{
            font-size:13px;
        }

        .letra2{
            font-size:10px;
        }

        .fotos{
            width:300px; 
            border:1px #ccc solid;
            border-radius:5px; 
            padding:10PX;
        }
    </style>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('transportistas.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('transportistas.sidebars.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
     
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
        
        <div class="col-12">
            <div class="card">
                
              <!-- /.card-header -->
                <div class="card-body">
                    <div>
                        <img src="{{asset('images/logo.png')}}" height="50px" style="float: left;">
                        <img src="{{asset('images/logo2.jpg')}}" height="50px" style="float: right;">
                    </div>
                    <br><br><br><br>
                    <form method="post" action="{{ url('cita') }}/{{$cita->id}}" id="formcita">
                    @csrf
                    <input name="_method" type="hidden" value="PUT">
                    <div class="contenido letra" style=" float: right; margin-right:0px;">Fecha: {{FechaFormateada($cita->fechacita)}}</div>
                    <br><br>

                    
                    <div class="contenido letra" style=" ">
                        <table width="100%">
                            <tr>
                            <td >Tipo de vehículo</td>
                            <td >Marca y modelo</td>
                            <td >Matrícula</td>
                            </tr>
                            <tr>
                            <td style=" border-bottom-style: dotted ;">{{$cita->vehiculo}}</td>
                            <td style=" border-bottom-style: dotted ;">{{$cita->marcaymodelo}}</td>
                            <td style=" border-bottom-style: dotted ;">{{$cita->matricula}}</td>
                            </tr>
                            
                            <tr>
                            <td>Tarjeton RAMIR:</td>
                            <td colspan="2">{{$cita->ramir}}</td>
                            </tr>
                        </table>
                    
                    </div>

                    <br>
                    <div class="contenido" >
                        <table width="100%" style="text-align: center;">
                            <tr >
                            <td class="letra" style=" border-bottom-style: dotted ;">Tipo de residuo</td>
                            <td class="letra" style=" border-bottom-style: dotted ;">Unidad</td>
                            <td class="letra" style=" border-bottom-style: dotted ;">Cantidad</td>
                            </tr>

                            <tr>
                            <td>
                                <span style="">{{$cita->material}}</span>

                            </td>
                            <td class="letra">{{$cita->unidades}}</sup></td>
                            <td class="letra">
                                {{$cita->cantidad}}
                            </td>
                           
                            
                            </tr>
                        
                        </table>
                    
                    </div>

                    <br>
                    
                    <div class="contenido" style=" ">
                        <table width="100%">
                            <tr>
                            <td >Condiciones de trasporte de los residuos</td>
                            
                            <td>{{$cita->condicionesmaterial}}</td>
                            </tr>
                        
                        </table>
                    
                    </div>

                    <br>
                     
                </div>

                     
                
                
                </form>
              <!-- /.card-body -->
            </div>
         

                <div class="card-info">                    
                    <div class="card-header">
                        <h3 class="card-title">Recorrido</h3>
                        <div class="card-tools">
                        
                        </div>
                        
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <div id="map" style=" height: 400px; width:100%;"></div>
                        </div>
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
<script>
    var markers = HtmltoJson('{{$coordenadas}}');
    

    function initMap() {
        
      
        const myLatlng = { lat: markers[Math.round(markers.length/2)].lat*1, lng: markers[Math.round(markers.length/2)].lon*1 };
        
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 14,
            center: myLatlng,
        });
        
        const flightPlanCoordinates = [];
        for(var i in markers){
            flightPlanCoordinates[i]=({ lat: markers[i].lat*1, lng: markers[i].lon*1 });
        }
        
        console.log(flightPlanCoordinates);
        const flightPath = new google.maps.Polyline({
            path: flightPlanCoordinates,
            geodesic: true,
            strokeColor: "#FF0000",
            strokeOpacity: 1.0,
            strokeWeight: 2,
        });

        flightPath.setMap(map);
    }

    
</script>

@include('MapsApi')
</html>
