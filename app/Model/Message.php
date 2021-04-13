<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function business() {
        return $this->hasOne('App\Model\Business', 'id', 'business_id');
    }
}
