<!DOCTYPE html>
<html lang="en">
<head>
  @include('dosificadores.header')
  <title>{{GetSiglas(0)}} | Tracking</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('dosificadores.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('dosificadores.sidebars.sidebar')

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
                <h3 class="card-title">Tracking</h3>

                <div class="card-tools">
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Filtros <i class="fa fa-sliders" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" style="width:300px;">
                      <form class="px-4 py-3" action="obrasretrasadas">
                        
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-user"></i></span>
                          </div>
                          <input type="text" class="form-control" name="generador" id="generador" placeholder="Generador" @if(isset($filtros->generador)) value="{{$filtros->generador}}" @endif >
                        </div>

                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-building"></i></span>
                          </div>
                          <input type="text" class="form-control" name="obra" id="obra" placeholder="Obra" @if(isset($filtros->obra)) value="{{$filtros->obra}}" @endif >
                        </div>

                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-recycle"></i></span>
                          </div>
                          <input type="text" class="form-control" name="planta" id="planta" placeholder="Planta" @if(isset($filtros->planta)) value="{{$filtros->planta}}" @endif >
                        </div>


                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="exelente" id="exelente" @if(isset($filtros->exelente)) checked @endif>
                          <span class=" badge" style="color:#fff; background-color:#28A745;">Exelente</span>                            
                          </label>
                        </div>
                        
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="correcto" id="correcto" @if(isset($filtros->correcto)) checked @endif>
                          <span class=" badge" style="color:#fff; background-color:#7FFF00;">Correcto</span>                            
                          </label>
                        </div>

                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="patrasado" id="patrasado" @if(isset($filtros->patrasado)) checked @endif>
                          <span class=" badge" style="color:#fff; background-color:#FFF200;">Poco Atrasado</span>                            
                          </label>
                        </div>

                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="atrasado" id="atrasado" @if(isset($filtros->atrasado)) checked @endif>
                          <span class=" badge" style="color:#fff; background-color:#FF7F00;">Atrasado</span>                            
                          </label>
                        </div>

                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="matrasado" id="matrasado" @if(isset($filtros->matrasado)) checked @endif>
                          <span class=" badge" style="color:#fff; background-color:#FD003A;">Muy Atrasado</span>                            
                          </label>
                        </div>

                        
                      
                        <div class="dropdown-divider"></div>
                        <a href="obrasretrasadas" class="btn btn-default btn-sm">Limpiar</a>
                        <button type="submit" class="btn btn-info btn-sm float-right">Aplicar</button>
                        
                      </form>
                      
                    </div>
                  </div>
                
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body ">
                <br>
                <div calss="row">
                    <div class="col-md-12">
                        <div id="map" style=" height: 550px; width:100%;"></div>
                    </div>
                </div>
                <hr>
                
                
              </div>
              <!-- /.card-body -->
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


<script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-app.js"></script>

<script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-database.js"></script>

<script>
    //var Obras=HtmltoJson('');
    var Remisiones=HtmltoJson('{{$remisiones}}');
    var markers ={};
    var map;
    var imagecamion;

    function initMap() {
      //console.log(markers);
      var myLatlng = { lat:  23.625269, lng: -102.540613 };
      map = new google.maps.Map(document.getElementById("map"), {
        zoom: 5,
        center: myLatlng,
      });
      imagecamion = {
            url: '{{asset("images/Traking/olla.png")}}',
            // Este marcador tiene 20 pixeless de ancho por 32 pixeles de alto.
            scaledSize: new google.maps.Size(25, 25),
            // El origen para esta imagen es (0, 0).
            origin: new google.maps.Point(0, 0),
            // El ancla para esa imagen es la base del asta bandera en (0, 32).
            anchor: new google.maps.Point(0, 32)
        };

        imageobra = {
            url: '{{asset("images/Traking/obra1.png")}}',
            // Este marcador tiene 20 pixeless de ancho por 32 pixeles de alto.
            scaledSize: new google.maps.Size(50, 50),
            // El origen para esta imagen es (0, 0).
            origin: new google.maps.Point(0, 0),
            // El ancla para esa imagen es la base del asta bandera en (0, 32).
            anchor: new google.maps.Point(0, 32)
        };
        //MarcarObras();
      IniciarListeners();
      
    }

    
      
    
        

        function IniciarListeners(){

            var firebaseConfig = {
                apiKey: "AIzaSyC6sWUmNwPKm476T_slrkg90d8y_DtmL2o",
                authDomain: "recitrack-a87ef.firebaseapp.com",
                databaseURL: "https://recitrack-a87ef-default-rtdb.firebaseio.com",
                projectId: "recitrack-a87ef",
                storageBucket: "recitrack-a87ef.appspot.com",
                messagingSenderId: "710116689949",
                appId: "1:710116689949:web:10c45a403938f7976f5ef4",
                measurementId: "G-TGYW0JZXRF"
            };
            firebase.initializeApp(firebaseConfig);



            for(var i in Remisiones){
                if(Remisiones[i].confirmacion==1){
                    continue;
                }
                //console.log(Remisiones[i].id);
                var marker = new google.maps.Marker({
                                position: { lat:  0.0, lng: 0.0 },
                                title: '',
                                icon: imagecamion
                            });
                markers[Remisiones[i].id]=marker;
                firebase.database().ref('Remisiones/Tracking/'+Remisiones[i].id)
                .on('child_added',function(snapshot){
                    
                    
                    for(var i in snapshot){
                            
                        if(typeof snapshot[i].val==='function'){
                            
                           

                            
                            
                            markers[snapshot[i].val().id].setPosition( new google.maps.LatLng(  parseFloat(snapshot[i].val().latitud),parseFloat(snapshot[i].val().longitud) ) );
                            markers[snapshot[i].val().id].setMap(map);
                        }
                    }
                    CenterMap();
                
                });
            }
            
        }

        function CenterMap(){
          
          var bounds = new google.maps.LatLngBounds();
          for (var i in markers) {
            
            
            if(markers[i].getPosition().lat()!=0){
              bounds.extend(markers[i].getPosition());
            }
          }

          map.fitBounds(bounds);
        }

        /*

        function MarcarObras(){
          console.log(Obras);
          for(var i in Obras){
            markers[Obras[i].id]=new google.maps.Marker({
              position: { lat:  parseFloat(Obras[i].latitud), lng: parseFloat(Obras[i].longitud) },
              title: Obras[i].obra,
              icon: imageobra
          });

          markers[Obras[i].id].setMap(map);
          }
          
        }

        */

    
    



    </script>
    
@include('MapsApi')

</body>
</html>
