<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Community extends Model
{
    use SoftDeletes;

    public function community_category()
    {
    	return $this->belongsTo('App\Model\CommunityCategory','communityCategoryId','id');
    }
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'created_by');
    }
    public function comments()
    {
        return $this->hasMany('App\Model\CommunityComment', 'communityId', 'id');
    }
    public function get_likes()
    {
        return $this->hasMany('App\Model\CommunityLike', 'communityId', 'id');
    }
    public function community_groups(){
        return $this->belongsToMany('App\Model\CommunityGroup','community_group_details','community_id','group_id')->using(CommunityGroupDetail::class);
    }
}
