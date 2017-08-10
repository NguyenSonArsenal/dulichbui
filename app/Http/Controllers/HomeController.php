<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trip;
use App\Comment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $trip = new Trip();

        $listTrip = Trip::with('user')->get();

        $comments = Comment::with('user','trip')->get();

        //dd($comments->count());

        if($comments->count() > 0) {
            // get parent comment 
            foreach ($comments as $i => $comment) {

                //dd($comment);

                if($comment->parent_cmt_id == 0) {

                    $parent_comments[$i] = $comment->id;

                }
            }

            // get sub comment of parent comment
            foreach ($parent_comments as $i => $parent) {

                $sub_comments[$parent] =  Comment::with('user','trip')->where('parent_cmt_id' , $parent)->get();

            }

            //end get sub comment
            $parent_comments = Comment::with('user','trip')->where('parent_cmt_id',0)->get();

            return view('index', compact('listTrip','comments', 'parent_comments','sub_comments'));
        }

        return view('index', compact('listTrip'));
    }

}
