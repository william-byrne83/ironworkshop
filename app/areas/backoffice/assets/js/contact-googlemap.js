jQuery(document).ready(function(){
    var lastMarker;  //lastmarker is needed to remove previous markers

    function initMap() {
        var lat = $("#lat").val();
        var long = $("#lang").val();

        if(lat != false && long != false){
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(lat, long),
                map: map
              });
        }else{
            lat = 53.4785438
            long = -2.1138864
        }

        var mapOptions = {
            zoom: 15,
            center: new google.maps.LatLng(lat, long)
        }


        var map = new google.maps.Map(document.getElementById("map_right"), mapOptions);

         if(lat != false && long != false){
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(lat, long),
                map: map
            });
            lastMarker = marker;
        }




        map.addListener('click', function (e) {
            updateLatLng(e.latLng, map);
        });

        $("#lat").change(function () {
            var lat = $("#lat").val();
            var long = $("#lang").val();
            var latLng = new google.maps.LatLng(lat, long);
            updateLatLng(latLng, map);
        });

        $("#lang").change(function () {
            var lat = $("#lat").val();
            var long = $("#lang").val();
            var latLng = new google.maps.LatLng(lat, long);
            updateLatLng(latLng, map);
        });
    }


    function updateLatLng(latLng, map){
        var marker = new google.maps.Marker({
            position: latLng,
            map: map
        });

        if (typeof lastMarker !== 'undefined') {
            lastMarker.setMap(null);
        }

        lastMarker = marker;
        map.panTo(latLng);

        var myLatLng = latLng;
        var lat = myLatLng.lat();
        var lng = myLatLng.lng();
        $("#lat").val(lat);
        $("#lang").val(lng);
    }

    initMap();
});