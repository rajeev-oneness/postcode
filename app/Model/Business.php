<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model
{
    use SoftDeletes;
    protected $table = 'businesses';
    
    public function ratings()
    {
        return $this->hasMany('App\Model\Rating','business_id','id');
    }
    public function businesstype()
    {
        return $this->belongsTo('App\Model\BusinessCategory','business_categoryId','id');
    }
    public function businessuserid()
    {
        return $this->belongsTo('App\User','userId','id');
    }
    public function services() {
        return $this->hasMany('App\Model\Service','created_by','user_id');
    }
    public function products() {
        return $this->hasMany('App\Model\Product','created_by','user_id');
    }
    public function events() {
        return $this->hasMany('App\Model\Event','business_id','id');
    }
    public function offers() {
        return $this->hasMany('App\Model\Offer','businessId','id');
    }
}
