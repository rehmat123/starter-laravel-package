<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Common\helper\helper;

class Country extends Model
{
    use SoftDeletes;
    protected $table = 'countries';
    protected $fillable = ["id", "title", "country_code","active", "created_by", "updated_by", "created_at", "updated_at", "deleted_at"];


    public function state()
    {
        return $this->hasMany('App\State');
    }

    public function city()
    {
        return $this->hasMany('App\City');
    }
}
