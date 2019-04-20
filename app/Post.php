<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // allow mass assignment by inverse. the value inside guarded will not be allowed to mass assign
    protected $guarded = [];


    //** relationship for post belongs to a user
    public function user(){
        return $this->belongsTo('App\User');    // App\Model 
    }


}
