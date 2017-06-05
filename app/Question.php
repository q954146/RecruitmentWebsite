<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model{

    protected $fillable = [
        'company_id',
        'content'
    ];

    public function company(){
        return $this->belongsTo('App\Company');
    }

    public function answers(){
        return $this->hasMany('App\Answer');
    }

}
