<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model{

    protected $fillable = [
        'name',
        'branch',
        'salaryHigh',
        'salaryLow',
        'city',
        'workYear',
        'edu',
        'nature',
        'welfare',
        'address',
        'email',
        'desc',
        'category_id',
        'user_id',
        'state'
    ];

    public function users(){
        return $this->belongsToMany('App\User')->withTimestamps()->withPivot('id');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

}
