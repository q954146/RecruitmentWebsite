<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Check;
use App\Company;
use App\Http\Requests\CompanyRegisterRequest;
use App\Product;
use App\Question;
use App\Tag;
use App\Team;
use App\Token;
use App\Trade;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Validator;
use Mail;
use Illuminate\Support\Facades\Session;
use Storage;


class CompanyController extends Controller{

    private $user;

    /**
     * CompanyController constructor.
     */
    function __construct(){
        $this->user = Auth::user();
    }

    /**
     * 公司注册
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */


    public function getCompanyRegister(){
        return view('register.companyRegister',[
            'user' => $this->user
        ]);
    }

    /**
     * @param CompanyRegisterRequest $request 注册表单返回信息
     * 公司注册信息处理
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function postCompanyRegister(CompanyRegisterRequest $request){
//        dd($request);
        $name = $request->name;
        $email = $request->email;

        //生成token
        $urlToken = md5($name . '_' . $email . '_' . time());

        $fillable = [
            'name' => $name,
            'email' => $email,
            'time' => time(),
            'token' => $urlToken
        ];

        $token = new Token($fillable);

        //发送邮件
        $flag = Mail::queue('emails.companyVerification', ['token' => $urlToken], function ($message) use ($email) {
            $message->to($email)->subject('验证邮件');
        });

        if ($flag) {
            $token->save();
            return view('register.companyRegisterEmailSuccess',[
                'user' =>$this->user,
                'email' =>$email
            ]);
        } else {
            echo 'email false';
//            return back()->withErrors($request->messages())->withInput();
        }
    }

    /**
     * @param String $token url中token值
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 判断注册链接是否失效，并跳转到相应页面
     */
    public function getCompanyRegisterInfo($token){

        $token = Token::select('name','email','time')->where('token',$token)->get();
        $token = $token[0];
//        dd($arr[2]);

//        dd($token);
        //判断token是否过期
        $time = time();
        $timediff = $time - $token->time;
//        dd($timediff);
        $mins = intval($timediff / 60);


        $tradeInfos = Trade::select('name')->get();
        $tradeInfoArr = null;

        foreach ($tradeInfos as $key => $tradeInfo) {
            $tradeInfoArr[$key] = $tradeInfo->name;
        }

        if ($mins < 10) {
            Session::put('email', $token->email);
            return view('register.companyInfo', [
                'user' =>$this->user,
                'name' => $token->name,
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
    public function postCompanyRegisterInfo(Request $requests){

        $scales = [
            '少于15'      => 0,
            '15-50人'     => 1,
            '50-150人'    => 2,
            '150-500人'   => 3,
            '500-2000人'  => 4,
            '2000人以上'  => 5
        ];

        $stages = [
            '未融资'     => 0,
            '天使轮'     => 1,
            'A轮'        => 2,
            'B轮'        => 3,
            'C轮'        => 4,
            'D轮及以上'  => 5,
            '上市公司'   => 6
        ];
//        $trade_id = Trade::select('id')->where('name',$requests->get('trade'))->get()[0];

        $data = [
            'email'      => $requests->session()->get('email'),
            'desc'       => "",
            'state'      =>0,
            'name'       => $requests->get('name'),
            'shortName'  => $requests->get('shortName'),
            'tel'        => $requests->get('tel'),
            'logo'       => $requests->get('logo'),
            'web'        => $requests->get('web'),
            'city'       => $requests->get('city'),
            'trade_id'   => Trade::select('id')->where('name',$requests->get('trade'))->get()[0]['id'],
            'scale'      => $scales[$requests->get('scale')],
            'stage'      => $stages[$requests->get('stage')],
            'oneDesc'    => $requests->get('oneDesc')
        ];

        $company = new Company($data);
        $flag = $company->save();
        Session::put('id',$company['id']);

        return response()->json([
            "flag" => $flag,
            "url"  => "/register/company/tag"
        ]);
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

        $id = Session::get('id');
        return view('register.companyTags', [
            'user' =>$this->user,
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

        $tags =  $request->get('labels');
        $id = $request->session()->get('id');
        $company = Company::findorfail($id);
        foreach ($tags as $tag){
            $tagid = Tag::select('id')->where('name',$tag)->get()[0];
            $company->tags()->attach($tagid);
        }

        return response()->json([
            'flag' => true,
            'url'  => '/register/company/team'
        ]);
    }


    /**
     * 返回公司产品页面
     */
    public function getCompanyRegisterProduct(){
        return view('register.companyProduct',[
            'user' =>$this->user,
        ]);
    }

    /**
     * 插入公司产品
     * @param Request $request
     */
    public function postCompanyRegisterProduct(Request $request){

        $data = $request->all();
        unset($data['_token']);
        $arrs = array_chunk($data,5,true);
//        dd($arrs);
        $keys = null;
        $values = null;
        foreach ($arrs as $arr){
            foreach ($arr as $key => $value){
                $keys[] = explode("_", $key)[0];
                $values[] = $value;
            }
            $fillable = array_combine($keys, $values);
            unset($fillable['img']);
            $fillable['company_id'] = $request->session()->get('id');
//            dd($fillable);
            $team = Product::create($fillable);
        }
        return redirect('/register/company/desc');
    }

    /**
     * 返回公司团队页面
     */
    public function getCompanyRegisterTeam(){
        return view('register.companyTeam',[
            'user' => $this->user
        ]);
    }

    /**
     * 插入公司团队信息
     * @param Request $request
     */
    public function postCompanyRegisterTeam(Request $request){


        $data = $request->all();
        unset($data['_token']);
        $arrs = array_chunk($data,6,true);
//        dd($arr);
        $keys = null;
        $values = null;
        foreach ($arrs as $arr){
            foreach ($arr as $key => $value){
                $keys[] = explode("_", $key)[0];
                $values[] = $value;
            }
            $fillable = array_combine($keys, $values);
            unset($fillable['img']);
            $fillable['company_id'] = $request->session()->get('id');
            $team = Team::create($fillable);
        }
        return redirect('/register/company/product');

    }

    /**
     * 返回公司介绍页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCompanyRegisterDesc(){
        return view('register.companyDesc',[
            'user' =>$this->user,
        ]);
    }

    /**
     * 插入公司简介
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postCompanyRegisterDesc(Request $request){

//        dd($request->all());
        $desc = $request->get('desc');
        $id = $request->session()->get('id');
        /** @var Company $company */
        $company = Company::findorfail($id);
        $company->desc = $desc;
        $flag = $company->save();

//        dd($flag);
        if ($flag) {
            $this->CompanyChoose($id);
            return redirect('/');
        }
    }

    /**
     * 公司信息展示
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCompanyShow($id){

        $company = Company::findorfail($id);
        $products = $company->products;
        $teams = $company->teams;
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

        $scales = [
            "10-15人","15-50人","50-200人","200-500人","500-2000人","2000人以上"
        ];
        $stages = [
            '未融资','天使轮','A轮','B轮','C轮','D轮及以上','上市公司'
        ];

        //company信息获取
        $companyArr = [
            'id'        => $company->id,
            'name'      => $company->name,
            'shortName' => $company->shortName,
            'logo'      => $company->logo,
            'web'       => $company->web,
            'city'      => $company->city,
            'state'     => $company->state,
            'scale'     => $scales[$company->scale],
            'stage'     => $stages[$company->stage],
            'desc'      => $company->desc,
            'oneDesc'   => $company->oneDesc,
            'trade'     => $company->trade->name
        ];

        //tag信息获取
        foreach ($tags as $key => $tag){
            $tagArr[$key] = $tag->name;
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


        return view('index.company',[
            'user'         => $this->user,
            'tags'         => $tagArr,
            'company'      => $companyArr,
            'products'     => $productArr,
            'teams'        => $teamArr
        ]);

    }

    /**
     * 招聘管理人员选择所属公司
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCompanyChoose(){
//        dd(11);
        $companies = Company::all();
        return view('recruitment.companyChoose',[
            'companies' => $companies,
            'user' =>$this->user,
        ]);
    }

    /**
     * 招聘管理人员选择所属公司
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postCompanyChoose(Request $request){

        $id = $request->id;
        $this->CompanyChoose($id);
        return redirect('/');

    }

    /**
     * 得到公司留言
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCompanyAsk($id){

        $company = Company::findorfail($id);
        $teams = $company->teams;
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

        $scales = [
            "10-15人","15-50人","50-200人","200-500人","500-2000人","2000人以上"
        ];
        $stages = [
            '未融资','天使轮','A轮','B轮','C轮','D轮及以上','上市公司'
        ];

        //company信息获取
        $companyArr = [
            'id'        => $company->id,
            'name'      => $company->name,
            'shortName' => $company->shortName,
            'logo'      => $company->logo,
            'web'       => $company->web,
            'city'      => $company->city,
            'state'     => $company->state,
            'scale'     => $scales[$company->scale],
            'stage'     => $stages[$company->stage],
            'desc'      => $company->desc,
            'oneDesc'   => $company->oneDesc,
            'trade'     => $company->trade->name
        ];

        //tag信息获取
        foreach ($tags as $key => $tag){
            $tagArr[$key] = $tag->name;
        }

        $questions = $company->questions;


        return view('index.companyAsk',[
            'user' => $this->user,
            'tags'         => $tagArr,
            'company'      => $companyArr,
            'teams'        => $teamArr,
            'questions' => $questions
        ]);
    }

    /**
     * 得到答案
     * @param $id
     * @param $companyId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAnswer($id,$companyId){

        $company = Company::findorfail($companyId);
        $teams = $company->teams;
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

        $scales = [
            "10-15人","15-50人","50-200人","200-500人","500-2000人","2000人以上"
        ];
        $stages = [
            '未融资','天使轮','A轮','B轮','C轮','D轮及以上','上市公司'
        ];

        //company信息获取
        $companyArr = [
            'id'        => $company->id,
            'name'      => $company->name,
            'shortName' => $company->shortName,
            'logo'      => $company->logo,
            'web'       => $company->web,
            'city'      => $company->city,
            'state'     => $company->state,
            'scale'     => $scales[$company->scale],
            'stage'     => $stages[$company->stage],
            'desc'      => $company->desc,
            'oneDesc'   => $company->oneDesc,
            'trade'     => $company->trade->name
        ];

        //tag信息获取
        foreach ($tags as $key => $tag){
            $tagArr[$key] = $tag->name;
        }


        $question = Question::findorfail($id);
        $answers = $question->answers;

        return view('index.companyAnswer',[
            'user' => $this->user,
            'answers' => $answers,
            'question' => $question,
            'tags'         => $tagArr,
            'company'      => $companyArr,
            'teams'        => $teamArr,
        ]);
    }


    /**
     * 公司页面展示
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCompanies(){

        $scales = [
            "10-15人","15-50人","50-200人","200-500人","500-2000人","2000人以上"
        ];
        $stages = [
            '未融资','天使轮','A轮','B轮','C轮','D轮及以上','上市公司'
        ];

        $companies = Company::all();

        foreach ($companies as $company){
            $company['scale'] = $scales[$company['scale']];
            $company['stage'] = $stages[$company['stage']];
        }

//        dd($companies);
//        header("Content-Type: ".Storage::mimeType($companies[0]['logo']));
//        echo Storage::get($companies[0]['logo']);

        header('Content-Type:image/png');
        return view('index.companiesShow',[
            'user' => $this->user,
            'companies' => $companies
        ]);

    }


    /**
     * 提问
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postAskQuestion(Request $request){
        $company_id = $request->get('companyId');
        $content = $request->get('content');
        $data = [
            'company_id' => $company_id,
            'content' => $content,
            'created_at' => Carbon::now(),
            'update_at' => Carbon::now()
        ];

        $question = Question::create($data);
        $id = $question['id'];
        return response()->json([
            'url' => '/answer/show/'.$id
        ]);

    }


    /**
     * 选择公司
     * @param String $id
     */
    private function CompanyChoose($id){
//        $company = Company::findorfail($id);
        $flag = $this->user->company()->associate($id);
        $flag->save();
    }

    /** 回答
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postAnswer(Request $request){
//        dd($request->all());

        $user_id = $this->user['id'];
        $question_id = $request->get('question_id');
        $company_id = $request->get('company_id');
        $content = $request->get('content');

        $answer = Answer::create([
            'user_id' => $user_id,
            'question_id' => $question_id,
            'content' =>$content
        ]);
        return redirect('/answer/show/'.$question_id . '/' . $company_id);

    }

    public function getCheck(){
        return view('recruitment.companyCheck',[
            'user' => $this->user,

        ]);
    }

    public function postCheck(Request $request){

        $pic = $request->get('img');

        $flag = Check::insert([
            'user_id' => $this->user['id'],
            'picture' => $pic,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return response()->json([
            'flag' => $flag
        ]);
    }
}
