<?php

namespace App\Http\Controllers;

use App\Category;
use App\Profession;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProfessionController extends Controller{

    private $user;

    /**
     * CompanyController constructor.
     */
    function __construct(){
        $this->user = Auth::user();
    }

    /**
     * 发布新职位
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPublishProfession(){

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

//        dd($categoryZ[0]['name']);
//        dd($categoryArrs[0][0]['name']);

        return view('recruitment.publishProfession',[
            'user' => $this->user,
            'categoryArrs' => $categoryArrs,
            'categoriesZ' =>$categoryZ
        ]);
    }

    /**
     * 发布新职位
     * @param Request $request
     */
    public function postPublishProfession(Request $request){

//        dd($request->all());

        $workYears = [
            '不限' => 0,
            '应届毕业生' => 1,
            '1年以下' => 2,
            '1-3年' => 3,
            '3-5年' => 4,
            '5-10年' => 5,
            '10年以上' => 6
        ];

        $education = [
            '不限' => 0,
            '大专' => 1,
            '本科' => 2,
            '硕士' => 3,
            '博士' => 4,
        ];

        $name         = $request->get('name');
        $category_id  = Category::where('name',$request->get('categoryId'))->get()[0]['id'];
        $branch       = $request->get('categoryId') != "" ? $request->branch : null;
        $nature       = $request->get('nature');
        $salaryHigh   = $request->get('salaryHigh');
        $salaryLow    = $request->get('salaryLow');
        $city         = $request->get('city');
        $workYear     = $workYears[$request->get('workYear')];
        $edu          = $education[$request->get('edu')];
        $welfare      = $request->get('welfare');
        $desc         = $request->get('desc');
        $address      = $request->get('address');
        $email        = $request->get('email');
        $userId       = $this->user->id;

        $fillable = [
            'name' => $name,
            'category_id' => $category_id,
            'branch' => $branch,
            'nature' => $nature,
            'salaryHigh' => $salaryHigh,
            'salaryLow' => $salaryLow,
            'city' => $city,
            'workYear' => $workYear,
            'edu' => $edu,
            'welfare' => $welfare,
            'desc' => $desc,
            'address' => $address,
            'email' =>$email,
            'state' => 1,
            'user_id' => $userId,
        ];

//        dd($fillable);

        $profession = new Profession($fillable);
        $profession->save();
        return redirect('/');

    }

    /**
     * 下线职位信息
     * @param $id
     * @return Redirect
     */
    public function getDownlineProfession($id){

        $profession = Profession::findorfail($id);//根据id找到对应的职业信息
        $profession->state = 0;//将该条信息中state字段的值改为0（下线）
        $profession->save();//保存更改
        return redirect('/profession/downLine');//重定向到查看下线职位信息页面

    }

    /**
     * 上线职位信息
     * @param $id
     * @return Redirect
     */
    public function getOnlineProfession($id){

        $profession = Profession::findorfail($id);//根据id找到对应的职业信息
        $profession->state = 1;//将该条信息中state字段的值改为1（上线）
        $profession->save();//保存更改
        return redirect('/profession/onLine');//重定向到查看上线职位信息页面

    }

    /**
     * 展示有效职位
     */
    public function getOnlineProfessionShow(){

        $professions = Profession::where('user_id',$this->user->id)->get();

//        dd($professions);
        $professionInfos = null;

        $educations = [
            '大专','本科','硕士','博士','其他'
        ];

        $workYears = [
            '应届毕业生','1年','2年','3年','4年','5年','6年','7年','8年','9年','10年及以上'
        ];

        $natures = [
            '全职','兼职','实习'
        ];


//        dd($professions);

        foreach ($professions as $profession) {
//            dd($profession);
            if ($profession['state'] == 1) {
//                dd($profession['edu']);
                $edu = $profession['edu'];
                $workYear = $profession['workYear'];
                $nature = $profession['nature'];

                $profession['edu'] = $educations[$edu];
                $profession['workYear'] = $workYears[$workYear];
                $profession['nature'] = $natures[$nature];

                $professionInfos[] = $profession;
            }
        }

//        dd($professionInfos);
        return view('recruitment.effective',[
            'user' => $this->user,
            'professions' => $professionInfos
        ]);
    }

    /**
     * 展示无效职位
     */
    public function getDownlineProfessionShow(){

        $professions = $this->user->profession;

//        dd($professions);
        $professionInfos = null;

        $educations = [
            '大专','本科','硕士','博士','其他'
        ];

        $workYears = [
            '应届毕业生','1年','2年','3年','4年','5年','6年','7年','8年','9年','10年及以上'
        ];

        $natures = [
            '全职','兼职','实习'
        ];


//        dd($professions);

        foreach ($professions as $profession) {
//            dd($profession);
            if ($profession['state'] == 0) {
//                dd($profession['edu']);
                $edu = $profession['edu'];
                $workYear = $profession['workYear'];
                $nature = $profession['nature'];

                $profession['edu'] = $educations[$edu];
                $profession['workYear'] = $workYears[$workYear];
                $profession['nature'] = $natures[$nature];

                $professionInfos[] = $profession;
            }
        }

//        dd($professionInfos);
        return view('recruitment.invalid',[
            'user' => $this->user,
            'professions' => $professionInfos
        ]);
    }


    /**
     * 展示职位信息
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getShowProfession($id){

        $workYears = [
            '不限',
            '应届毕业生',
            '1年以下',
            '1-3年',
            '3-5年',
            '5-10年',
            '10年以上'
        ];

        $educations = [
            '不限',
            '大专',
            '本科',
            '硕士',
            '博士',
        ];

        $natures = [
            '全职','兼职','实习'
        ];

        $scales = [
            "10-15人","15-50人","50-200人","200-500人","500-2000人","2000人以上"
        ];
        $stages = [
            '未融资','天使轮','A轮','B轮','C轮','D轮及以上','上市公司'
        ];

        $profession = Profession::findorfail($id);
        $profession['workYear'] = $workYears[$profession['workYear']];
        $profession['edu'] = $educations[$profession['edu']];
        $profession['nature'] = $natures[$profession['nature']];

        $company = $profession->user->company;
        $company['scale'] = $scales[$company['scale']];
        $company['stage'] = $stages[$company['stage']];


        $collection = DB::table('user_collection')->where('user_id',$this->user['id'])
            ->where('profession_id',$id)->get();

//        dd($profession['collection']);

        $profession['collection'] = 1;

//        dd($collection);
        if ($collection == null){
            $profession['collection'] = 0;
        }

        $profession['send'] = DB::table('profession_user')->where('user_id',$this->user['id'])
            ->where('profession_id',$id)->get();
//        dd($profession['send']);

//        dd($profession);

        return view('index.jobShow',[
            'user' => $this->user,
            'profession' => $profession,
            'company' => $company
        ]);
    }


    /**
     * 得到收藏信息
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getShowCollection(){

        $workYears = [
            '应届毕业生','1年','2年','3年','4年','5年','6年','7年','8年','9年','10年及以上'
        ];

        $edus = [
            '大专','本科','硕士','博士','其他'
        ];

        $professionIds = DB::table('user_collection')->select('profession_id')
            ->where('user_id',$this->user['id'])->get();

//        dd($professionIds);

        $professions = null;
        foreach ($professionIds as $id){
            $profession = Profession::findorfail($id->profession_id);
            $profession['workYear'] = $workYears[$profession['workYear']];
            $profession['edu'] = $edus[$profession['edu']];
            $profession['send'] = DB::table('profession_user')->where('user_id',$this->user['id'])
                ->where('profession_id',$id->profession_id)->get();
            $professions[] = $profession;
        }

//        dd($professions);

        return view('apply.collection',[
            'user' => $this->user,
            'professions' => $professions

        ]);
    }

    /**
     * 收藏
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCollection(Request $request){

        $user_id = $this->user['id'];
        $profession_id = $request->get('id');

        $flag = DB::table('user_collection')->insert([
            'user_id' => $user_id,
            'profession_id' => $profession_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return response()->json([
            'flag' => $flag
        ]);
    }

    /**
     * 取消收藏
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCancelCollection(Request $request){

        $user_id = $this->user['id'];
        $profession_id = $request->get('id');

        $flag = DB::table('user_collection')->where('user_id', $user_id)
            ->where('profession_id', $profession_id)->delete();


        return response()->json([
            'flag' => $flag
        ]);
    }

}
