$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 200,
        height: 200,
        type: 'square'
    },
    boundary: {
        width: 300,
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

var id = $('#id').val();
// var id = $user->id;
//var id = "<?php echo $user->id; ?>";

$('.upload-result').on('click', function (ev) {
	$uploadCrop.croppie('result', {
		type: 'canvas',
		size: 'viewport'
	}).then(function (resp) {
		$.ajax({
			url: '/imagecrop',
			type: "post",
			dataType:"text",
			headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			data: {"image":resp, "id":id},
			success: function (data) {
				if(data == 'success')
					location.reload();
			},
			error: function( req, status, err ) {
        		console.log( 'Error: ' + err );
		        console.log( "Status: " + status );
		        console.log( "Response: " + req );
     		}
		});
	});

});

