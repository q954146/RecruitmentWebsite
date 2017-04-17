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

    public function companies(){
        return $this->belongsToMany('App\Company')->withTimestamps();
    }
}