<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventImage extends Model
{
    // images uploaded for event
    public function event(){
      return $this->belongsTo('app\Event', 'event_id');
    }
}
