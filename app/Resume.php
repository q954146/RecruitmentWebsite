<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model{

    protected $fillable = [
        'user_id',
        'name',
        'sex',
        'education',
        'workYear',
        'phone',
        'email',
        'image',
        'introduction',
        'state',
        'deliver',
        'annex'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function hopeProfession(){
        return $this->hasOne('App\HopeProfession');
    }

    public function education(){
        return $this->hasOne('App\workExperience');
    }


    public function workExperience(){
        return $this->hasOne('App\workExperience');
    }

}
