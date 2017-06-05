<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model{

    protected $fillable = [
        'resume_id',
        'name',
        'profession',
        'beginYearTime' ,
        'beginMonthTime',
        'endYearTime',
        'endMonthTime'
    ];

    public function resume(){
        return $this->belongsTo('App\Resume');
    }
}
