var user_id = $('#user_id').val();
var avatar 	= $('#avatar').val();
var username= $('#username').val();
var trip_id = $('#trip_id').val();

function xuliId(id)
{
	id=	$.trim(id);

	ids = id.split('_');

	need_id = ids.length - 1;

	return ids[need_id];
}



// process parent comment

$('.comments').hide();

$('.link-show-comment').click(function(){
	var trip_id = $(this).parent().parent().attr('id');
	var id = trip_id.substr(trip_id.length - 1);
	$('.comments_' + id).show();
});


$(".text_comment").on("keydown",function search(e) {
    if(e.keyCode == 13) {

    	var content = $(this).val();

    	var trip_id = $(this).parent().parent().attr('id');
    	var trip_id = xuliId(trip_id);

    	
    	
    	console.log('user_id: '+user_id);
    	console.log('trip_id: '+trip_id);
    	console.log('content: '+content);

    	var html = '<div class="content-cmt">' + 
		           		'<div class="avatar-owner">' + 
		           			'<img src="'+avatar+'" height="34px">'+
		           		'</div>'+
		           		'<div class="input-group">'+
		           			'<span class="username-cmt">'+username+'</span>'+
		           			'<span>'+content+'</span>'+
		           			'<div class="action action-reply">'+
		           				'<a href="javascript:;" class="link-like">Like</a>'+
		           				'<a href="javascript:;" class="link-show-form-sub-comment">Reply</a>'+
		           			'</div>'+
		           		'</div>'+
		           '</div>';

    	$('.comment_area_'+trip_id).append(html); 


    	$.ajax({
		    type:"post",
		    url:'/comment',
		    dataType:"text",
		    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
		    data: {"user_id":user_id, 'trip_id':trip_id, "content":content },                
		    success:function(res){
		       console.log(res);
		    },
		    error: function( req, status, err ) {
        		console.log( 'Error: ' + err );
		        console.log( "Status: " + status );
		        console.log( "Response: " + req );
     		}
		});
		
		$(this).val('');

    	return false;
    }
});



// process sub comment

$('.form-comment-reply').hide();


$('.link-show-form-sub-comment').click(function(){

	var comment_id = $(this).parent().parent().attr('class');
	var comment_id = xuliId(comment_id);
	console.log('Comment_id : ' + comment_id);
	$('.form-comment-reply-'+comment_id).show();

});


$(".text_sub_comment").on("keydown",function search(e) {
    if(e.keyCode == 13) {

    	var content = $(this).val();

    	var parent_cmt_id = $(this).parent().parent().attr('class');
    	var parent_cmt_id = xuliId(parent_cmt_id);

    	var trip_id = $(this).parent().parent().attr('id');
    	var trip_id = xuliId(trip_id);
    	
    	
    	console.log('user_id: '+user_id);
    	console.log('trip_id: '+trip_id);
    	console.log('parent_cmt_id: '+parent_cmt_id);
    	console.log('content: '+content);

    	var html = '<div class="content-sub-comment">' + 
		           		'<div class="avatar-owner">' + 
		           			'<img src="'+avatar+'" height="34px">'+
		           		'</div>'+
		           		'<div class="input-group sub-comment form_{{$comment->id}}">'+
		           			'<span class="username-cmt">'+username+'</span>'+
		           			'<span>'+content+'</span>'+
		           			'<div class="action action-reply">'+
		           				'<a href="javascript:;" class="link-like">Like</a>'+
		           				'<a href="javascript:;" class="link-show-form-sub-comment">Reply</a>'+
		           			'</div>'+
		           		'</div>'+
		           '</div>';

    	$('.sub_comment_area_'+parent_cmt_id).append(html); 


    	$.ajax({
		    type:"post",
		    url:'/comment',
		    dataType:"text",
		    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
		    data: {"user_id":user_id, 'trip_id':trip_id,"parent_cmt_id":parent_cmt_id , "content":content },                
		    success:function(res){
		       console.log(res);
		    },
		    error: function( req, status, err ) {
        		console.log( 'Error: ' + err );
		        console.log( "Status: " + status );
		        console.log( "Response: " + req );
     		}
		});
		
		$(this).val('');

    	return false;
    }
});

