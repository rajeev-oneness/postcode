<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCart extends Model
{
    use SoftDeletes;

    public function product()
    {
        return $this->hasOne('App\Model\Product', 'id', 'product_id');
    }
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
