<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessCategory extends Model
{
    use SoftDeletes;
    protected $table = 'business_categories';

    public function getBusiness()
    {
        return $this->hasMany('App\Business','business_categoryId','id');
    }
}
