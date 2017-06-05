<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Send extends Model{

    protected $fillable = [
        'user_profession_id',
        'sendSuccessState',
        'sendSuccessTime',
        'viewedState',
        'viewedTime',
        'pendingState',
        'pendingTime',
        'auditionState',
        'auditionStateTime',
        'inappropriateState',
        'inappropriateTime',
        'auditionLinkMan',
        'auditionLinkPhone',
        'auditionTime',
        'auditionAddress',
        'sendType'
    ];

}
