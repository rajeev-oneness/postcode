<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'address', 'postcode', 'userType','countryId','stateId'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function usertype()
    {
        return $this->belongsTo('App\UserType','user_type_id','id');
    }
    public function userbusiness()
    {
        return $this->hasMany('App\Business','userId','id');
    }
    public function usercountry()
    {
        return $this->hasOne('App\Model\Country','id','countryId');
    }
    public function userstate()
    {
        return $this->hasOne('App\Model\State','id','stateId');
    }
    public function business()
    {
        return $this->hasOne('App\Model\Business', 'user_id', 'id');
    }

    //for permission
    public function businessCategory()
    {
        return $this->hasOne('App\Model\GrantPermission', 'user_id', 'id');
    }

    public static function permission($module,$action,$userId){
        $data = \App\Model\GrantPermission::where('user_id',$userId)->where('permission_id',$module)->where($action,1)->first();
        // switch($action){
        //     case 'add' : 
        //         $data = $data->where('add',1);
        //         break;
        //     case 'edit' :
        //         $data = $data->where('edit',1); 
        //         break;
        //     case 'delete' :
        //         $data = $data->where('delete',1); 
        //         break;
        // }
        // $data = $data->first();
        if($data){
            return true;
        }
        return false;
    }
}
