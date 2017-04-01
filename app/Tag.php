<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $fillable = [
        'name',
        'state',
        'type',
    ];

    public function tag(){
        return $this->belongsToMany('App\Company','company_tag','tagId','companyId');
    }
}