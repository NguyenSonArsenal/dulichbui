<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Trip;
use App\Location;
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

        //var_dump($data['user_id']);

        //dd($data);
        //dd($data['time'][0]);

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
