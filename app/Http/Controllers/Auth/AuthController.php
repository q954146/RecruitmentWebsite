<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Request;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectPath = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('guest', ['except' => 'getLogout']);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data){

        return User::create([
            'name' => $data['name'],
            'password' => bcrypt($data['password']),
            'type' => $data['type'],
            'email' => $data['email']
//            'loginTime' => Carbon::now()->toDateTimeString(),
//            'loginIp' => $data['loginIp']
        ]);

    }

    public function postRegister(UserRegisterRequest $request){
        $data = $request->all();
//        dd($data);
        $flag = $this->create($data);
        if ($flag) {
            Auth::login($flag);
            return redirect($this->redirectPath());
        }
        return back()->withErrors($request->messages())->withInput();
    }



}
