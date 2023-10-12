<!DOCTYPE html>
<html lang="en">
<head>
  @include('transportistas.header')
  <title>{{GetSiglas(0)}} | Obras</title>  
</head>
<body>
    <div class="row">
        
        <form action="{{url('ruta')}}" id="ruta">
        
        <div class="col-md-6">
            <input type="text" name="id" class="form-control" value="{{$id}}" style="display:none;">
            <input type="date" class="form-control" value="{{$dia}}" name="dia" onchange="Submite();">
        </div>
            
        </form>
        
     
    </div>
    <div class="row">        
        <div class="col-md-12">
            <div id="map" style=" height: 400px; width:100%;"></div>
        </div>
    </div>
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

    function Submite(){
        $('#ruta').submit();
    }
      
</script>

@include('MapsApi')

</html>