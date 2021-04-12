<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rating extends Model
{
    use SoftDeletes;
    protected $table = 'ratings';

    public function user() {
        return $this->hasOne('App\User','id','userId');
    }

    public function response() {
        return $this->hasOne('App\Model\RatingResponse','rating_id','id');
    }

    public function business()
    {
        return $this->hasMany('App\Model\Business', 'id', 'business_id');
    }

}
