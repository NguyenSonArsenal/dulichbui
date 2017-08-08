<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{

    protected $fillable = [
        'user_id', 'trip_id', 'status', 
    ];
    

    /**
     * Get the trip that owns the follow.
     */
    public function trip()
    {
        return $this->belongsTo('App\Trip');
    }


     /**
     * Get the user that owns the follow.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
