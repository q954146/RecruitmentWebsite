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
use Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Helper\Table;


class CompanyController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 公司注册
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
            echo 'email fault';
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
     * @param Requests\CompanyInfoRegisterRequest $requests
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector /register/company/tag/
     * 公司信息存入数据库中并重定向到公司标签页面
     */
    public function postCompanyRegisterInfo(Requests\CompanyInfoRegisterRequest $requests)
    {
        //获取文件内容
//        if ($logo->isValid()) {
//            // 获取文件相关信息
//            $originalName = $logo->getClientOriginalName(); // 文件原名
//            $ext = $logo->getClientOriginalExtension();     // 扩展名
//            $realPath = $logo->getRealPath();   //临时文件的绝对路径
//            $type = $logo->getClientMimeType();     // image/jpeg
//            // 上传文件
//            $logo = md5($originalName . time()) . '.' . $ext;
//            // 使用我们新建的uploads本地存储空间（目录）
//            $flag = Storage::disk()->put($logo, file_get_contents($realPath));
////            dd($flag);
//        }

        //获取request中的内容
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
        if ($flag){
            Session::put('id',$id);
            return redirect('/register/company/tag/');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 公司标签选择页面
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
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * 公司标签处理页面
     */
    public function postCompanyRegisterTag(Request $request){

//  {
//     "oldTags":[{
//       "0":1,
//		 "1":23
//	    }],
//	"newTags":[{
//      "0":"哈哈哈",
//		"1":"啦啦啦"
//	}],
//	"id":2
//}

        $data = $request->json();
//        dd($data);
        $oldTags = $data->all()['oldTags'];
        $newTags = $data->all()['newTags'];
        $id = $request->session()->get('id');

//        新标签
        foreach ($newTags as $newTag){
            foreach ($newTag as $tag){
                //将新标签插入标签表
                $fillable = [
                    'name' => $tag,
                    'state' =>0,
                    'type' =>0,
                ];
                $tag = new Tag($fillable);
                $tag->save();
                //插入数据到company_tag表
                $tagId = $tag->get()->max('id');
                DB::table('company_tag')->insert([
                    'companyId'  => $id,
                    'tagId'      => $tagId,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        }
        //旧标签
        foreach ($oldTags as $oldTag) {
            foreach ($oldTag as $tag) {
                DB::table('company_tag')->insert([
                    'companyId' => $id,
                    'tagId' => $tag,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
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

    public function getCompanyRegisterDesc(){
        return view('register.companyDesc');
    }

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

    }

}
