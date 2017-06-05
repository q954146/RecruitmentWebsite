<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{

    protected $fillable = [
      'name'
    ];


    public function company(){
       return $this->hasMany('App\Company');
    }
}
