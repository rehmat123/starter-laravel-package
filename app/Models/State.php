<?php

namespace App\Models;


use Common\helper\helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use SoftDeletes;
    protected $table='states';

    protected $fillable=["title","state_code","country_id","created_at","updated_at","active","deleted_at"];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        //  $this->fillable=helper::getTableColumns('state',1);
    }

    function city(){
        return $this->hasMany('App\City');
    }


}


