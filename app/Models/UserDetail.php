<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDetail extends Model
{
    use SoftDeletes;
    protected $table='user_details';
    protected $fillable=['user_id','country_id','state_id','city_id','college','ip','active'
        ,'created_by','updated_by','deleted_at','created_at','updated_at'];

    public function country()
    {
        return $this->hasOne('App\Country','id','country_id');
    }
    public function city()
    {
        return $this->hasOne('App\City','id','city_id');
    }
    public function state()
    {
        return $this->hasOne('App\State','id','state_id');
    }

}
