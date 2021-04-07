<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';

    public function businesscategory()
    {
        return $this->belongsTo('App\Model\BusinessCategory','businessId','id');
    }
    public function business()
    {
        return $this->hasOne('App\Model\Business','user_id','created_by');
    }
}
