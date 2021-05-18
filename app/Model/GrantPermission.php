<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GrantPermission extends Model
{
    use SoftDeletes;

    public function permission_details()
    {
        return $this->hasOne('App\Model\Permission', 'id', 'permission_id');
    }
}
