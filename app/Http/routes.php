<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/','IndexController@index');

Route::post('/upload/picture','UploadController@pictureUpload');
Route::post('/upload/file','UploadController@fileUpload');
Route::post('/askQuestion','CompanyController@postAskQuestion');

Route::get('/profession/show/{id}','ProfessionController@getShowProfession');
Route::get('/company/show/{id}','CompanyController@getCompanyShow');
Route::get('/companyAsk/show/{id}','CompanyController@getCompanyAsk');

Route::get('/answer/show/{id}/{companyId}','CompanyController@getAnswer');
Route::get('/company','CompanyController@getCompanies');
Route::post('/answer','CompanyController@postAnswer');


Route::post('/search','IndexController@postSearch');
Route::get('/category/{id}','IndexController@getCategorySearch');

Route::group(['middleware' => 'auth'],function (){

    Route::get('/update/password','IndexController@getUpdatePassword');
    Route::post('/update/password','IndexController@postUpdatePassword');

    Route::group(['middleware' => 'ApplicantsAuthenticate'],function (){

        Route::get('/resume/delivery/{id}','ResumeController@getResumeDelivery');

        Route::get('/resume','ResumeController@getResumeIndex');

        Route::post('/resume/basic','ResumeController@postBasicInfo');

        Route::post('/resume/hopeProfession','ResumeController@postHopeProfession');

//        Route::post('/resume/project','ResumeController@postProject');

        Route::post('/resume/education','ResumeController@postEducation');

        Route::post('/resume/image','ResumeController@postImage');
//        Route::post('/resume/workExperience','ResumeController@postWorkExperiences');

        Route::get('/resume/show','ResumeController@getShowResume');

        Route::get('/send/resume','SendController@postSendResume');

        Route::get('/collection','ProfessionController@getShowCollection');

        Route::post('/postCollection','ProfessionController@postCollection');
        Route::post('/postCancelCollection','ProfessionController@postCancelCollection');


    });
//
    Route::group(['middleware' => 'RecruiterAuthenticate'],function (){

        Route::get('/register/company','CompanyController@getCompanyRegister');
        Route::post('/register/company','CompanyController@postCompanyRegister');

        Route::get('/register/company/info/{token}','CompanyController@getCompanyRegisterInfo');
        Route::post('/register/company/info','CompanyController@postCompanyRegisterInfo');

        Route::get('/register/company/tag','CompanyController@getCompanyRegisterTag');
        Route::post('/register/company/tag','CompanyController@postCompanyRegisterTag');

        Route::get('/register/company/product','CompanyController@getCompanyRegisterProduct');
        Route::post('/register/company/product','CompanyController@postCompanyRegisterProduct');

        Route::get('/register/company/team','CompanyController@getCompanyRegisterTeam');
        Route::post('/register/company/team','CompanyController@postCompanyRegisterTeam');

        Route::get('/register/company/desc','CompanyController@getCompanyRegisterDesc');
        Route::post('/register/company/desc','CompanyController@postCompanyRegisterDesc');

        Route::get('/profession/onLine','ProfessionController@getOnlineProfessionShow');
        Route::get('/downLineProfession/{id}','ProfessionController@getDownlineProfession');

        Route::get('/profession/downLine','ProfessionController@getDownlineProfessionShow');
        Route::get('/onLineProfession/{id}','ProfessionController@getOnlineProfession');

        Route::get('/profession/publish','ProfessionController@getPublishProfession');
        Route::post('/profession/publish','ProfessionController@postPublishProfession');

        Route::post('/company/choose','CompanyController@postCompanyChoose');
        Route::get('/company/choose','CompanyController@getCompanyChoose');

        Route::get('/unviewed/resume','SendController@getUnviewedResume');
        Route::get('/viewed/resume','SendController@getViewedResume');
        Route::get('/pending/resume','SendController@getPendingResume');
        Route::get('/audition/resume','SendController@getAuditionResume');
        Route::get('/inappropriate/resume','SendController@getInappropriateResumeShow');





        Route::get('/resume/view/{resumeId}/{professionId}','SendController@getViewResume');
        Route::get('/resume/pending/{resumeId}/{professionId}','SendController@getPending');
        Route::post('/resume/audition','SendController@postAudition');
        Route::get('/resume/inappropriate/{resumeId}/{professionId}','SendController@getInappropriateResume');

    });
});












Route:get('/getPicture','UploadController@getPicture');

// 认证路由...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
// 注册路由...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// 密码重置链接请求路由...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
// 密码重置路由...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
