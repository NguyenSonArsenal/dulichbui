<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
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

        $data = $request->all();

        $validation = Validator::make( $request->all(), [
                        'trip_name' => 'required|max:255|min:3',
                        'time_start' => 'required|date|before:time_end',
                        'time_end' => 'required|after:time_start',
                    ]);
 

        if( $validation->fails() )
        {
            return json_encode([ // array to json
                'errors' => $validation->errors()->getMessages(),
                'code' => 422
            ]); // obj

        } else {

            // If pass validate then insert to db

            return json_encode([
                'success' => 'pass validate'
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
