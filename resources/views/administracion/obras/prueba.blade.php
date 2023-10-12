
<!DOCTYPE html>
<html lang="en">
<head>
    
  @include('administracion.header')
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <title>Document</title>
    
</head>
<style>
    #geomap{
    width: 100%;
    height: 400px;
}
</style>
<body>
    <!-- search input box -->
<form>
    <div class="form-group input-group">
        <input type="text" id="search_location" class="form-control" placeholder="Search location">
        <div class="input-group-btn">
            <button class="btn btn-default get_map" type="submit">
                Locate
            </button>
        </div>
    </div>
    </form>
    
    <!-- display google map -->
    <div id="geomap"></div>
    
    <!-- display selected location information -->
    <h4>Location Details</h4>
    <p>Address: <input type="text" class="search_addr" size="45"></p>
    <p>Latitude: <input type="text" class="search_latitude" size="30"></p>
    <p>Longitude: <input type="text" class="search_longitude" size="30"></p>
</body>

<script>
    var geocoder;
    var map;
    var marker;
    
    /*
     * Google Map with marker
     */
    function initMap(zoom=4) {
        var initialLat = $('.search_latitude').val();
        var initialLong = $('.search_longitude').val();
        initialLat = initialLat?initialLat:{{GetLatMexico()}};
        initialLong = initialLong?initialLong:{{GetLonMexico()}};

        
    
        var latlng = new google.maps.LatLng(initialLat, initialLong);
        var options = {
            zoom: zoom,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
    
        map = new google.maps.Map(document.getElementById("geomap"), options);
    
        geocoder = new google.maps.Geocoder();
    
        marker = new google.maps.Marker({
            map: map,
            draggable: true,
            position: latlng
        });
    /*
        google.maps.event.addListener(marker, "click", function () {
            console.log('Listener ok');
            var point = marker.getPosition();
            map.panTo(point);
            geocoder.geocode({'latLng': marker.getPosition()}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                    marker.setPosition(results[0].geometry.location);
                    $('.search_addr').val(results[0].formatted_address);
                    $('.search_latitude').val(marker.getPosition().lat());
                    $('.search_longitude').val(marker.getPosition().lng());
                }
            });
        });

*/
        map.addListener("click", (mapsMouseEvent) =>  {
            console.log('Listener ok');
            var point = marker.getPosition();
            map.panTo(point);
            geocoder.geocode({'latLng': marker.getPosition()}, function (results, status) {
                
            console.log('Status: '+status);
                if (status == google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                    marker.setPosition(results[0].geometry.location);
                    $('.search_addr').val(results[0].formatted_address);
                    $('.search_latitude').val(marker.getPosition().lat());
                    $('.search_longitude').val(marker.getPosition().lng());
                }
            });
        });
        
    
    }
    
    $(document).ready(function () {
        //load google map
        
        
        /*
         * autocomplete location search
         */
        var PostCodeid = '#search_location';
        $(function () {
            $(PostCodeid).autocomplete({
                source: function (request, response) {
                    geocoder.geocode({
                        'address': request.term
                    }, function (results, status) {
                        response($.map(results, function (item) {
                            console.log(results);
                            return {
                                label: item.formatted_address,
                                value: item.formatted_address,
                                lat: item.geometry.location.lat(),
                                lon: item.geometry.location.lng()
                            };
                        }));
                    });
                },
                select: function (event, ui) {
                    var direccionarray=ui.item.value.split(',');
                    console.log('Calle: '+direccionarray[0]);
                    var arraycalle=direccionarray[0].split(' ');                    
                    console.log('Numero: '+arraycalle[arraycalle.length-1]);

                    console.log('Colonia: '+direccionarray[1]);
                    console.log('Alcaldia: '+direccionarray[2]);
                    
                    var estadocp=direccionarray[0].split(' '); 
                    console.log('CP: '+estadocp[0]);
                    
                    console.log('Estado: '+estadocp[0]);
                    
                    $('.search_addr').val(ui.item.value);
                    $('.search_latitude').val(ui.item.lat);
                    $('.search_longitude').val(ui.item.lon);
                    var latlng = new google.maps.LatLng(ui.item.lat, ui.item.lon);
                    marker.setPosition(latlng);
                    
                    initMap(16);
                }
            });
        });
        
        /*
         * Point location on google map
         */
        $('.get_map').click(function (e) {
            var address = $(PostCodeid).val();
            geocoder.geocode({'address': address}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                    marker.setPosition(results[0].geometry.location);
                    $('.search_addr').val(results[0].formatted_address);
                   

                    $('.search_latitude').val(marker.getPosition().lat());
                    $('.search_longitude').val(marker.getPosition().lng());
                } else {
                    alert("Geocode was not successful for the following reason: " + status);
                }
            });
            e.preventDefault();
        });
    
        //Add listener to marker for reverse geocoding
        /*google.maps.event.addListener(marker, 'drag', function () {
            geocoder.geocode({'latLng': marker.getPosition()}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        $('.search_addr').val(results[0].formatted_address);
                        $('.search_latitude').val(marker.getPosition().lat());
                        $('.search_longitude').val(marker.getPosition().lng());
                    }
                }
            });
        });*/
    });
    </script>
    
@include('MapsApi')

</html>
