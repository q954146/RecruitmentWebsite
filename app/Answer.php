<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model{

    protected $fillable = [
        'user_id',
        'question_id',
        'content'
    ];

    public function question(){
        return $this->belongsTo('App\Question');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
