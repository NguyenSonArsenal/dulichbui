<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{


	function getComment()
	{
		
	}


 	function postComment()
 	{
 		
 		$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : ''; // user_id
 		$trip_id = isset($_POST['trip_id']) ? $_POST['trip_id'] : ''; // trip_id
 		$parent_cmt_id = isset($_POST['parent_cmt_id']) ? $_POST['parent_cmt_id'] : 0; // trip_id
 		$content = isset($_POST['content']) ? $_POST['content'] : '';

 		$cmt = new Comment();
 		
 		$cmt->user_id = $user_id;
 		$cmt->trip_id = $trip_id;
 		$cmt->parent_cmt_id = $parent_cmt_id;
 		$cmt->content = $content;

 		$cmt->save();


 	}   
}
