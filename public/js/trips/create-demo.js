$(document).ready(function() {

    //console.log( "ready!" );

});

"use strict";

var marker;
var marker = [];


function initMap() {

    var thanhHoa = {lat: 20.351387, lng: 105.221214};
    var haNoi = new google.maps.LatLng(21.020448, 105.779711);

    // Đối tương map
    var map = new google.maps.Map(document.getElementById('googleMap'), {
        zoom: 6,
        center: haNoi, // set lat lng map center
    });

    // Đối tương marker
    // var marker = new google.maps.Marker({
    //     //position:thanhHoa,
    //     //map: map
    // });


    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer;

    // put address search box into map
    var input = document.getElementById('pac-input');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    var searchBox = new google.maps.places.SearchBox(input);


    // create directions renderer and bind it to map
    var directionsDisplay = new google.maps.DirectionsRenderer({
        map: map
    });


    // listen to and respond to address search
    var onChangeHandler = function() {

        var locations = searchBox.getPlaces();

        console.log(locations);

        //debugger

        //console.log(locations[0].formatted_address);
        var formattedAddress = locations[0].name;

        var html = '<tr>'+
                        '<td class="text-center">'+formattedAddress+'</th>'+
                        '<td class="text-center"></td>'+
                        '<td class="text-center"></td>'+
                        '<td class="text-center"></td>'+
                        '<td class="text-center"><a href="javascript:;">Cancel</a></td>'+
                        '<td class="text-center"><a href="javascript:;">Add</a></td>'+
                    '</tr>';

        $('.tbody').append(html);

        console.log('Location: ' + locations[0].name);
        var start = locations[0].place_id; // ex: ChIJUa5kNFsMNTER-QKRdLk1MBo
        console.log('Start_id: ' + start);

        //var bounds = new google.maps.LatLngBounds();

        // Objects
        var latlng = {lat:locations[0].geometry.location.lat(), lng: locations[0].geometry.location.lng()};
        
        console.log(latlng);


        //showAddressWhenClick(map,latlng);

        // marker = new google.maps.Marker({
        //     position:latlng,
        //     map: map
        // });

        // var marker = showAddressWhenClick(map,latlng);

        // markers.push(showAddressWhenClick(map,latlng));
        // setTimeout(function(){ console.log('array markers: '+markers); }, 5000);
        

        
        //map.fitBounds(bounds);
        map.setZoom(15);
        
        //calculateAndDisplayRoute(directionsDisplay, directionsService, start, latlng);

    };

    google.maps.event.addListener(searchBox, 'places_changed', onChangeHandler);
}


function calculateAndDisplayRoute(directionsDisplay, directionsService, start, latlng) {
    directionsService.route({
        origin: { // start
            placeId: start
        },
        destination: { // end
            location: latlng
        },
        travelMode: google.maps.TravelMode.DRIVING
    }, function(response, status) {
        if (status === google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });
}


// Vẽ đường đi 2 điểm trên map
function direction2Marker(map)
{
    // Khai báo các biến và đối tượng cần thiết
    var fromLatitude = 21.011569299999998;
    var fromLongitude = 105.8478906;
    var toLatitude = 21.014199;
    var toLongitude = 105.848317;

    // var directionsService = new google.maps.DirectionsService();
    // var directionsDisplay = new google.maps.DirectionsRenderer();
    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer;

    directionsDisplay.setMap(map);

    var request = {
        origin: new google.maps.LatLng(fromLatitude, fromLongitude), // From
        destination: new google.maps.LatLng(toLatitude, toLongitude), // To
        travelMode: google.maps.TravelMode.DRIVING
    };

    directionsService.route(request, function(result, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(result);
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });

}

// get Lat Lng of marker
function showLatLngMapCenter(map)
{
    var location = map.getCenter(); //Trả về kinh độ/vĩ độ (lat/lng) của trung tâm bản đồ
    return {lat:location.lat(), lng:location.lng()}; // object
}


// show address 
function showAddressWhenClick(map,latlng)
{
    var geocoder = new google.maps.Geocoder; // chuyển từ tọa độ sang thông tin chi tiết 
    var infowindow = new google.maps.InfoWindow; //show 1 InfoWindow là 1 đoạn text cho 1 marker

    geocoder.geocode({'location':latlng} , function(results, status){
        if(status == 'OK') {
            if(results[0]){
                map.setZoom(12);
                console.log(latlng);
                xmarker = new google.maps.Marker({
                    position:latlng,
                    map: map
                });
                infowindow.setContent(results[0].formatted_address);
                infowindow.open(map, xmarker);
                marker=xmarker;
                //console.log('Marker: ' +marker);
                
            } else {
                alert('No results found')
            }
        } else {
            window.alert('Geocoder failed due to: ' + status);
        }
    });

    console.log(marker);
    //return marker;
}





    
    // don't delete below line
    // map.addListener('click', function(e) {

    //     // get lat lng when click
    //     var latlng = {lat:e.latLng.lat(), lng: e.latLng.lng()};
        
    //     showAddressWhenClick(this,latlng);

    // });