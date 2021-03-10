<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostalCode extends Model
{
    use SoftDeletes;
    protected $table = 'testimonials';
}
