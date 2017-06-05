<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'position',
        'weibo',
        'desc',
        'image'
    ];

    public function company(){
        return $this->belongsTo('App\Company');
    }
}
