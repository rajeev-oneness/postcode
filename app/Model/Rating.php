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

}
