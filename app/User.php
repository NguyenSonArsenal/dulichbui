<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender', 'phone', 'birthday'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Get the comments of users for trips.
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * Get trips of user.
     */
    public function trips()
    {
        return $this->hasMany('App\Trip');
    }

    /**
     * Get the joins for trip.
     */
    public function joins()
    {
        return $this->hasMany('App\Join');
    }



}
