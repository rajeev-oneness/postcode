<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CommunityGroupDetail extends Pivot
{
    protected $table = 'community_group_details';
    public function groups(){
        return $this->hasMany('App\Model\CommunityGroup', 'id', 'group_id');
    }
    public function communities(){
        return $this->hasMany('App\Model\Community', 'id', 'community_id');
    }
}
