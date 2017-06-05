<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model{

    protected $fillable = [
        'resume_id',
        'school',
        'education',
        'beginTime',
        'endTime',
    ];


    public function resume(){
        return $this->belongsTo('App\Resume');
    }
}
