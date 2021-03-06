<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
	protected $table = 'trips';
    
    protected $fillable = [
        'user_id', 'name', 'content', 'cover', 'time_start', 'time_end', 'status',
    ];


    public function getListTrip()
    {
        return self::get();
    }

    /**
     * Get the comments for the trip.
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }


     /**
     * Get the joins for trip.
     */
    public function joins()
    {
        return $this->hasMany('App\Join');
    }

     /**
     * Get the follows for trip.
     */
    public function follows()
    {
        return $this->hasMany('App\Follow');
    }


    /**
     * The user that belong to the trip.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }


    /**
     * Get the locations for the trip.
     */
    public function locations()
    {
        return $this->hasMany('App\Location');
    }

    



	
}
