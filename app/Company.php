<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //

    protected $fillable = [
        'name',
        'shortName',
        'tel',
        'email',
        'logo',
        'web',
        'city',
        'scale',
        'stage',
        'desc',
        'oneDesc',
        'state',
        'tradeId'
    ];

    public function trade(){
        return $this->belongsTo('App\Trade','tradeId');
    }

    public function tag(){
        return $this->belongsToMany('App\Tag','company_tag','companyId','tagId');
    }
}

