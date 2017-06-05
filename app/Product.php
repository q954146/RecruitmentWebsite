<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'link',
        'image',
        'desc'
    ];

    public function company(){
        return $this->belongsTo('App\Company');
    }
}
