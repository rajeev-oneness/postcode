<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;
    public function business() {
        return $this->hasOne('App\Model\Business', 'id', 'business_id');
    }
}
