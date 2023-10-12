<!DOCTYPE html>
<html lang="en">
<head>
  @include('transportistas.header')
  <title>{{GetSiglas(0)}} | Obras</title>  
</head>
<body>
    <div id="map" style=" height: 500px; width:100%;"></div>
</body>
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
    var markers = HtmltoJson('{{$coordenadas}}');
    function initMap() {
      //console.log(markers);
      var myLatlng = { lat:  20.248882446801847, lng: -101.45472227050904 };
      var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 5,
        center: myLatlng,
      });
      console.log(markers.length);
      for(var i=0;i< markers.length ; i++){
        const  id=markers[i].id,con=markers[i].con;
        var  myLatlng = { lat:  parseFloat(markers[i].lat), lng: parseFloat(markers[i].lon) };
       
        var marker = new google.maps.Marker({
            position: myLatlng,
            title: markers[i].obra
        });

         // Create the initial InfoWindow.
        /*let infoWindow = new google.maps.InfoWindow({
          content:markers[i].obra,
          position: myLatlng,
        });
        
        infoWindow.open(map,marker);*/

        // To add the marker to the map, call setMap();

       
        marker.setMap(map);
      }
      
    }
      
    </script>
    
@include('MapsApi')

</html>