<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model{

    public function profession(){
        return $this->hasMany('App\Profession');
    }

}
