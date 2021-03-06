<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventCategory extends Model
{
    use SoftDeletes;
    protected $table = 'event_categories';
    public function userbusiness()
    {
        return $this->hasMany('App\Model\Event','event_category_id','id');
    }
}
