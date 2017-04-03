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


Route::get('/', function () {
    return view('welcome',['name'=>'name']);
});

//Route::get('/register','RegisterController');

Route:post('update/picture','UpdateController@pictureUpdate');

Route::get('/register/company','CompanyController@getCompanyRegister');
Route::post('/register/company','CompanyController@postCompanyRegister');

Route::get('/register/company/info/{token}','CompanyController@getCompanyRegisterInfo');
Route::post('/register/company/info/','CompanyController@postCompanyRegisterInfo');

Route::get('/register/company/tag/','CompanyController@getCompanyRegisterTag');
Route::post('/register/company/tag/','CompanyController@postCompanyRegisterTag');

Route::get('/register/company/product/','CompanyController@getCompanyRegisterProduct');
Route::post('/register/company/product/','CompanyController@postCompanyRegisterProduct');

Route::get('/register/company/team/','CompanyController@getCompanyRegisterTeam');
Route::post('/register/company/team/','CompanyController@postCompanyRegisterTeam');

Route::get('/register/company/desc/','CompanyController@getCompanyRegisterDesc');
Route::post('/register/company/desc/','CompanyController@postCompanyRegisterDesc');

Route::get('/register/company/{id}','CompanyController@getCompanyShow');




//Route::group(['middleware' => 'enableCrossRequestMiddleware'], function () {
//
//});







//Route::get('/profession','ProfessionController');
//
//Route::get('/company','CompanyController');
//
//Route::get('/login','LoginController');
//
//Route::get('/','');
//
//Route::get('management','ManagementController');
//

