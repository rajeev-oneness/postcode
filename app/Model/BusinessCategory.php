<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessCategory extends Model
{
    use SoftDeletes;
    protected $table = 'business_categories';
    protected $fillable = [
        'name'
    ];

    public function getBusiness()
    {
        return $this->hasMany('App\Model\Business','business_categoryId','id');
    }

    public function getProducts()
    {
        return $this->hasMany('App\Model\Product','businessId','id');
    }

    public function getServices()
    {
        return $this->hasMany('App\Model\Service','businessId','id');
    }

    public function getevents()
    {
        return $this->hasMany('App\Model\Event','business_id','id');
    }
    public function getoffers()
    {
        return $this->hasMany('App\Model\Offer','businessId','id');
    }
}
