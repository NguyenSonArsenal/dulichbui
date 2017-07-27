<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = [
        'user_id', 'trip_id', 'parent_cmt_id', 'content', 
    ];
    

    /**
     * Get the trip that owns the comment.
     */
    public function trip()
    {
        return $this->belongsTo('App\Trip');
    }


     /**
     * Get the user that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
