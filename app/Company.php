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
        'trade_id'
    ];

    public function trade(){
        return $this->belongsTo('App\Trade');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function user(){
        return $this->hasMany('App\User');
    }

    public function teams(){
        return $this->hasMany('App\Team');
    }

    public function products(){
        return $this->hasMany('App\Product');
    }

    public function questions(){
        return $this->hasMany('App\Question');
    }

}