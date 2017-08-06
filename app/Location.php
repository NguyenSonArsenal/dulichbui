<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

    protected $table = 'locations';
    
    protected $fillable = [
        'lat', 'lng', 'name', 'time', 'vehicle', 'activities',
    ];

    /**
     * The trip that belong to the location.
     */
    public function trip()
    {
        return $this->belongsTo('App\Trip');
    }


}
