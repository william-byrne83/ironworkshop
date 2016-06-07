function initialize() {

    var title = jQuery('#map-location').data('title');
    var location = jQuery('#map-location').data('location');
    var lat = jQuery('#map-location').data('lat');
    var lang = jQuery('#map-location').data('lang');

    var locations = [
        ['<p><strong>Iron Workshop</strong><br/>'+
        location+'</p>', lat, lang, 1]
    ];


    var map = new google.maps.Map(document.getElementById('map-location'), {
        zoom: 15,
        scrollwheel: false,
        center: new google.maps.LatLng(lat,lang),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map,
            icon: '/assets/images/map-icon.png'
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infowindow.setContent(locations[i][0]);
                infowindow.open(map, marker);
            }
        })(marker, i));
    }

    <!--styles-->
    var styles = [
        {
            stylers: [
                { "saturation": -120 },
                { "lightness": -1 },
                { "gamma": 1.2 }
            ]
        },{
            featureType: "road",
            elementType: "geometry",
            stylers: [
                { lightness: 500 },
                { visibility: "simplified" }
            ]
        },{
            featureType: "road",
            elementType: "labels",
            stylers: [
                { visibility: "off" }
            ]
        }
    ];

    map.setOptions({styles: styles});

}