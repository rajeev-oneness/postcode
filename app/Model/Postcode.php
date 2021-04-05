<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Postcode extends Model
{
    public function business()
    {
        return $this->hasMany('App\Model\Business','pin_code','postcode');
    }
    public function state()
    {
        return $this->hasOne('App\Model\State','id','stateId');
    }
}
