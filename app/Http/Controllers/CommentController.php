<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Response;

class CommentController extends Controller
{


	function getComment()
	{
		
	}


 	function postToAddComment()
 	{
 		$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : ''; // user_id
 		$trip_id = isset($_POST['trip_id']) ? $_POST['trip_id'] : ''; // trip_id
 		$parent_cmt_id = isset($_POST['parent_cmt_id']) ? $_POST['parent_cmt_id'] : 0; // trip_id
 		$content = isset($_POST['content']) ? $_POST['content'] : '';


 		// insert db
 		$cmt = new Comment();
 		
 		$cmt->user_id = $user_id;
 		$cmt->trip_id = $trip_id;
 		$cmt->parent_cmt_id = $parent_cmt_id;
 		$cmt->content = trim($content);

 		$cmt->save();

 		echo $cmt->id;

 	}


 	function postToDeleteComment()
 	{
 		$comment_id = isset($_POST['comment_id']) ? $_POST['comment_id'] : ''; // sub_comment_id
 		
 		if($comment_id != null){
 			$status = Comment::destroy($comment_id);
 		}

 		return Response::json(['status' => $status]);
 	}


}
