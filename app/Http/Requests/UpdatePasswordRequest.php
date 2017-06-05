<?php
/**
 * Created by PhpStorm.
 * User: zimo
 * Date: 2017/5/22
 * Time: 15:32
 */

namespace App\Http\Requests;
use App\Http\Requests\Request;


class UpdatePasswordRequest extends Request{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password'          => 'required|min:6',
            'password'              => 'required|min:6|confirmed|different:old_password',
            'password_confirmation' => 'required|min:6',
        ];
    }

}