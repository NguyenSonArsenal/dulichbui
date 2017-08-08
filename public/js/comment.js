"use strict";

//$('.form-comment').hide();

$('.link-show-comment').click(function(){

	var selectParent = $(this).closest('.area-comment');

	console.log(selectParent);

    var trip_id = selectParent.find('.form-comment').data('form');

    console.log(trip_id);

    $('.detail-comment').toggle();

    //$('#form_' + trip_id).toggle();
    
});