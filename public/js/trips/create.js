"use strict";


$('#datetimepicker-time-start-trip').datetimepicker({
    format: 'DD-MM-YYYY HH:mm',
});

$('#datetimepicker-time-end-trip').datetimepicker({
    format: 'DD-MM-YYYY HH:mm',
});


function getIdFromClassName(id)
{


    var tmp = id.slice(-3);

    var first_string = tmp.charAt(0);
    
    if (first_string=='_') {

        return id.slice(-2);
    
    } return id.slice(-1);
 
}


/*
Marker: 
    + possiton: vị trí marker hiển thị trên bản đồ
    + map: bản đồ gán marker(oppition)
*/


var marker;
var map;
var markers = [];
var waypts = [];

var directionsService;
var directionsDisplay;

function initMap() {

	var haNoi, marker, map, directionsService, directionsDisplay, count_markers;

	var place_id, position, formattedAddress;

	directionsService = new google.maps.DirectionsService;//=1
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

        var places = searchBox.getPlaces();  // Object

        if (places.length == 0) {
            return;
        }

        // For each place, get the icon, name and location.
        var bounds = new google.maps.LatLngBounds();

        places.forEach(function(place) {

            if (!place.geometry) {
              	console.log("Returned place contains no geometry");
              	return;
            }

            count_markers = markers.length;

            formattedAddress = place.name;
            position = place.geometry.location;

            marker = new google.maps.Marker({
                title: place.name,
                //map: map,
                position: place.geometry.location
            });

            markers.push(marker);

            console.log(markers[count_markers]);

            var html = 
                    '<tr>'+
                        '<td class="text-center">'+count_markers+'</td>'+
                        '<td class="text-center">'+formattedAddress+'</td>'+
                        '<td class="text-center">'+
                            '<input type="text" name="time" value=""  id="datetimepicker_'+count_markers+'"  class="form-control time_'+count_markers+'" placeholder="dd/mm/yyyy HH:mm">'+
                        '</td>'+
                        '<td class="text-center">'+
                            '<input type="text" name="vehicle" value="" class="form-control vehicle_'+count_markers+'" placeholder="Bus, car, moto...">'+
                        '</td>'+
                        '<td class="text-center">'+
                            '<input type="text" name="activities" value="" class="form-control activities_'+count_markers+'" placeholder="eat, walking, stay...">'+
                        '</td>'+
                        '<td class="text-center cancel_'+count_markers+'"><a href="javascript:;">Cancel</a></td>'+
                        '<td class="text-center"><a href="javascript:;">Edit</a></td>'+
                    '</tr>';

        	$('.tbody').append(html);

            $('#datetimepicker_'+count_markers).datetimepicker({
                format: 'DD-MM-YYYY HH:mm',
            });

            if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }

        }); //end places.forEach

        console.log('marker init()');
        console.log(markers);

        waypts = addMarkerToWaypts(markers);

        displayRoute(directionsService, directionsDisplay, waypts, map);  


        $('.cancel_'+count_markers).click(function(e){
            
            var marker_id = getIdFromClassName($(this).attr('class'));

            $(this).parent().remove();

            //deleteMarker(marker_id, markers);


        });

        map.fitBounds(bounds); // show markers
        map.setZoom(12);

    });



}





function deleteMarker(marker_id, markers) {

    // tìm được marker_id của marker trong mảng marker oy dùng hàm splice để xóa marker_id
    
    console.log(markers[marker_id]);

    markers.splice(markers[marker_id],1);

    console.log(markers);

    // waypts = updateWaypts(); 
    
    // displayRoute(directionsService, directionsDisplay, waypts, map);

}

function findMarker(place_id, markers)
{
	console.log('place_id: '+place_id);
	console.log(markers[place_id]);

	var i;
	var count_markers = markers.length;
	
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

//end process logic map


// Process logic

$('.btn-create-trip').click(function(){

    var count, i, data, trip_name, time_start, time_end ;    

    count = markers.length;

    trip_name = $("#registrationTripForm input[name='name']").val();
    time_start = $("#registrationTripForm input[name='time_start']").val();
    time_end = $("#registrationTripForm input[name='time_end']").val();


    if(trip_name.length == 0) {
        $('.error_trip').html('The trip_name is required');
    } else {
        $('.error_trip').html('');
    }

    if(time_start.length == 0) {
        $('.error_time_start').html('The time_start is required');
    } else {
        $('.error_time_start').html('');
    }

    if(time_end == 0) {
        $('.error_time_end').html('The time_end is required');
    } else {
        $('.error_time_end').html('');
    }

    if(trip_name.length > 0 && time_start.length > 0 && time_end.length > 0) {

        data = {"trip_name":trip_name, 'time_start':time_start , 'time_end':time_end};

        console.log('passed !!!');

        $.ajax({
            type:"post",
            url:'/trips',
            dataType:"json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:data,

            success:function(res){

                console.log(typeof(res));

                if(res['success']) {

                    console.log(res['success']);

                } else {

                    if(res['errors']){

                        $('.error_trip').html(res['errors'].trip_name);

                        $('.error_time_start').html(res['errors'].time_start);
                        
                        $('.error_time_end').html(res['errors'].time_end);
                    }

                }

                // var str = JSON.stringify(res); // obj->string 

            },
            error: function( req, status, err ) {
                console.log( 'Error: ' + err );
                console.log( "Status: " + status );
                console.log( "Response: " + req );
            }
        });
        //end ajax
    } 

    // for (i=0; i<count; i++) {
    //     console.log($('.time_'+i).val());
    //     console.log($('.vehicle_'+i).val());
    //     console.log($('.activities_'+i).val());
    // }

    

    
});



//validation form
$('#registrationTripForm123').formValidation({
    framework: 'bootstrap',
    icon: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
        name: {
            validators: {
                notEmpty: {
                    message: 'The username is required'
                },
                stringLength: {
                    min: 3,
                    max: 50,
                    message: 'The username must be more than 1 and less than 50 characters long'
                },
            }
        }
        // time_start: {
        //     validators: {
        //         notEmpty: {
        //             message: 'The time_start is required'
        //         },
        //     }
        // },
        // time_end: {
        //     validators: {
        //         notEmpty: {
        //             message: 'The time_end is required'
        //         },
        //     }
        // },
    }
});
