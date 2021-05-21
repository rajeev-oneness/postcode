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
    public function communities(){
        return $this->belongsToMany('App\Model\Community','community_group_details','group_id', 'community_id');
    }
}
