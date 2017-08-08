<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Trip;
use App\Location;
use App\Join;
use App\User;
use App\Follow;
use App\Comment;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Contracts\Validation\Validator;
//use Request;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trips.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)//Request
    {

        $i;

        $data = $request->all(); //array

        $count_location = count($data['time']);

        $validation = Validator::make( $request->all(), [
                        'trip_name'     =>  'required|max:255|min:3',
                        'time_start'    =>  'required|date|before:time_end',
                        'time_end'      =>  'required|after:time_start',
                        ]);

        if ($validation->fails()) {
            return json_encode([ // array to json
                'errors' => $validation->errors()->getMessages(),
            ]); // obj

        } else {
            // If pass validate then insert to db

            // Insert db to trip table
            $trip = new Trip;
            $trip->user_id    = $data['user_id'];
            $trip->name       = $data['trip_name'];
            $trip->time_start = $data['time_start'];
            $trip->time_end   = $data['time_end'];
            $trip->save();
            
            $trip_id = $trip->id;

            // Insert db to location table
            for($i=0; $i<$count_location; $i++){
                $location = new Location;
                $location->trip_id = $trip_id;
                $location->lat = $data['lat'][$i];
                $location->lng = $data['lng'][$i];
                $location->time = $data['time'][$i];
                $location->vehicle = $data['vehicle'][$i];
                $location->activities = $data['activities'][$i];
                
                $location->save();
            }

            return json_encode([
                'success' => 'pass validate and insert db ok'
            ]); // obj
        }

    }

    /**
     * Update cover image for the trip
     */
    function updateCover()
    {

        $data = isset($_POST['image']) ? $_POST['image'] : 'xxx';

        $trip_id = isset($_POST['trip_id']) ? $_POST['trip_id'] : ''; // user_id
        
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);

        $data = base64_decode($data);

        $imageName = 'images/cover-trip/' .time().'.png';


        $trip = Trip::find($trip_id);

        $trip->cover = $imageName;

        $trip->save();

        file_put_contents($imageName, $data); // move image to foder root

        return json_encode([
            'success' => 'pass validate and insert db ok'
        ]); // obj

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $count_join_trip = 0;  
        $user_id = Auth::id(); 

        //get comment parent for a trip
        $parent_comments = $this->getParentComment($id);
        $sub_comments = $this->getSubComment($id);

        $permission = $this->getPermission($user_id, $id);

        //$trip = Trip::find($id); // Obj

        $trip = Trip::with('joins')->where('id',$id)->get(); // collection

        $join = Join::with('trip', 'user')->where('trip_id', $id)->get();

        // Hỏi xem có sự khác nhau gì giữa 2 cách query này 
        
        
        $tmp_trip = $trip->count();
        $tmp_join = $join->count();

        if ($tmp_trip == 1) {

            $trip = $trip[0];

            // count user who accepted for join trip
            $join_trips = Join::with('trip')->where('trip_id',$id)->where('status',2)->get(); //collection
            $count_join_trip = $join_trips->count();

         
            $user_id_owner = $trip->user_id;
            $user_name_owner = $trip->user->name;

            $count_status_waitting = $this->getRequestStatusWaitting($user_id_owner, $id);
            $users_request_waitting = $this->getUserRequestWaitting($user_id_owner, $id);


           return view('trips.index', compact('trip', 'count_join_trip', 'user_name_owner', 'permission', 
            'count_status_waitting', 'users_request_waitting', 'parent_comments', 'sub_comments'));
        
        } else {

            return view('page_404');

        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    

    function joinTrip(Request $request)
    {
        $data = $request->all();

        $status = isset($data['status']) ? $data['status'] : '';
        $user_id = isset($data['user_id']) ? $data['user_id'] : '';
        $trip_id = isset($data['trip_id']) ? $data['trip_id'] : '';

        //echo $status;

        $join   = new Join();
        $follow = new Follow();

        if($status == 'request-join-trip') {

            $join->user_id = $user_id;
            $join->trip_id = $trip_id;
            $join->status  = 1; // waiting request join trip

            
            $follow->user_id = $user_id;
            $follow->trip_id = $trip_id;
            $follow->status  = 1; // followed

            $join->save();
            $follow->save();
            //dd($join->id);
            

            if($join->id && $follow->id){
                return json_encode([
                    'success' => 'joined success'
                ]); // obj
            }

        } else if ($status == 'request-exit-trip' || $status == 'request-cancel-watting-join-trip') {

            Join::where('user_id', $user_id)->where('trip_id', $trip_id)->delete();
            Follow::where('user_id', $user_id)->where('trip_id', $trip_id)->delete();

            return json_encode([
                'success' => 'No follow trip'
            ]);   // Obj  
        
        } else if ($status == 'request-cancel-watting-join-trip') {
            
            echo 'server getted request cancel watting join trip';
        }
    }

    function getPermission($user_id, $trip_id)
    {

        // echo $user_id;
        // echo $trip_id;

        if(!Auth::id()) {
            return 'guess';
        }

        $trip = Trip::find($trip_id);

        if (isset($trip)) {
            if($user_id==$trip->user_id)
                return 'owner';
        }

        $status = Join::where('user_id',$user_id)->where('trip_id', $trip_id)->pluck('status')->last(); 

        //dd($status);

        if($status){

             if($status == 1){

                return 'waitting';

            }else if($status == 2){

                return 'joined';

            } else if($status == 3) {

                return 'user';

            }
        } else {

            return 'user';
        }
    }


    function getRequestStatusWaitting($user_id, $trip_id) 
    {
        
        $count_status_waitting = Join::where('trip_id',$trip_id)->where('status','1')->count();
        
        return $count_status_waitting;

    }

    function getUserRequestWaitting($user_id, $trip_id) 
    {

        //collection
        $users_request_waitting = Join::where('trip_id',$trip_id)->where('status','1')->pluck('user_id');

        if($users_request_waitting->count() > 0) {

                foreach ($users_request_waitting as $key => $value) {
                    
                $user[$key] = User::find($value);
               
            }

            return $user;
        }
    }

    public function acceptOrCancelUserJoinTrip(Request $request)
    {
        
        $data = $request->all();

        $status = isset($data['status']) ? $data['status'] : '';
        $user_id = isset($data['user_id']) ? $data['user_id'] : '';
        $trip_id = isset($data['trip_id']) ? $data['trip_id'] : '';

        $join_id = Join::where('user_id',$user_id)->where('trip_id', $trip_id)->pluck('id')->first(); 

        $join = Join::find($join_id);

        if($status == 'request-accept-user-join-trip') {

            $join->status  = 2;
            $join->save();

            return json_encode([
                'success' => 'Accepted request user join for trip'
            ]);

        } else if($status == 'request-cancel-user-join-trip') {

            $join->status  = 3;
            $join->save();

            return json_encode([
                'success' => 'Canceled request user join for trip'
            ]);

        }

    }



    //Comment process
    public function getParentComment($trip_id) 
    {
        $parent_comments = Comment::with('user')->where('trip_id', $trip_id)->where('parent_cmt_id', 0)->get();

        return $parent_comments;
    }


    // get sub comment of parent comment
    public function getSubComment($trip_id)
    {

        $parents_cmt_id = $this->getParentComment($trip_id); // Collection

        $comments = Comment::with('user','trip')->get();

         // get parent comment 
        foreach ($parents_cmt_id as $i => $parents) {

            $parent_comments[$i] = $parents->id;

        }

        // get sub comment of parent comment

        foreach ($parent_comments as $i => $parent) {

            $sub_comments[$parent] =  Comment::with('user','trip')->where('parent_cmt_id' , $parent)->get();

        }

        return $sub_comments;

    }

}

//}
//end class




