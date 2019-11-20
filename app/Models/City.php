<?php

namespace App\Models;

use Common\helper\helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;
    protected $table = 'cities';
    protected $fillable = ["id","title","slug","shortCode","state_id","country_id","created_at","updated_at","active","deleted_at"];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        // $this->fillable = helper::getTableColumns('city', 0);
    }

}
