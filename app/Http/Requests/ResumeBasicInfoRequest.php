<?php
/**
 * Created by PhpStorm.
 * User: zimo
 * Date: 2017/4/26
 * Time: 13:28
 */

namespace App\Http\Requests;
use App\Http\Requests\Request;


class ResumeBasicInfoRequest extends Request {


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
            'name'        => 'required',
            'sex'         => 'required',
            'education'   => 'required|min:1',
            'phone'        => 'required',
            'email'       => 'required',
            'introduction'       => 'required',
        ];
    }
}