<?php


namespace App;
use Illuminate\Database\Eloquent\Model;


class Check extends Model{

//    protected $table = 'checks';

    protected $fillable = [
        'user_id',
        'picture'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

}