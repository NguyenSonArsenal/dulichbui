var trip_id = $('#trip_id').val();
var user_id = $('#user_id').val();


// process upload cover image for trip
$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 550,
        height: 200,
        type: 'square'
    },
    boundary: {
        width: 600,
        height: 300
    }
});

$('#upload').on('change', function () { 
	var reader = new FileReader();
    reader.onload = function (e) {
    	$uploadCrop.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
    		//console.log('jQuery bind complete');
    	});
    	
    }
    reader.readAsDataURL(this.files[0]);
});

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');



$('.upload-result').on('click', function (ev) {
	$uploadCrop.croppie('result', {
		type: 'canvas',
		size: 'viewport'
	}).then(function (resp) {
		$.ajax({
			url: '/trips/update-cover',
            //url: "{{ URL::route('postToUpdateCoverTrip') }}",
			type: "post",
			dataType:"json",
			headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			data: {"image":resp, "trip_id":trip_id},
			success: function (res) {
                if(res['success']) {
                    console.log(res['success']);
				    location.reload();
                }
			},
			error: function( req, status, err ) {
        		console.log( 'Error: ' + err );
		        console.log( "Status: " + status );
		        console.log( "Response: " + req );
     		}
		});
	});

});
// end process upload cover image


// process #


$('.join-trip').click(function(){

    console.log('clicked to attend trip');

    console.log('User_id: ' + user_id);
    console.log('Trip_id: ' + trip_id);

    data = {'user_id': user_id, 'trip_id': trip_id, 'status': 'request-join-trip'};

    $.ajax({
        url: '/trips/join-trip',
        type: "post",
        dataType:"json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: data,
        success: function (res) {
            location.reload();
            // if(res['success']) {
            //     console.log(res['success']);
                
            // }
        },
        error: function( req, status, err ) {
            console.log( 'Error: ' + err );
            console.log( "Status: " + status );
            console.log( "Response: " + req );
        }
    });
});

$('.exit-trip').click(function(){

    //console.log('clicked to exit trip');

    //console.log('User_id: ' + user_id);
    //console.log('Trip_id: ' + trip_id);
    if(confirm("Are you sure?")){
        data = {'user_id': user_id, 'trip_id': trip_id, 'status': 'request-exit-trip'};

        $.ajax({
            url: '/trips/join-trip',
            type: "post",
            dataType:"json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            success: function (res) {
                location.reload();
            },
            error: function( req, status, err ) {
                console.log( 'Error: ' + err );
                console.log( "Status: " + status );
                console.log( "Response: " + req );
            }
        });
    }

    
});

$('.cancel-watting-join-trip').click(function(){

    //console.log('clicked to cancel-watting-join-trip');

    console.log('User_id: ' + user_id);
    console.log('Trip_id: ' + trip_id);

    data = {'user_id': user_id, 'trip_id': trip_id, 'status': 'request-cancel-watting-join-trip'};
    if(confirm("Are you sure?")){
        $.ajax({
            url: '/trips/join-trip',
            type: "post",
            dataType:"json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            success: function (res) {
                location.reload();
            },
            error: function( req, status, err ) {
                console.log( 'Error: ' + err );
                console.log( "Status: " + status );
                console.log( "Response: " + req );
            }
        });
    }
});

$('.btn-accept').click(function() {
    console.log('clicked btn accepted');
    var selectParent = $(this).parentsUntil('#menu1');
    var user_id = selectParent.find('.img').data('user');
    var url_request = window.location.origin + '/trips/cancel-or-accept-user-join-trip';

    data = {'user_id': user_id, 'trip_id': trip_id, 'status': 'request-accept-user-join-trip'};

    console.log(trip_id, user_id, url_request);

    $.ajax({
        url: url_request,
        type: "post",
        dataType:"json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:data,
        success: function (res) {
            location.reload();
        },
        error: function( req, status, err ) {
            console.log( 'Error: ' + err );
            console.log( "Status: " + status );
            console.log( "Response: " + req );
        }
    });
});


$('.btn-cancel').click(function(){
    console.log('clicked btn cancel');
    var selectParent = $(this).parentsUntil('#menu1');
    var user_id = selectParent.find('.img').data('user');
    var url_request = window.location.origin + '/trips/cancel-or-accept-user-join-trip';

    data = {'user_id': user_id, 'trip_id': trip_id, 'status': 'request-cancel-user-join-trip'};

    console.log(trip_id, user_id, url_request);

    if(confirm("Are you sure?")){
        $.ajax({
            url: url_request,
            type: "post",
            dataType:"json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:data,
            success: function (res) {
                location.reload();
            },
            error: function( req, status, err ) {
                console.log( 'Error: ' + err );
                console.log( "Status: " + status );
                console.log( "Response: " + req );
            }
        });
    }
        
    

    
});

