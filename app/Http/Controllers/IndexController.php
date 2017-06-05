<?php

namespace App\Http\Controllers;

use App\Category;
use App\Company;
use App\Http\Requests\UpdatePasswordRequest;
use App\Profession;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller{

    protected $user;

    function __construct(){
        $this->user = Auth::user();
    }

    /**
     * 首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        $educations = [
            '大专','本科','硕士','博士','其他'
        ];

        $workYears = [
            '应届毕业生','1年','2年','3年','4年','5年','6年','7年','8年','9年','10年及以上'
        ];

        $natures = [
            '全职','兼职','实习'
        ];

        $states = [
            '未融资','天使轮','A轮','B轮','C轮','D轮及以上','上市公司'
        ];

        $scales = [
            '少于15人', '15-50人','50-150人','150-500人','500-2000人', '2000人以上'
        ];

        $professions = Profession::orderBy('created_at','DESC')->get();
        $professionsShow = null;
//        dd($professions);

        foreach ($professions as $profession){
            if ($profession['state'] == 1) {
                $nature = $profession['nature'];
                $education = $profession['edu'];
                $workYear = $profession['workYear'];
                $profession['company'] = $profession->user->company;
                $company_state = $profession['company']['state'];
                $company_scale = $profession['company']['scale'];

                $profession['nature'] = $natures[$nature];
                $profession['edu'] = $educations[$education];
                $profession['workYear'] = $workYears[$workYear];
                $profession['category'] = $profession->category->name;
                $profession['company']['state'] = $states[$company_state];
                $profession['company']['scale'] = $scales[$company_scale];
                $professionsShow[] = $profession;
            }

        }

        $categories =  Category::all();
        $categoryArrs = null;
        $categoriesZ = null;

        foreach ($categories as $category){
            if ($category['pId'] == 0){
                $categoryZ[] = $category;
            }
            if ($category['pId'] == 1){
                $categoryArrs[0][] = $category;
            }
            if ($category['pId'] == 2){
                $categoryArrs[1][] = $category;
            }
            if ($category['pId'] == 3){
                $categoryArrs[2][] = $category;
            }
            if ($category['pId'] == 4){
                $categoryArrs[3][] = $category;
            }
            if ($category['pId'] == 5){
                $categoryArrs[4][] = $category;
            }
            if ($category['pId'] == 6){
                $categoryArrs[5][] = $category;
            }
            if ($category['pId'] == 7){
                $categoryArrs[6][] = $category;
            }
            if ($category['pId'] == 8){
                $categoryArrs[7][] = $category;
            }
            if ($category['pId'] == 9){
                $categoryArrs[8][] = $category;
            }
        }


        //用户未登录
        if ($this->user == null){
            return view('index.indexNotLogin',[
//                'companies' => $companies,
                'professions' => $professionsShow,
                'categoriesZ' => $categoryZ,
                'categoryArrs' => $categoryArrs
            ]);
        }
        //应聘用户登录
        if ($this->user->type == 0) {
            return view('index.indexType0Login', [
                'user' => $this->user,
//                'companies' => $companies,
                'professions' => $professionsShow,
                'categoriesZ' => $categoryZ,
                'categoryArrs' => $categoryArrs
            ]);
        }
        //应聘用户登录
        if ($this->user->type == 1) {
            /** @var User $user */
            /** @var Company $company */
            $company = $this->user->company;
            if ($company != null) {
//                dd($user->company()->get());
                return view('index.indexType1Login', [
                    'user' => $this->user,
//                    'companies' => $companies,
                    'professions' => $professionsShow,
                    'categoriesZ' => $categoryZ,
                    'categoryArrs' => $categoryArrs
                ]);
            }

            return redirect('/company/choose/');

        }
    }

    /**
     * 查找信息
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function postSearch(Request $request){
//        dd($request->all());
        $educations = [
            '大专','本科','硕士','博士','其他'
        ];

        $workYears = [
            '应届毕业生','1年','2年','3年','4年','5年','6年','7年','8年','9年','10年及以上'
        ];


        $searchType = $request->get('searchType');
        $content = $request->get('content');

        if ($searchType == 1){//职位
            $professions = Profession::where('name','like','%'.$content.'%')->get();
            foreach ($professions as $profession){
                $profession['edu'] = $educations[$profession['edu']];
                $profession['workYear'] = $workYears[$profession['workYear']];
            }

//            dd($professions);

            return view('index.ProfessionSearch',[
                'user' => $this->user,
                'professions' => $professions
            ]);
        }
        if ($searchType == 2){//公司

            $stages = [
                '未融资','天使轮','A轮','B轮','C轮','D轮及以上','上市公司'
            ];

            $scales = [
                '少于15人', '15-50人','50-150人','150-500人','500-2000人', '2000人以上'
            ];

            $companies = Company::where('name','like','%'.$content.'%')->get();

            foreach ($companies as $company){
                $company['stage'] = $stages[$company['stage']];
                $company['scale'] = $scales[$company['scale']];
            }

//            dd($companies);
            return view('index.companySearch',[
                'user' => $this->user,
                'companies' => $companies
            ]);

        }

//        dd($request->all());
    }


    /**
     * 修改密码
     * @param UpdatePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUpdatePassword(UpdatePasswordRequest $request){

//        dd(\Hash::check($request->get('old_password'), $this->user->password));

        if (\Hash::check($request->get('old_password'), $this->user->password) ) {

            $this->user->password = bcrypt($request->get('password'));
            $this->user->save();
            return redirect()->to('/');
        }

        return redirect()->back()->with('password_update_failed', '修改密码失败');

    }

    /**
     * 修改密码
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUpdatePassword(){
        return view('index.updatePassword',[
            'user' =>$this->user
        ]);
    }

    /**
     * 侧边框
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCategorySearch($id){
//        dd($id);

        $educations = [
            '大专','本科','硕士','博士','其他'
        ];

        $workYears = [
            '应届毕业生','1年','2年','3年','4年','5年','6年','7年','8年','9年','10年及以上'
        ];

        $professions = Profession::where('category_id',$id)->get();
//        dd($professions);
        foreach ($professions as $profession){
            $profession['edu'] = $educations[$profession['edu']];
            $profession['workYear'] = $workYears[$profession['workYear']];
        }

        return view('index.ProfessionSearch',[
            'user' => $this->user,
            'professions' => $professions
        ]);
    }



}
