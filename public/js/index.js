var user_id = $('#user_id').val();
var avatar  = $('#avatar').val();
var username= $('#username').val();
var trip_id = $('#trip_id').val();

function xuliId(id)
{
    id= $.trim(id);

    ids = id.split('_');

    need_id = ids.length - 1;

    return ids[need_id];
}


function xiLiClassName(class_name){

    class_name = $.trim(class_name);

    names = class_name.split(' ');

    need_name = names.length - 1 ;

    return names[need_name];

}



function deleteComment(element)
{

    var sub_comment_class_name = $(element).parent().parent().parent().attr('class');
    sub_comment_class_name = xiLiClassName(sub_comment_class_name);

    alert(sub_comment_class_name);

    comment_id = xuliId(sub_comment_class_name);

    alert(comment_id);

    if (confirm("Are you sure?")) {
        $('.'+sub_comment_class_name+'').empty();
    }

    //debugger

    $.ajax({
        type:"post",
        url:'/comment/delete/'+comment_id,
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


function showFormSubComment(element)
{

    var comment_id = $(element).parent().parent().attr('class');
    var comment_id = xuliId(comment_id);

    $('.form-comment-reply-'+comment_id).show();

    console.log('showed form reply comment id = ' + comment_id);
}


// process parent comment

$('.link-show-comment').click(function(){
    var trip_id = $(this).parent().parent().attr('id');
    var id = trip_id.substr(trip_id.length - 1);
    console.log(id);
    $('.comments_' + id).toggle();
    //$('.comments').show();
});



$(".text_comment").on("keydown",function search(e) {

    if(e.keyCode == 13) {

        var content = $(this).val();

        var trip_id = $(this).parent().parent().attr('id');//form_1
        var trip_id = xuliId(trip_id);

        // console.log('user_id: '+user_id);
        // console.log('trip_id: '+trip_id);
        // console.log('content: '+content);

        $.ajax({
            type:"post",
            url:'/comment',
            dataType:"text",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {"user_id":user_id, 'trip_id':trip_id, "content":content },                
            success:function(res){

                var comment_id = res;
                
                console.log('Added comment with id: ' + comment_id);

                var html = '<div class="content-cmt comment_id_'+comment_id+'">' + 
                                '<div class="avatar-owner">' + 
                                    '<img src="'+avatar+'" height="34px">'+
                                '</div>'+
                                '<div class="input-group form_'+comment_id+'" id='+comment_id+'>'+
                                    '<span class="username-cmt">'+username+'</span>'+
                                    '<span>'+content+'</span>'+
                                    '<div class="action action-reply">'+
                                        '<a href="javascript:;" class="link-like">Like</a>'+
                                        '<a href="javascript:;" class="link-show-form-sub-comment">Reply</a>'+
                                        '<a href="javascript:;" class="link_delete_comment">Delete</a>'+
                                    '</div>'+
                                '</div>'+
                           '</div>'+

                           '<form style="margin-left:50px;" class="form-comment-reply form-comment-reply-'+comment_id+' comment_reply_'+comment_id+'" '+
                                'id="id_form_comment_reply_'+trip_id+'" >' +
                                '<div class="avatar-owner">' +
                                        '<img src="'+avatar+'" height="34px">' +
                                '</div>' +
                                '<div class="input-group">' +
                                    '<input type="text" class="form-control text_sub_comment" placeholder="Comment here" name="content">' +
                                    '<span class="input-group-btn">' +
                                        '<button class="btn btn-default" type="button">' +
                                            '<i class="fa fa-picture-o" aria-hidden="true"></i>' +
                                        '</button>' +
                                    '</span>' +
                                '</div>' +
                            '</form>' ;


                $('.comment_area_'+trip_id).append(html); 

                $('.link_delete_comment').click(function(){

                    deleteComment(this);

                });


                //console.log(html);

                $('.form-comment-reply-'+comment_id).hide();

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
        
        $(this).val('');

        return false;
    }
});



// process show sub comment

$('.form-comment-reply').hide();


$('.link-show-form-sub-comment').click(function(){

    showFormSubComment(this);

});

//var sub_comment_id;

$(".text_sub_comment").on("keydown",function search(e) {
    if(e.keyCode == 13) {

        var content = $(this).val();

        var parent_cmt_id = $(this).parent().parent().attr('class');
        var parent_cmt_id = xuliId(parent_cmt_id);

        var trip_id = $(this).parent().parent().attr('id');
        var trip_id = xuliId(trip_id);
        
        $.ajax({
            type:"post",
            url:'/comment',
            dataType:"text",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {"user_id":user_id, 'trip_id':trip_id,"parent_cmt_id":parent_cmt_id , "content":content },                
            
            success:function(res){
               
                sub_comment_id = res;

                console.log('Added sub comment id = ' + sub_comment_id);

                var html = '<div class="content-sub-comment sub_comment_id_'+sub_comment_id+'">' + 
                        '<div class="avatar-owner">' + 
                            '<img src="'+avatar+'" height="34px">'+
                        '</div>'+
                        '<div class="input-group sub-comment form_{{$comment->id}}">'+
                            '<span class="username-cmt">'+username+'</span>'+
                            '<span>'+content+'</span>'+
                            '<div class="action action-reply">'+
                                '<a href="javascript:;" class="link-like">Like</a>'+
                                '<a href="javascript:;" class="link-show-form-sub-comment">Reply</a>'+
                                '<a href="javascript:;" class="link_delete_sub_comment sub_comment_id_'+sub_comment_id+'">Delete</a>'+
                            '</div>'+
                        '</div>'+
                   '</div>';

                $('.sub_comment_area_'+parent_cmt_id).append(html); 

                //xoa even link_delete_sub_comment
                $('.link_delete_sub_comment').click(function() {

                    deleteComment(this);

                });
                

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



// process delete sub comment

$('.link_delete_sub_comment').click(function(event) {

    deleteComment(this);

});


//process delete parent comment
$('.link_delete_comment').click(function(){

    deleteComment(this);

});



