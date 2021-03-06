<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;
    public function event() {
        return $this->hasOne('App\Model\Event', 'id', 'event_id');
    }
}
