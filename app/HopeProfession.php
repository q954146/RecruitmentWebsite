<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HopeProfession extends Model{

    protected $fillable = [
        'resume_id',
        'city',
        'nature',
        'profession',
        'salary'
    ];

    public function resume(){
        return $this->belongsTo('App\Resume');
    }
}
