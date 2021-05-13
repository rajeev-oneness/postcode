<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommunityLike extends Model
{
    use SoftDeletes;

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'liked_by');
    }
}
