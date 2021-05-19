<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CommunityGroup extends Model
{
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'created_by');
    }
}
