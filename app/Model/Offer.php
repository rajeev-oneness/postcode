<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use SoftDeletes;
    protected $table = 'offers';

    public function offercattype()
    {
        return $this->belongsTo('App\Model\BusinessCategory','businessId','id');
    }
}
