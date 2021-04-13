<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function event() {
        return $this->hasOne('App\Model\Event', 'id', 'event_id');
    }
}
