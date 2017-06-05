<?php
/**
 * Created by PhpStorm.
 * User: zimo
 * Date: 2017/5/31
 * Time: 14:51
 */

namespace App\Http\Controllers;

use App\Check;
use Illuminate\Http\Request;
use App\User;
use App\Admin;
use Validator;
use Mail;
use Illuminate\Support\Facades\Session;
use Storage;


class ManageController extends Controller{

    public function getAdminLogin(){
        return view('management.manageLogin');
    }

    public function postAdminLogin(Request $request){
        $username = $request->get('username');
        $password = md5($request->get('password'));

        $admin = Admin::where('username',$username)->get()[0];
        if ($password == $admin['password']){
            $admin->loginTime = time();
            $admin->loginIp = $request->ip();
            $admin->save();
            Session::put('admin',$admin);
            return redirect('/admin/manage');
        }
    }

    public function getAdminLogout(){
        Session::forget('admin');
        return redirect('/');
    }

    public function getManage(){

        $checks = Check::all();
        return view('management.manage',[
            'checks' => $checks
        ]);
//        return session('admin');
    }

    public function postManage(Request $request){
        $agree = $request->get('agree');
        $user_id = $request->get('user_id');
        $user = User::findorfail($user_id);
        $email = $user['email'];
        $company = $user->company;
        $check = Check::where('user_id',$user_id)->get()[0];
        $flag = null;

        if ($agree){
            Mail::queue('emails.approved', ['user' => $user], function ($m) use ($email) {
                $m->to($email)->subject('请求通过');
            });
            $company->state = 1;
            $flag = true;
            $check->state = 1;
        }else{
            Mail::queue('emails.unapproved', ['user' => $user], function ($m) use ($email) {
                $m->to($email)->subject('请求未通过');
            });
            $flag = false;
            $check->state = -1;
        }
        $company->save();
        $check->save();
        return response()->json([
            'flag' => $flag
        ]);
    }


}