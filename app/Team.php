<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'companyId',
        'name',
        'position',
        'weibo',
        'desc',
        'image'
    ];
}
