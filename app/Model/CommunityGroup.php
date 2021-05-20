<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CommunityGroup extends Model
{
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'created_by');
    }
    public function discussion()
    {
        return $this->hasMany('App\Model\CommunityGroupDiscussion', 'group_id', 'id');
    }
    // public function community()
    // {
    //     return $this->hasMany('App\Model\Community', 'communityId', 'id');
    // }
}
