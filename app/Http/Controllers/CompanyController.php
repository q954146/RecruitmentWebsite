<?php

namespace App\Http\Controllers;

use App\Company;
use App\Tag;
use App\Token;
use App\Trade;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class CompanyController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 公司注册
     */

    public function create()
    {
        return view('register.companyRegister');
    }

    /**
     * @param Requests\CompanyRegisterRequest $request 注册表单返回信息
     * 公司注册信息处理
     */

    public function store(Requests\CompanyRegisterRequest $request)
    {
        $token = new Token();
//        dd($request);
        $name = $request->name;
        $email = $request->email;

        //生成token
        $urlToken = base64_encode($name . '_' . $email . '_' . time());

        //发送邮件
        $flag = Mail::queue('mail.companyVerification', ['token' => $urlToken], function ($message) use ($email) {
            $message->to($email)->subject('验证邮件');
        });

        if ($flag) {
            $token->token = $urlToken;
            $token->save();
            echo "email success";
        } else {
            echo 'email fault';
        }
    }

    /**
     * @param String $token url中token值
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 判断注册链接是否失效，并跳转到相应页面
     */
    public function verification($token)
    {

        //对token内容进行解密，拆分
        $token = base64_decode($token);
        $arr = explode('_', $token);
//        dd($arr[2]);

        //判断token是否过期
        $time = time();
        $timediff = $time - $arr[2];
        $mins = intval($timediff / 60);

        $trade = new Trade();

        $tradeInfos = $trade->select('name')->get();
        $tradeInfoArr = null;

        foreach ($tradeInfos as $key => $tradeInfo) {
            $tradeInfoArr[$key] = $tradeInfo->name;
        }

        if ($mins < 10) {
            Session::flash('email', $arr[1]);
            return view('register.companyInfo', [
                'name' => $arr[0],
                'tradeInfos' => $tradeInfoArr
            ]);
        } else {
            echo '链接已失效';
        }
    }

    /**
     * @param Requests\CompanyInfoRegisterRequest $requests 公司详细信息
     * @return bool
     */
    public function companyRegisterInfo(Requests\CompanyInfoRegisterRequest $requests)
    {

        //获取文件内容
        $logo = $requests->file('logo');
        if ($logo->isValid()) {
            // 获取文件相关信息
            $originalName = $logo->getClientOriginalName(); // 文件原名
            $ext = $logo->getClientOriginalExtension();     // 扩展名
            $realPath = $logo->getRealPath();   //临时文件的绝对路径
            $type = $logo->getClientMimeType();     // image/jpeg
            // 上传文件
            $logo = md5($originalName . time()) . '.' . $ext;
            // 使用我们新建的uploads本地存储空间（目录）
            $flag = Storage::disk()->put($logo, file_get_contents($realPath));
//            dd($flag);
        }

        //获取request中的内容
        $name = $requests->name;
        $tel = $requests->tel;
        $shortName = $requests->shortName;
        $web = $requests->web;
        $city = $requests->city;
        $trade = $requests->trade;
        $scale = $requests->scale;
        $stage = $requests->stage;
        $oneDesc = $requests->oneDesc;
        $email = $requests->session()->get('email');

        $fillable = [
            'name' => $name,
            'shortName' => $shortName,
            'tel' => $tel,
            'email' => 123,
            'logo' => $logo,
            'web' => $web,
            'city' => $city,
            'scale' => $scale,
            'stage' => $stage,
            'desc' => 'desc',
            'oneDesc' => $oneDesc,
            'state' => 0,
            'tradeId' => $trade,
        ];

//        dd($fillable);

        $company = new Company($fillable);
        $flag = $company->save();
        $id = $company->get()->max('id');
        $tags = new Tag();
        $tags = $tags->select('id', 'name', 'type', 'state')->orderBy('type')->get();

        //select name from tags grout by type
        $tagsArrs = null;
        foreach ($tags as $key => $tag) {
            $tagsArrs[$key] = $tag;
        }

        $tag1 = null;//薪酬激励
        $tag2 = null;//员工福利
        $tag3 = null;//员工关怀
        $tag4 = null;//其他

        foreach ($tagsArrs as $tagArr) {
            if ($tagArr['state'] != 0) {
                if ($tagArr['type'] == 1) {
                    $tag1[] = [
                        'name' => $tagArr['name'],
                        'id' => $tagArr['id']
                    ];
                } else if ($tagArr['type'] == 2) {
                    $tag2[] = [
                        'name' => $tagArr['name'],
                        'id' => $tagArr['id']
                    ];
                } else if ($tagArr['type'] == 3) {
                    $tag3[] = [
                        'name' => $tagArr['name'],
                        'id' => $tagArr['id']
                    ];
                } else if ($tagArr['type'] == 4) {
                    $tag4[] = [
                        'name' => $tagArr['name'],
                        'id' => $tagArr['id']
                    ];
                }
            }
        }

//        dd($tag1);

        if ($flag) {
            Session::flash('id', 2);
            return view('register.companyTags', [
                'tags1' => $tag1,
                'tags2' => $tag2,
                'tags3' => $tag3,
                'tags4' => $tag4,
            ]);
        } else {
            echo 'fault';
        }
    }

    public function companyRegisterTag(Request $request)
    {
        dd($request->all());

//        if ($request::ajax){
//            $data = Input::all();
//            dd($data);
//        }

    }


    public function ajaxCreate()
    {
//        header("Access-Control-Allow-Origin: *");
        return view('ajax');
    }

    public function ajaxStore(Request $request){
        if ($request->ajax()){
            return '1';
        }
//
//            echo '1';
//        }
    }

}
