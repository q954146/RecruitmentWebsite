<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class workExperience extends Model{

    protected $table = 'work_experiences';

    protected $fillable = [
        'resume_id',
        'company',
        'profession',
        'beginYearTime',
        'beginMonthTime',
        'endYearTime',
        'endMonthTime'
    ];

    public function resume(){
        return $this->belongsTo('App\Resume');
    }

}
