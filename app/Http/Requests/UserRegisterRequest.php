<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;


class UserRegisterRequest extends Request{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'name' => 'required | min:3 | max:16 | unique:users,name',
            'email' => 'required | email | unique:users,email',
            'password' => 'required | min:3 | max:16 | confirmed'
        ];
    }



}
