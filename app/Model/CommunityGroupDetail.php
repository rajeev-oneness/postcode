<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CommunityGroupDetail extends Model
{
    public function groups(){
        return $this->hasMany('App\Model\CommunityGroup', 'id', 'group_id');
    }
    public function communities(){
        return $this->hasMany('App\Model\Community', 'id', 'community_id');
    }
}
