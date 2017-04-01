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

Route::get('/register/company','CompanyController@create');

Route::post('/register/company','CompanyController@store');

//Route::get('/register/company/{token}','CompanyController@verification');
Route::post('/register/company/info','CompanyController@companyRegisterInfo');



//Route::get('/ajax/test','CompanyController@ajaxCreate');
//Route::post('/ajax/test','CompanyController@ajaxStore');


Route::get('/ajax/test','CompanyController@ajaxCreate');
Route::post('/ajax/test','CompanyController@ajaxStore');
Route::post('/register/companyTag','CompanyController@companyRegisterTag');

Route::get('/register/company/{token}','CompanyController@verification');


Route::group(['middleware' => 'enableCrossRequestMiddleware'], function () {

});







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

