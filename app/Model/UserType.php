<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserType extends Model
{
    use SoftDeletes;
    protected $table = 'user_types';

    public function getUser()
    {
        return $this->hasMany('App\User','user_type_id','id');
    }
}
