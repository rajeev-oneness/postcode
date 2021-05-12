<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommunityCategory extends Model
{
    use SoftDeletes;


    public function community()
    {
    	return $this->hasMany('App\Model\Community','communityCategoryId','id');
    }
}
