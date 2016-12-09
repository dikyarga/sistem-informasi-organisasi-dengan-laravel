<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    // user who create event
    public function author(){
      return $this->belongsTo('App\User', '');
    }
}
