<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{

    protected $fillable = [
      'name'
    ];


    public function company(){
        $this->hasMany('App\Company');
    }
}
