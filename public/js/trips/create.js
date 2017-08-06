"use strict";


var user_id = $('#user_id').val();

$('#datetimepicker-time-start-trip').datetimepicker({
    format: 'YYYY-MM-DD HH:mm',
});

$('#datetimepicker-time-end-trip').datetimepicker({
    format: 'YYYY-MM-DD HH:mm',
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

	var place_id, position, formattedAddress, lat, lng;

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

            lat = position.lat();
            lng = position.lng()

            marker = new google.maps.Marker({
                title: place.name,
                //map: map,
                position: place.geometry.location
            });

            markers.push(marker);

            //console.log(markers[count_markers]);

            var html = 
                    '<tr>'+
                        '<td class="text-center">'+count_markers+'</td>'+
                        '<td class="text-center">'+formattedAddress+'</td>'+
                        '<td class="text-center">'+
                            '<input type="text" name="time" value=""  id="datetimepicker_'+count_markers+'"  class="form-control time_'+count_markers+'" placeholder="dd/mm/yyyy HH:mm">'+
                            '<div class="show_error text-danger error_time_'+count_markers+'"></div>'+
                        '</td>'+
                        '<td class="text-center">'+
                            '<input type="text" name="vehicle" value="" class="form-control vehicle_'+count_markers+'" placeholder="Bus, car, moto...">'+
                            '<div class="show_error text-danger error_vehicle_'+count_markers+'"></div>'+
                        '</td>'+
                        '<td class="text-center">'+
                            '<input type="text" name="activities" value="" class="form-control activities_'+count_markers+'" placeholder="eat, walking, stay...">'+
                            '<div class="show_error text-danger error_activities_'+count_markers+'"></div>'+
                        '</td>'+
                        '<input type="hidden" name="lat" value="'+lat+'" class="lat_'+count_markers+'" >'+
                        '<input type="hidden" name="lng" value="'+lng+'" class="lng_'+count_markers+'" >'+
                        '<td class="text-center cancel_'+count_markers+'"><a href="javascript:;">Cancel</a></td>'+
                        '<td class="text-center"><a href="javascript:;">Edit</a></td>'+
                    '</tr>';

        	$('.tbody').append(html);

            $('#datetimepicker_'+count_markers).datetimepicker({
                format: 'YYYY-MM-DD HH:mm',
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


function checkRequired(string, name_filed, class_name)
{
    if (string.length == 0) {
        $('.'+class_name).html('The '+name_filed+' is required');
    } else {
        $('.'+class_name).html(' ');
    }
}



function checkIputAjax(array)
{   

    var i, length;
    length = array.length;
    for(i=0; i<length; i++){
        if(array[i].length == 0) {
            return 'no';
        } else {
            return 'yes';
        }
    }
}


$('.btn-create-trip').click(function(){

    var count, i, data, trip_name, time_start, time_end ; 

    var time = [], vehicle = [], activities = [], lat = [], lng = [];   

    count = markers.length;


    trip_name  = $("#registrationTripForm input[name='name']").val();
    time_start = $("#registrationTripForm input[name='time_start']").val();
    time_end   = $("#registrationTripForm input[name='time_end']").val();


    checkRequired(trip_name,'trip_name', 'error_trip');
    checkRequired(time_start, 'time_start', 'error_time_start');
    checkRequired(time_end, 'time_end', 'error_time_end');


    for (i=0; i<count; i++) {

        time[i] = $('.time_'+i).val();
        checkRequired(time[i],'filed', 'error_time_'+i);

        vehicle[i] = $('.vehicle_'+i).val();  
        checkRequired(vehicle[i],'filed', 'error_vehicle_'+i);

        activities[i] = $('.activities_'+i).val();
        checkRequired(activities[i],'filed', 'error_activities_'+i);  

        lat[i] = $('.lat_'+i).val();
        lng[i] = $('.lng_'+i).val();
   
    }

    if(trip_name.length > 0 && time_start.length > 0 && time_end.length > 0 && count == 0){
        alert('Please enter some location you want to visit !!!');
    }

    if(trip_name.length > 0 && time_start.length > 0 && time_end.length > 0 
        && checkIputAjax(time) =='yes' && checkIputAjax(vehicle) == 'yes' && checkIputAjax(activities) == 'yes'  ) {

        //console.log('passed all input to send ajax !!!');

        data = {"user_id":user_id ,"trip_name":trip_name, 'time_start':time_start , 'time_end':time_end, 'time':time, 
                'vehicle':vehicle, 'activities':activities, 'lat':lat, 'lng':lng};

        $.ajax({
            type:"post",
            url:'/trips',
            dataType:"json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:data,

            success:function(res){

                //console.log(typeof(res)); // obj

                if(res['success']) {

                    console.log(res['success']);

                } else {

                    if(res['errors']){

                        $('.error_trip').html(res['errors'].trip_name);

                        $('.error_time_start').html(res['errors'].time_start);
                        
                        $('.error_time_end').html(res['errors'].time_end);

                        $('.error_trip_time').html('Something time wrong<i class="fa fa-close" style="padding-left: 20px"></i>');

                        $('.error_vehicle').html('Something wrong<i class="fa fa-close" style="padding-left: 20px"></i>');

                        $('.error_activities').html('Something wrong<i class="fa fa-close" style="padding-left: 20px"></i>');
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
