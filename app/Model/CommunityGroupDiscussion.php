<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CommunityGroupDiscussion extends Model
{
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
