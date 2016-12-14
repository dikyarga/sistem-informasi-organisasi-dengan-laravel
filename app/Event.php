<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    // user who create event
    public function author(){
      return $this->belongsTo('App\User', 'user_id');
    }

    // images
    public function images(){
      return $this->hasMany('App\EventImage', 'event_id');
    }
}
