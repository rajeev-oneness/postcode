<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    public function businesscategory()
    {
        return $this->belongsTo('App\Model\BusinessCategory','businessId','id');
    }
    public function business()
    {
        return $this->hasOne('App\Model\Business','user_id','created_by');
    }
    public function category()
    {
        return $this->hasOne('App\Model\ProductCategory','id','category_id');
    }
    public function subcategory()
    {
        return $this->hasOne('App\Model\ProductSubcategory','id','subcategory_id');
    }
}
