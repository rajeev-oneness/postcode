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
}
