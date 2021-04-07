<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
    protected $table = 'services';

    public function busicategorytype()
    {
        return $this->belongsTo('App\Model\BusinessCategory','businessId','id');
    }
    public function business()
    {
        return $this->hasOne('App\Model\Business','user_id','created_by');
    }

}
