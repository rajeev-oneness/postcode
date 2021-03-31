<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model
{
    use SoftDeletes;
    protected $table = 'businesses';
    
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    public function businesstype()
    {
        return $this->belongsTo('App\Model\BusinessCategory','business_categoryId','id');
    }
    public function businessuserid()
    {
        return $this->belongsTo('App\User','userId','id');
    }
}
