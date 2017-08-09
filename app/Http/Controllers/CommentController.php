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


 		// echo 'User_id: ' . $user_id;
 		// echo "Trip_id: " . $trip_id;
 		// echo 'Parent_id: ' .$parent_cmt_id;
 		// echo 'Content: ' . $content;

 		// insert db
 		$cmt = new Comment();
 		
 		$cmt->user_id 		= $user_id;
 		$cmt->trip_id 		= $trip_id;
 		$cmt->parent_cmt_id = $parent_cmt_id;
 		$cmt->content 		= trim($content);

 		//$cmt->save();

 		//$cmt_id = $cmt->id;
 		$cmt_id = 300;
 		
 		return $cmt_id;

 	}


 	function postToDeleteComment()
 	{
 		$comment_id = isset($_POST['comment_id']) ? $_POST['comment_id'] : ''; // comment_id
 		
 		$sub_comment_id = isset($_POST['sub_comment_id']) ? $_POST['sub_comment_id'] : ''; // sub_comment_id

 		$sub_comments = Comment::where('parent_cmt_id' , $comment_id)->get();

 		$count_sub_comments = $sub_comments->count();

  		if($count_sub_comments > 0) {

  			foreach ($sub_comments as $key => $sub_comment) {
	 			Comment::destroy($sub_comment->id);
	 		}
  		}

 		if($comment_id != null){
 			$status = Comment::destroy($comment_id);
 		}

 		if($sub_comment_id != null){
 			$status = Comment::destroy($sub_comment_id);
 		}

 		return Response::json(['status' => $status]);
 	}


}
