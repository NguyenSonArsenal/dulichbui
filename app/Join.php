<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Join extends Model
{

    protected $fillable = [
        'user_id', 'trip_id', 'status', 
    ];
    

    /**
     * Get the trip that owns the join.
     */
    public function trip()
    {
        return $this->belongsTo('App\Trip');
    }


     /**
     * Get the user that owns the join.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
