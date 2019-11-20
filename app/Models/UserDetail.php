<?php

namespace Common;

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
        return $this->hasOne('Common\Country','id','country_id');
    }
    public function city()
    {
        return $this->hasOne('Common\City','id','city_id');
    }
    public function state()
    {
        return $this->hasOne('Common\State','id','state_id');
    }

}
