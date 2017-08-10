// $( document ).ready(function() {





// });


"use strict";

var trip_id = $('#trip_id').val();
var user_id = $('#user_id').val();
var avatar  = $('#avatar').val();
var username= $('#username').val();

$('.link-show-comment').click(function(){

	var selectParent = $(this).closest('.area-comment');

    var trip_id = selectParent.find('.form-comment').data('form');

    $('.detail-comment').toggle();

});


$(".text_comment").on("keydown",function search(e) {

    if(e.keyCode == 13) {

    	var content, url_request, data, comment_id, parent_cmt_id;

    	parent_cmt_id = $(this).closest('.content-cmt').attr('id');

        content = $(this).val();

        url_request = window.location.origin + '/comment';

        data = {"user_id":user_id, 'trip_id':trip_id, "content":content};

        if(content == '') {
        	
        	alert('you must enter some text to comment');

        } else {

        	$.ajax({
	            url:url_request,
	            type:"post",
	            dataType:"json",
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            data: data,              
	            success:function(res){

	            	comment_id = res;
                
                	console.log('Added comment with id: ' + comment_id);

                	var html =  '<div class="content-cmt" id="'+comment_id+'">' + 
	                				'<div class="avatar-owner">' +
	                					'<img src="/'+avatar+'" height="34px">'+
	                                '</div>'+
	                                '<div class="input-group" data-parent-id="'+comment_id+'">' +
	                                	'<span class="username-cmt">'+username+'</span>' + 
	                                    '<span>'+content+'</span>' +
	                                    '<div class="action action-reply">' +
	                                    	'<a href="javascript:;" class="link-like">Like</a>' + 
	                                    	'<a href="javascript:;" class="link-show-form-sub-comment">Reply</a>' + 
	                                    	'<a href="javascript:;" class="link_delete_comment">Delete</a>'+
	                                    '</div>' +
	                                '</div>' +
                                '</div>' ;

                                // EOF<<form class="form-comment-reply">' +
                                //             <div class="avatar-owner">
                                //                 <img src="{{asset($avatar)}}" width="24px">
                                //             </div>
                                //             <div class="input-group">
                                //                 <input type="text" class="form-control text_sub_comment" placeholder="Comment here" name="content">
                                //                 <span class="input-group-btn">
                                //                     <button class="btn btn-default" type="button">
                                //                         <i class="fa fa-picture-o" aria-hidden="true"></i>
                                //                     </button>
                                //                 </span>
                                //             </div>
                                //         </form>';

                    $('.comment_area').append(html);

                	//process delete parent comment
					$('.link_delete_comment').click(function(){
					    deleteParentComment(this);
					});


					$('.link-show-form-sub-comment').click(function(){
					    showFormSubComment(this);
					});

		        },
	            error: function( req, status, err ) {
	                console.log( 'Error: ' + err );
	                console.log( "Status: " + status );
	                console.log( "Response: " + req );
	            }
        	});

        }

        $(this).val(''); // empty input text after user enter press

        return false; //tai sao lai co dong code nay
    }

});



function showFormSubComment(element)
{
    var parent_comment_id = $(element).closest('.input-group').attr('data-parent-id');
    $(element).closest('.content-cmt').find('.form-comment-reply').show();
}


$('.link-show-form-sub-comment').click(function(){

    showFormSubComment(this);

});

$(".text_sub_comment").on("keydown",function search(e) {

    if(e.keyCode == 13) {

    	var content, url_request, data, parent_cmt_id, comment_id;

    	content = $(this).val();

    	parent_cmt_id = $(this).closest('.content-cmt').attr('id');

        data = {"user_id":user_id, 'trip_id':trip_id, "content":content, "parent_cmt_id":parent_cmt_id};

        if(content == '') {
        	
        	alert('you must enter some text to comment');

        } else {

        	url_request = window.location.origin + '/comment';

        	$.ajax({
	            url:url_request,
	            type:"post",
	            dataType:"json",
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            data: data,              
	            success:function(res){

	            	comment_id = res;
                
                	console.log('Added sub comment with id: ' + comment_id);

                	var html = 	'<div class="content-sub-comment">' + 
                					'<div class="avatar-owner">' +
                						'<img src="/'+avatar+'" width="24px">' + 
                					'</div>' + 
                					'<div class="input-group" data-parent-id="'+parent_cmt_id+'">' +
                						'<span class="username-cmt">'+username+'</span>' +
                						'<span>'+content+'</span>' +
                						'<div class="action action-reply">' +
                							'<a href="javascript:;" class="link-like">Like</a>' +
                                            '<a href="javascript:;" class="link-show-form-sub-comment">Reply</a>' +
                                            '<a href="javascript:;" class="link_delete_sub_comment" data-sub-comment-id="'+comment_id+'">Delete</a>' +
                						'</div>' +	
                					'</div>' +	
                				'</div>' ;


                    $('.sub_comment_area_'+parent_cmt_id).append(html); 

                    //process delete parent comment
					$('.link_delete_sub_comment').click(function(){
						deleteSubComment(this);
					});

	            },
	            error: function( req, status, err ) {
	                console.log( 'Error: ' + err );
	                console.log( "Status: " + status );
	                console.log( "Response: " + req );
	            }
        	});

        }

        
        $(this).val(''); // empty input text after user enter press

        return false; //tai sao lai co dong code nay
    }

});


function deleteParentComment(element) 
{
	var comment_id, url_request;

	comment_id = $(element).closest('.content-cmt').attr('id');// id comment you want to delete

	console.log('Ban muon xoa cmt co id: ' + comment_id);

	url_request = window.location.origin + '/comment/delete/'+comment_id;

	if (confirm("Are you sure?")) {

        $('#'+comment_id+'').remove();

        $.ajax({
	        type:"post",
	        url:url_request,
	        dataType:"json",
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        data: {"comment_id":comment_id},

	        success:function(res){

	            var status = res.status;

	            console.log('deleted comment id '+comment_id);

	        },
	        error: function( req, status, err ) {
	            console.log( 'Error: ' + err );
	            console.log( "Status: " + status );
	            console.log( "Response: " + req );
	        }
	    });
    }

}

//process delete parent comment
$('.link_delete_comment').click(function(){
    deleteParentComment(this);
});


function deleteSubComment(element) 
{
	var sub_comment_id;

	sub_comment_id = $(element).attr("data-sub-comment-id");

	console.log('Ban muon xoa sub cmt co id: ' + sub_comment_id);

	if (confirm("Are you sure?")) {

        $(element).closest('.content-sub-comment').remove();

        $.ajax({
	        type:"post",
	        url:'/comment/delete/'+sub_comment_id,
	        dataType:"json",
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	       data : {"sub_comment_id": sub_comment_id},

	        success:function(res){

	            var status = res.status;

	            console.log('deleted comment id '+sub_comment_id);

	        },
	        error: function( req, status, err ) {
	            console.log( 'Error: ' + err );
	            console.log( "Status: " + status );
	            console.log( "Response: " + req );
	        }
	    });
    }

}

$('.link_delete_sub_comment').click(function(){
	deleteSubComment(this);
});