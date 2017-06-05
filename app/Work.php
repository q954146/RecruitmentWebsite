<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model{

    protected $fillable = [
        'resume_id',
        'link',
        'description'
    ];
}
