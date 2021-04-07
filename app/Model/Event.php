<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;
    protected $table = 'events';

    public function eventcattype()
    {
        return $this->belongsTo('App\Model\EventCategory','event_category_id','id');
    }
    public function eventbusiesstype()
    {
        return $this->belongsTo('App\Model\BusinessCategory','business_id','id');
    }
    public function business()
    {
        return $this->hasOne('App\Model\Business','user_id','created_by');
    }
    public function agegroup()
    {
        return $this->hasOne('App\Model\AgeGroup','id','age_group');
    }
}
