<?php

namespace app\Http\Controllers;


use \Illuminate\Http\Request;
use App\Profession;
use App\Resume;
use App\Send;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class SendController extends Controller {

    protected $user;
    protected  $sexs = [
        '女', '男'
    ];

    protected $workYears = [
        '应届毕业生',
        '1年以下',
        '1-3年',
        '3-5年',
        '5-10年',
        '10年以上'
    ];
    protected $educations = [
        '大专',
        '本科',
        '硕士',
        '博士',
    ];

    function __construct(){
        $this->user = Auth::user();
    }


    /**
     * 应聘人员投递简历
     * @param Request $request
     */
    public function postSendResume(Request $request){

//        dd($request->all());
        $profession_id = $request->get('id');
        $sendType = $request->get('sendType');
//        dd($sendType);

        $profession = Profession::findorfail($profession_id);
        $profession->users()->attach($this->user->id);


        $user_professionId = DB::table('profession_user')->select('id')->where(
            'user_id',$this->user->id)
            ->where('profession_id',$profession_id)->get()[0]->id;


        $time = time();
        $fillable = [
            'user_profession_id' => $user_professionId,
            'sendType' => $sendType,
            'sendSuccessState' => 1,
            'sendSuccessTime' => $time
        ];

        $flag = Send::create($fillable);

        return redirect()->back();

    }







    /**
     * 查询所有未查看简历,投递成功
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUnviewedResume(){

        $professions = $this->user->profession;
//        dd($professions);
        $resumes = null;
        $resumeShows = null;
        $sends = null;
        foreach ($professions as $profession) {
            foreach ($profession->users as $user) {
                $sends[] = Send::where('user_profession_id',$user->pivot->id)->get();
                $resume = $user->resume;
//                dd($resume);
                $sex = $resume['sex'];
                $workYear = $resume['workYear'];
                $education = $resume['education'];
                $resume['profession'] = $profession->name;
                $resume['profession_id'] = $profession->id;
                $resume['sex'] = $this->sexs[$sex];
                $resume['workYear'] = $this->workYears[$workYear];
                $resume['education'] = $this->educations[$education];
                $resumes[] = $resume;
            }
        }
        for ($i = 0;$i < count($sends) ;$i++){
//            dd($sends[1][0]);
            if ($sends[$i][0]['sendSuccessState'] == 1 && $sends[$i][0]['inappropriateState'] == 0
                && $sends[$i][0]['viewedState'] == 0 && $sends[$i][0]['auditionState'] == 0
                && $sends[$i][0]['pendingState'] == 0){
                $resumeShows[] = $resumes[$i];
            }
        }

        return view('recruitment.unviewedResume',[
            'user' => $this->user,
            'resumes' => $resumeShows
        ]);
    }


    /**
     * 查询所有已查看简历
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getViewedResume(){
        $professions = $this->user->profession;
//        dd($professions);
        $resumes = null;
        $resumeShows = null;
        $sends = null;
        foreach ($professions as $profession) {
            foreach ($profession->users as $user) {
                $sends[] = Send::where('user_profession_id', $user->pivot->id)->get();
                $resume = $user->resume;
//                dd($resume);
                $sex = $resume['sex'];
                $workYear = $resume['workYear'];
                $education = $resume['education'];
                $resume['profession'] = $profession->name;
                $resume['profession_id'] = $profession->id;
                $resume['sex'] = $this->sexs[$sex];
                $resume['workYear'] = $this->workYears[$workYear];
                $resume['education'] = $this->educations[$education];
                $resumes[] = $resume;
            }
        }
        for ($i = 0; $i < count($sends); $i++) {
//            dd($sends[1][0]);
            if ($sends[$i][0]['sendSuccessState'] == 1 && $sends[$i][0]['inappropriateState'] == 0
            && $sends[$i][0]['viewedState'] == 1 && $sends[$i][0]['auditionState'] == 0
            && $sends[$i][0]['pendingState'] == 0) {
                $resumeShows[] = $resumes[$i];
            }
        }

        return view('recruitment.viewedResume',[
            'user' => $this->user,
            'resumes' => $resumeShows
        ]);
    }


    /**
     * 查询所有待定简历，待处理
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPendingResume(){
        $professions = $this->user->profession;
//        dd($professions);
        $resumes = null;
        $resumeShows = null;
        $sends = null;
        foreach ($professions as $profession) {
            foreach ($profession->users as $user) {
                $sends[] = Send::where('user_profession_id',$user->pivot->id)->get();
                $resume = $user->resume;
//                dd($resume);
                $sex = $resume['sex'];
                $workYear = $resume['workYear'];
                $education = $resume['education'];
                $resume['profession'] = $profession->name;
                $resume['profession_id'] = $profession->id;
                $resume['sex'] = $this->sexs[$sex];
                $resume['workYear'] = $this->workYears[$workYear];
                $resume['education'] = $this->educations[$education];
                $resumes[] = $resume;
            }
        }
        for ($i = 0;$i < count($sends) ;$i++){
//            dd($sends[1][0]);
            if ($sends[$i][0]['sendSuccessState'] == 1 && $sends[$i][0]['inappropriateState'] == 0
                && $sends[$i][0]['viewedState'] == 1 && $sends[$i][0]['auditionState'] == 0
                && $sends[$i][0]['pendingState'] == 1){
                $resumeShows[] = $resumes[$i];
            }
        }

//        dd($resumeShows);

        return view('recruitment.pendingResume',[
            'user' => $this->user,
            'resumes' => $resumeShows
        ]);
    }




    /**
     * 查询所有通知面试的简历，
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAuditionResume(){
        $professions = $this->user->profession;
//        dd($professions);
        $resumes = null;
        $resumeShows = null;
        $sends = null;
        foreach ($professions as $profession) {
            foreach ($profession->users as $user) {
                $sends[] = Send::where('user_profession_id',$user->pivot->id)->get();
                $resume = $user->resume;
//                dd($resume);
                $sex = $resume['sex'];
                $workYear = $resume['workYear'];
                $education = $resume['education'];
                $resume['profession'] = $profession->name;
                $resume['profession_id'] = $profession->id;
                $resume['sex'] = $this->sexs[$sex];
                $resume['workYear'] = $this->workYears[$workYear];
                $resume['education'] = $this->educations[$education];
                $resumes[] = $resume;
            }
        }
        for ($i = 0;$i < count($sends) ;$i++){
//            dd($sends[1][0]);
            if ($sends[$i][0]['sendSuccessState'] == 1 && $sends[$i][0]['inappropriateState'] == 0
            && $sends[$i][0]['viewedState'] == 1 && $sends[$i][0]['auditionState'] == 1
            && $sends[$i][0]['pendingState'] == 1){
                $resumeShows[] = $resumes[$i];
            }
        }

//        dd($resumeShows);

        return view('recruitment.auditionResume',[
            'user' => $this->user,
            'resumes' => $resumeShows
        ]);
    }

    /**
     * 查询所有不合适简历
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getInappropriateResumeShow(){
        $professions = $this->user->profession;
//        dd($professions);
        $resumes = null;
        $resumeShows = null;
        $sends = null;
        foreach ($professions as $profession) {
            foreach ($profession->users as $user) {
                $sends[] = Send::where('user_profession_id',$user->pivot->id)->get();
                $resume = $user->resume;
//                dd($resume);
                $sex = $resume['sex'];
                $workYear = $resume['workYear'];
                $education = $resume['education'];
                $resume['profession'] = $profession->name;
                $resume['profession_id'] = $profession->id;
                $resume['sex'] = $this->sexs[$sex];
                $resume['workYear'] = $this->workYears[$workYear];
                $resume['education'] = $this->educations[$education];
                $resumes[] = $resume;
            }
        }
        for ($i = 0;$i < count($sends) ;$i++){
//            dd($sends[1][0]);
            if ( $sends[$i][0]['inappropriateState'] == 1){
                $resumeShows[] = $resumes[$i];
            }
        }

        return view('recruitment.inappropriateResume',[
            'user' => $this->user,
            'resumes' => $resumeShows
        ]);
    }



    /**
     * 查看简历
     * @param $resumeId
     * @param $professionId
     * @return Redirect
     */
    public function getViewResume($resumeId,$professionId){
        $resume = Resume::findorfail($resumeId);
        $userId = $resume->user->id;

        $id = DB::table('profession_user')->select('id')
            ->where('user_id',$userId)
            ->where('profession_id',$professionId)->get();

//        dd($id[0]->id);

//        /** @var Send $send */
        $send = Send::where('user_profession_id',$id[0]->id)->get();

//        dd($send);
        $send[0]->viewedState = 1;
        $send[0]->viewedTime = time();

//        dd($send);

        $send[0]->save();

        return redirect('/viewed/resume');

    }

    /**
     * 简历不合适
     * @param $resumeId
     * @param $professionId
     * @return Redirect
     */
    public function getInappropriateResume($resumeId,$professionId){
        $resume = Resume::findorfail($resumeId);
        $userId = $resume->user->id;

        $id = DB::table('profession_user')->select('id')
            ->where('user_id',$userId)
            ->where('profession_id',$professionId)->get();

//        dd($id[0]->id);

//        /** @var Send $send */
        $send = Send::where('user_profession_id',$id[0]->id)->get();

//        dd($send);
        $send[0]->inappropriateState = 1;
        $send[0]->inappropriateTime = time();

//        dd($send);

        $send[0]->save();

        return redirect('/inappropriate/resume');

    }

    /**
     * 待查看
     * @param $resumeId
     * @param $professionId
     * @return Redirect
     */
    public function getPending($resumeId,$professionId){
        $resume = Resume::findorfail($resumeId);
        $userId = $resume->user->id;

        $id = DB::table('profession_user')->select('id')
            ->where('user_id',$userId)
            ->where('profession_id',$professionId)->get();

//        dd($id[0]->id);

//        /** @var Send $send */
        $send = Send::where('user_profession_id',$id[0]->id)->get();

//        dd($send);
        $send[0]->pendingState = 1;
        $send[0]->pendingTime = time();
//        dd($send);
        $send[0]->save();

        return redirect('/pending/resume');
    }

    /**
     * 通知面试
     * @param Request $request
     * @return Redirect
     */
    public function postAudition(Request $request){

        $resumeId = $request->get('resumeId');
        $professionId = $request->get('professionId');

        $linkMan = $request->get('linkMan');
        $linkPhone = $request->get('linkPhone');
        $auditionTime = $request->get('auditionTime');
        $auditionAddress = $request->get('auditionAddress');

        $temp=explode("-",$auditionTime);

        $auditionTime = mktime(0,0,0,$temp[1],$temp[2],$temp[0]);

//        dd($auditionTime);

        $resume = Resume::findorfail($resumeId);
        $userId = $resume->user->id;
        $id = DB::table('profession_user')->select('id')
            ->where('user_id',$userId)
            ->where('profession_id',$professionId)->get();


        $send = Send::where('user_profession_id',$id[0]->id)->get();

        /** @var Send $send */
        $send = $send[0];
//        dd($send);

        $send->auditionStateTime = time();
        $send->auditionState = 1;

        $send->auditionLinkMan = $linkMan;
//        dd($send->auditionLinkMan);
        $send->auditionLinkPhone = $linkPhone;
        $send->auditionTime = $auditionTime;
        $send->auditionAddress = $auditionAddress;

        $send->save();
//        dd($send);

//        echo "success";

        return redirect('/audition/resume');

    }


}