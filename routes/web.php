<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('send_test_email', function(){
    Mail::send('email.send', function($message) {
        $message->from('info@domainname.com', 'Info Header');
        $message->to('19Rohochiy9519@rambler.ru');

    });
});


Route::group(['middleware' => ['auth']], function (){

    Route::resource('template', 'TemplateController');
    Route::resource('bunch', 'BunchController');
    Route::resource('campaign', 'CampaignController');
    //Route::resource('/subscrib', 'SubscriberController');
    //Route::get('bunch/{bunch}/subscrib', 'SubscriberController@index');
    Route::prefix('bunch/{bunch}')->group(function () {
        Route::resource('subscriber', 'SubscriberController');

    });
    Route::get('campaign/{campaign}/preview', 'CampaignController@preview')->name('campaign.preview');
    Route::get('campaign/{campaign}/preview/send', 'CampaignController@send')->name('campaign.send');
    
});

Route::get('/home', 'HomeController@index')->name('home');
