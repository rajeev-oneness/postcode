<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommunityComment extends Model
{
    use SoftDeletes;

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'commented_by');
    }
}
