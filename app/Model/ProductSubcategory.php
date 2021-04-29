<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductSubcategory extends Model
{
    public function category()
    {
        return $this->hasOne('App\Model\ProductCategory','id','category_id');
    }
}
