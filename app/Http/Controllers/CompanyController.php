<?php

namespace App\Http\Controllers;

use App\Company;
use App\Product;
use App\Tag;
use App\Team;
use App\Token;
use App\Trade;
use Carbon\Carbon;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Validator;
use Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Helper\Table;


class CompanyController extends Controller{

    /**
     * 公司注册
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function getCompanyRegister()
    {
        return view('register.companyRegister');
    }

    /**
     * @param Requests\CompanyRegisterRequest $request 注册表单返回信息
     * 公司注册信息处理
     */

    public function postCompanyRegister(Requests\CompanyRegisterRequest $request)
    {
//        dd($request);
        $token = new Token();
//        dd($request);
        $name = $request->name;
        $email = $request->email;

        //生成token
        $urlToken = base64_encode($name . '_' . $email . '_' . time());
//        dd($urlToken);

        //发送邮件
        $flag = Mail::queue('mail.companyVerification', ['token' => $urlToken], function ($message) use ($email) {
            $message->to($email)->subject('验证邮件');
        });

        if ($flag) {
            $token->token = $urlToken;
            $token->save();
            echo "email success";
        } else {
//            return back()->withErrors($request->messages())->withInput();
        }
    }

    /**
     * @param String $token url中token值
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 判断注册链接是否失效，并跳转到相应页面
     */
    public function getCompanyRegisterInfo($token)
    {

//        对token内容进行解密，拆分
        $token = base64_decode($token);
        $arr = explode('_', $token);
//        dd($arr[2]);

        //判断token是否过期
        $time = time();
        $timediff = $time - $arr[2];
//        dd($timediff);
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
     * 公司信息存入数据库中并重定向到公司标签页面
     * @param Request $requests
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector /register/company/tag/
     */
    public function postCompanyRegisterInfo(Request $requests)
    {
        //获取request中的内容

        $validator = Validator::make($requests->all(), [
            'name' => 'required',
            'tel' => 'required',
            'shortName' => 'required|min:1',
            'web' => 'required|url',
            'city' => 'required',
            'trade' => 'required',
            'scale' => 'required',
            'stage' => 'required',
            'oneDesc' => 'required|min:10'
        ]);

        $error = $validator->error();

        if ($validator->fails()) {
            return Response::json(['errors' => $error], 401);
        } else {
            $logo = $requests->logo;
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
                'email' => $email,
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


            $company = new Company($fillable);
            $flag = $company->save();
            $id = $company->get()->max('id');
//        dd($id);
            if ($flag) {
                Session::put('id', $id);
                return redirect('/register/company/tag/');
            }
        }
    }

    /**
     * 公司标签选择页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCompanyRegisterTag(){
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
        $company = new Company();
        $id = $company->get()->max('id');
        Session::flash('id',$id);
        return view('register.companyTags', [
                'id'    => $id,
                'tags1' => $tag1,
                'tags2' => $tag2,
                'tags3' => $tag3,
                'tags4' => $tag4,
            ]);
    }

    /**
     * 公司标签处理页面
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postCompanyRegisterTag(Request $request){
//
//        {
//            "oldTags":[
//            0,23
//        ],
//           "newTags":[
//            "lalala","hahaha"
//        ],
//	    "id":2
//        }
        $data = $request->json()->all();
//        dd($data);
        $oldTags = $data['oldTags'];
        $newTags = $data['newTags'];
        $id = $data['id'];
        $company = Company::findorfail($id);
        foreach ($oldTags as $oldTag){
            $company->tags()->attach($oldTag);
        }
        foreach ($newTags as $newTag){
            $fillable = [
                'name'   => $newTag,
                'type'   => 0,
                'state'  => 0
            ];
            $tag = new Tag($fillable);
            $tag->save();
            $newTagId = $tag->get()->max('id');
            $company->tags()->attach($newTagId);
        }
        return redirect('/register/company/product/');
    }


    /**
     * 返回公司产品页面
     */
    public function getCompanyRegisterProduct(){
        return view('register.companyProduct');
    }

    /**
     * 插入公司产品
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postCompanyRegisterProduct(Request $request){

//      {
//            "products":[
//		{
//            "name":"lalala",
//			"image": "111",
//			"link":"http://www.baidu.com",
//			"desc":"baidu"
//		},
//		{
//            "name":"lalala",
//			"image": "222",
//			"link":"http://www.baidu.com",
//			"desc":"baidu"
//		}
//	    ],
//      }

        $data = $request->json()->all();
        $products = $data['products'];
        $id = $data['id'];
//        $id = $request->session()->get('id');

        foreach ($products as $product){
            $product['companyId'] = $id;
//            dd($product);
            $productObj = new Product($product);
            $productObj->save();
        }

        return redirect('/register/company/team/');
    }

    /**
     * 返回公司团队页面
     */
    public function getCompanyRegisterTeam(){
        return view('register.companyTeam');
    }

    /**
     * 插入公司团队信息
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postCompanyRegisterTeam(Request $request){

//        {
//            "teams":[{
//                "name":"",
//                "position":"",
//                "weibo":"",
//                "desc":"",
//                "image":""
//            }]
//        }

        $data = $request->json()->all();
        $teams = $data['teams'];
        $id = $data['id'];
//        $id = $request->session()->get('id');

        foreach ($teams as $team){
            $team['companyId'] = $id;
//            dd($product);
            $teamObj = new Team($team);
            $teamObj->save();
        }
        return redirect('/register/company/desc/');
    }

    /**
     * 返回公司介绍页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCompanyRegisterDesc(){
        return view('register.companyDesc');
    }

    /**
     * 插入公司简介
     * @param Request $request
     */
    public function postCompanyRegisterDesc(Request $request){
        $data = $request->json()->all();
        $desc = $data['desc'];
        $id = $data['id'];
//        $id = $request->session()->get('id');
        $company = Company::find($id);
        $company->desc=$desc;
        $company->save();
    }

    public function getCompanyShow($id){

        $company = Company::findorfail($id);
        $products = Product::where('companyId',$id)->get();
        $teams = Team::where('companyId',$id)->get();
        $tags = $company->tags;
        $tagArr = null;
        $teamArr = null;
        $productArr = null;

//        team信息获取
        foreach ($teams as $key => $team){
            $teamArr[$key] = [
                'name'       => $team->name,
                'position'   => $team->position,
                'weibo'      => $team->weibo,
                'desc'       => $team->desc,
                'image'      => $team->image
            ];
        }

        //product信息获取
        foreach ($products as $key => $product){
            $productArr[$key] = [
                'name'       => $product->name,
                'link'       => $product->link,
                'desc'       => $product->desc,
                'image'      => $product->image
            ];
        }

        //company信息获取
        $companyArr = [
            'name'      => $company->name,
            'shortName' => $company->shortName,
            'tel'       => $company->tel,
            'email'     => $company->email,
            'logo'      => $company->logo,
            'web'       => $company->web,
            'city'      => $company->city,
            'scale'     => $company->scale,
            'stage'     => $company->stage,
            'desc'      => $company->desc,
            'oneDesc'   => $company->oneDesc,
            'trade'     => $company->trade->name
        ];

        //tag信息获取
        foreach ($tags as $key => $tag){
            $tagArr[$key] = $tag->name;
        }

        return view('index.company',[
            'tags'         => $tagArr,
            'companyInfo'  => $companyArr,
            'product'      => $productArr,
            'team'         => $teamArr
        ]);

    }

}
