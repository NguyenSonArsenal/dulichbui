<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TripController extends Controller
{
     
	function __construct(Trip $trip)
    {
        $this->trip = $trip;
    }

    public function index()
    {
        
        $listTrip = $this->trip->getListTrip();

        $test = '1';

        return view('index', compact('test'));

    }



}
