<?php

namespace App\Http\Controllers;


use App\Education;
use App\HopeProfession;
use App\Project;
use App\Resume;
use App\Send;
use App\workExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Storage;

class ResumeController extends Controller{

    private $user;

    function __construct(){
        $this->user = Auth::user();
    }


    /**
     * 个人简历页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getResumeIndex(){

        $sexs = [
            '女','男'
        ];

        $workYears = [
            '应届毕业生','1年','2年','3年','4年','5年','6年','7年','8年','9年','10年及以上'
        ];


        $states = [
            '我目前已经离职，可以快速到岗','我目前正在职，正考虑换个新环境','我暂时不想找工作','我是应届毕业生'
        ];

        $educations = [
            '大专','本科','硕士','博士','其他'
        ];
        $natures = [
            '全职','兼职','实习'
        ];


        $resume = $this->user->resume;
        $hopeProfession = $resume->hopeProfession;
        $workExperience = $resume->workExperience;
        $resume['sex'] = $sexs[$resume['sex']];
        $resume['workYear'] = $workYears[$resume['workYear']];
        $resume['state'] = $states[$resume['state']];
        $resume['education'] = $educations[$resume['education']];
        $hopeProfession['nature'] = $natures[$hopeProfession['nature']];



        return view('apply.resume',[
            'resume' => $resume,
            'hopeProfession' =>$hopeProfession,
            'workExperience' => $workExperience,
            'user' => $this->user
        ]);
    }

    /**
     * 基本信息
     * @param Request $request
     */
    public function postBasicInfo(Request $request){

//        return response()->json([
//            'flag' => $request->get('education')
//        ]);

        $sexs = [
            '女' => 0,
            '男' => 1
        ];

        $educations = [
            '大专' => 0,
            '本科' => 1,
            '硕士' => 2,
            '博士' => 3,
            '其他' => 4
        ];

        $workYears = [
            '应届毕业生' => 0,
            '1年' => 1,
            '2年' => 2,
            '3年' => 3,
            '4年' => 4,
            '5年' => 5,
            '6年' => 6,
            '7年' => 7,
            '8年' => 8,
            '9年' => 9,
            '10年及以上' => 10
        ];

        $states = [
            '我目前已经离职，可以快速到岗' => 0,
            '我目前正在职，正考虑换个新环境' => 1,
            '我暂时不想找工作' => 2,
            '我是应届毕业生' => 3
        ];

        $resume = $this->user->resume;

        $sex = $request->get('sex');
        $workYear = $request->get('workYear');
        $education = $request->get('education');
        $state = $request->get('state');

        $data = [
            'name'            => $request->get('name'),
            'sex'             => $sexs[$sex],
            'workYear'        => $workYears[$workYear],
            'phone'           => $request->get('phone'),
            'education'       => $educations[$education],
            'email'           => $request->get('email'),
            'state'           => $states[$state],
        ];

        $flag = $resume->update($data);
        return response()->json([
            'flag' => $flag
        ]);

    }


    /**
     * 期望工作
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postHopeProfession(Request $request){
        $natures = [
            '全职' =>0,
            '兼职' =>1,
            '实习' =>2
        ];

        $resume = $this->user->resume;
        $nature = $request->get('nature');

        $fillable = [
            'city' => $request->get('city'),
            'nature' => $natures[$nature],
            'profession' => $request->get('profession'),
            'salary' => $request->get('salary'),
        ];

        $hope_profession = $resume->hopeProfession;
        $flag = $hope_profession->update($fillable);
        return response()->json([
            'flag' => $flag
        ]);
    }

    /**
     * 工作经验
     * @param Request $request
     */
    public function postWorkExperiences(Request $request){

        $workExperience = $this->user->resume->workExperience;

        $fillable = [
            'company' => $request->get('company'),
            'profession' => $request->get('profession'),
            'beginYearTime'  => $request->get('beginYearTime'),
            'beginMonthTime' => $request->get('beginMonthTime'),
            'endYearTime'    => $request->get('endYearTime'),
            'endMonthTime'   => $request->get('endMonthTime'),
        ];

        $flag = $workExperience->update($fillable);
        return response()->json([
           'flag' => $flag
        ]);
    }

    /**
     * 个人头像
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postImage(Request $request){

        $file = $request->file('file');

        $originalName = $file->getClientOriginalName(); // 文件原名
        $ext = $file->getClientOriginalExtension();     // 扩展名
        $realPath = $file->getRealPath();   //临时文件的绝对路径
        $type = $file->getClientMimeType();     // image/jpeg
        $logo = md5($originalName . time()) . '.' . $ext;

        $flag = Storage::disk()->put($logo, file_get_contents($realPath));

        $success = null;
        if ($flag == true){
            $resume = $this->user->resume;
            $success = $resume->update([
                'image' => $logo
            ]);
        }
        return response()->json([
            'flag' => $success
        ]);

    }

    /**
     * 简历预览
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getResumeDelivery($id){

        $types = [
            '在线简历','附件简历'
        ];

        switch ($id){
            case 0:{
                $sends = null;
                $sendsShow = null;
                $professions = $this->user->professions;
                foreach ($professions as $profession){
                    $send = Send::where('user_profession_id',$profession->pivot->id)->get()[0];
                    $send['sendType'] = $types[$send['sendType']];
                    $send['sendSuccessTime'] = date("Y-m-d ",$send['sendSuccessTime']);

                    if ($send['sendSuccessState'] == 1 && $send['inappropriateState'] == 0
                        && $send['viewedState'] == 0 && $send['auditionState'] == 0
                        && $send['pendingState'] == 0){
                        $send['type'] = '投递成功';
                    }

                    if ($send['sendSuccessState'] == 1 && $send['inappropriateState'] == 0
                        && $send['viewedState'] == 1 && $send['auditionState'] == 0
                        && $send['pendingState'] == 0){
                        $send['type'] = '被查看';
                    }

                    if ($send['sendSuccessState'] == 1 && $send['inappropriateState'] == 0
                        && $send['viewedState'] == 1 && $send['auditionState'] == 0
                        && $sends['pendingState'] == 1){
                        $send['type'] = '待沟通';
                    }

                    if ($send['sendSuccessState'] == 1 && $send['inappropriateState'] == 0
                        && $send['viewedState'] == 1 && $send['auditionState'] == 1
                        && $sends['pendingState'] == 1){
                        $send['type'] = '通知面试';
                    }

                    if ($send['inappropriateState'] == 1){
                        $send['type'] = '不合适';
                    }
                    $company = $profession->user->company;
                    $send['company'] = $company;
                    $send['profession'] = $profession;
                    $sends[] = $send;
                }

//                dd($sends);

                return view('apply.resumeDeliveryAll',[
                    'user' => $this->user,
                    'sends' => $sends
                ]);
            }
            case 1:{
                $sends = null;
                $sendsShow = null;
                $professions = $this->user->professions;
                foreach ($professions as $profession){
                    $send = Send::where('user_profession_id',$profession->pivot->id)->get()[0];
                    $send['sendType'] = $types[$send['sendType']];
                    $send['sendSuccessTime'] = date("Y-m-d ",$send['sendSuccessTime']);
                    $company = $profession->user->company;
                    $send['company'] = $company;
                    $send['profession'] = $profession;
                    $sends[] = $send;
                }

                for ($i = 0;$i < count($sends) ;$i++){
                    if ($sends[$i]['sendSuccessState'] == 1 && $sends[$i]['inappropriateState'] == 0
                        && $sends[$i]['viewedState'] == 0 && $sends[$i]['auditionState'] == 0
                        && $sends[$i]['pendingState'] == 0){
                        $sendsShow[] = $sends[$i];
                    }
                }

//                dd($sendsShow[0]['sendSuccessTime']);
                return view('apply.resumeDeliverySend',[
                    'user' => $this->user,
                    'sends' => $sendsShow
                ]);
            }
            case 2:{
                $sends = null;
                $sendsShow = null;
                $professions = $this->user->professions;
                foreach ($professions as $profession){
                    $send = Send::where('user_profession_id',$profession->pivot->id)->get()[0];
                    $send['sendType'] = $types[$send['sendType']];
                    $send['ViewedTime'] = date("Y-m-d ",$send['ViewedTime']);
                    $company = $profession->user->company;
                    $send['company'] = $company;
                    $send['profession'] = $profession;
                    $sends[] = $send;
                }

                for ($i = 0;$i < count($sends) ;$i++){
                    if ($sends[$i]['sendSuccessState'] == 1 && $sends[$i]['inappropriateState'] == 0
                        && $sends[$i]['viewedState'] == 1 && $sends[$i]['auditionState'] == 0
                        && $sends[$i]['pendingState'] == 0){
                        $sendsShow[] = $sends[$i];
                    }
                }

                return view('apply.resumeDeliveryViewed',[
                    'user' => $this->user,
                    'sends' => $sendsShow
                ]);
            }
            case 3:{

                $sends = null;
                $sendsShow = null;
                $professions = $this->user->professions;
                foreach ($professions as $profession){
                    $send = Send::where('user_profession_id',$profession->pivot->id)->get()[0];
                    $send['sendType'] = $types[$send['sendType']];
                    $send['pendingTime'] = date("Y-m-d ",$send['pendingTime']);
                    $company = $profession->user->company;
                    $send['company'] = $company;
                    $send['profession'] = $profession;
                    $sends[] = $send;
                }

                for ($i = 0;$i < count($sends) ;$i++){
                    if ($sends[$i]['sendSuccessState'] == 1 && $sends[$i]['inappropriateState'] == 0
                        && $sends[$i]['viewedState'] == 1 && $sends[$i]['auditionState'] == 0
                        && $sends[$i]['pendingState'] == 1){
                        $sendsShow[] = $sends[$i];
                    }
                }

                return view('apply.resumeDeliveryPending',[
                    'user' => $this->user,
                    'sends' => $sendsShow
                ]);
            }
            case 4:{

                $sends = null;
                $sendsShow = null;
                $professions = $this->user->professions;
                foreach ($professions as $profession){
                    $send = Send::where('user_profession_id',$profession->pivot->id)->get()[0];
                    $send['sendType'] = $types[$send['sendType']];
                    $send['auditionStateTime'] = date("Y-m-d ",$send['auditionStateTime']);
                    $company = $profession->user->company;
                    $send['company'] = $company;
                    $send['profession'] = $profession;
                    $sends[] = $send;
                }

                for ($i = 0;$i < count($sends) ;$i++){
                    if ($sends[$i]['sendSuccessState'] == 1 && $sends[$i]['inappropriateState'] == 0
                        && $sends[$i]['viewedState'] == 1 && $sends[$i]['auditionState'] == 1
                        && $sends[$i]['pendingState'] == 1){
                        $sendsShow[] = $sends[$i];
                    }
                }

                return view('apply.resumeDeliveryAudition',[
                    'user' => $this->user,
                    'sends' => $sendsShow
                ]);
            }
            case 5:{

                $sends = null;
                $sendsShow = null;
                $professions = $this->user->professions;
                foreach ($professions as $profession){
                    $send = Send::where('user_profession_id',$profession->pivot->id)->get()[0];
                    $send['sendType'] = $types[$send['sendType']];
                    $send['inappropriateTime'] = date("Y-m-d ",$send['inappropriateTime']);
                    $company = $profession->user->company;
                    $send['company'] = $company;
                    $send['profession'] = $profession;
                    $sends[] = $send;
                }

                for ($i = 0;$i < count($sends) ;$i++){
                    if ($sends[$i]['inappropriateState'] == 1){
                        $sendsShow[] = $sends[$i];
                    }
                }

                return view('apply.resumeDeliveryInappropriate',[
                    'user' => $this->user,
                    'sends' => $sendsShow
                ]);
            }
        }

    }


}