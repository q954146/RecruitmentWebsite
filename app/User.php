<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'loginIp',
        'loginTime'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function company(){
        return $this->belongsTo('App\Company');
    }

    public function resume(){
        return $this->hasOne('App\Resume');
    }

    public function professions(){
        return $this->belongsToMany('App\Profession')->withTimestamps()->withPivot('id');
    }

    public function profession(){
        return $this->hasMany('App\Profession');
    }

    public function answers(){
        return $this->hasMany('App\Answer');
    }

    public function check(){
        return $this->hasOne('App\Check');
    }

}
