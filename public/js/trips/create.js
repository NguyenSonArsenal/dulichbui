"use strict";






/*
Marker: 
    + possiton: vị trí marker hiển thị trên bản đồ
    + map: bản đồ gán marker(oppition)
*/




var marker;
var markers = [];
var waypts = [];

function initMap() {

	var haNoi, marker, map, directionsService, directionsDisplay, count_markers;

	var place_id, position, formattedAddress;

	directionsService = new google.maps.DirectionsService;
    directionsDisplay = new google.maps.DirectionsRenderer;

	haNoi = new google.maps.LatLng(21.020448, 105.779711);

	 // Object map
    map = new google.maps.Map(document.getElementById('googleMap'), {
        zoom: 6,
        center: haNoi, // set lat lng map center
    });

    directionsDisplay.setMap(map);// display route on map

     // Create the search box and link it to the UI element.
    var input = document.getElementById('pac-input');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    var searchBox = new google.maps.places.SearchBox(input);

    map.addListener('bounds_changed', function() {
        searchBox.setBounds(map.getBounds()); // Dich chuyen man hinh sang khu vuc khac
    });

    searchBox.addListener('places_changed', function() {

        var places = searchBox.getPlaces(); 

        if (places.length == 0) {
            return;
        }

        //console.log(places.geometry.location);

        //var formattedAddress = places[0].name;
        //var place_id = places[0].place_id;

        
        // For each place, get the icon, name and location.
        var bounds = new google.maps.LatLngBounds();

        places.forEach(function(place) {


            if (!place.geometry) {
              	console.log("Returned place contains no geometry");
              	return;
            }


            count_markers = markers.length;

            // Add a marker to the map and push to the markers array.
            if(count_markers == 0) {
	            markers.push(new google.maps.Marker({
	              	map: map,
	              	title: place.name,
	              	position: place.geometry.location
	            }));	
            } else {
            	markers.push(new google.maps.Marker({
	              	title: place.name,
	              	position: place.geometry.location
	            }));

	            waypts = addMarkerToWaypts(markers);
            	displayRoute(directionsService, directionsDisplay, waypts, map);	
            	
            	markers.forEach(function(marker){
            		marker.addListener("dblclick", function() {
            			console.log(marker);
				    	marker.setMap(null);
					});	
            	});

            }

            formattedAddress = place.name;
            position = place.geometry.location;

            var html = '<tr>'+
                        '<td class="text-center">'+formattedAddress+'</th>'+
                        '<td class="text-center"></td>'+
                        '<td class="text-center"></td>'+
                        '<td class="text-center"></td>'+
                        '<td class="text-center cancel" data-place_id="' + count_markers + '"><a href="javascript:;">Cancel</a></td>'+
                    '</tr>';

        	$('.tbody').append(html);

            if (place.geometry.viewport) {
              	// Only geocodes have viewport.
              	bounds.union(place.geometry.viewport);
            } else {
              	bounds.extend(place.geometry.location);
            }

            

        });

        $('.cancel').click(function(e){

    		var place_id = $(this).data('place_id');

    		findMarker(place_id, markers);

    		$(this).parent().remove();
    	
    	});
         
        //$('.cancel_'+place_id+'').click(removeMarker);
        
        
        map.fitBounds(bounds); // show markers
        map.setZoom(12);

    });

}

function findMarker(place_id, markers)
{
	//console.log(markers);	
	console.log(place_id);
	console.log(markers[place_id]);
	var i;
	var count_markers = markers.length;

	for (i=0; i<count_markers; i++) {
		//console.log(markers[i]);
	}
}


function addMarkerToWaypts(markers)
{
	waypts.push({
        location: markers[markers.length-1].getPosition(),
        stopover: true
    });

	return waypts;

}

function displayRoute(directionsService, directionsDisplay, waypts, map)
{
	//console.log(markers[0].getPosition());
	//console.log(waypts);
	directionsService.route({
        origin: markers[0].getPosition(),
	    destination: markers[0].getPosition(),
        waypoints: waypts,
        optimizeWaypoints: true,
        travelMode: 'DRIVING'
        }, function(response, status) {
          	if (status === 'OK') {
            	directionsDisplay.setDirections(response);
           	} else {
            	window.alert('Directions request failed due to ' + status);
        }
    });
}




function removeMarker(place_id, markers)
{
	
}