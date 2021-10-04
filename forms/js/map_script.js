"use strict";


function googleMap() {
    if ($('.google-map').length) {
        $('.google-map').each(function () {
            // getting options from html 
            var Self = $(this);
            var mapName = Self.attr('id');
            var mapLat = Self.data('map-lat');
            var mapLng = Self.data('map-lng');
            var iconPath = Self.data('icon-path');
            var mapZoom = Self.data('map-zoom');
            var mapTitle = Self.data('map-title');


            var styles = [
                {
                    "featureType": "administrative",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#444444"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#f2f2f2"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#e4e3e3"
                        }
                    ]
                },
                {
                    "featureType": "landscape.man_made",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#797979"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": -100
                        },
                        {
                            "lightness": 45
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#d8d7d7"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#acabab"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#e1e0e0"
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                }
            ]


            // if zoom not defined the zoom value will be 15;
            if (!mapZoom) {
                var mapZoom = 12;
            }
            ;
            // init map
            var map;
            map = new GMaps({
                div: '#' + mapName,
                scrollwheel: false,
                lat: mapLat,
                lng: mapLng,
                styles: styles,
                zoom: mapZoom
            });
            // if icon path setted then show marker
            if (iconPath) {

                map.addMarker({
                    icon: iconPath,
                    lat: 40.925372,
                    lng: -74.276544,
                    title: 'Fedrex',
                    infoWindow: {
                        content: '<h6>Head office 12 sector 7</h6> <p>Ada Rood-15 H#12 Texas, USA</p>'
                    }
                });
            }
        });
    }
    ;
}


// Dom Ready Function
jQuery(document).on('ready', function () {
    (function ($) {
        // add your functions
        googleMap();
    })(jQuery);
});

