<?php

//Auth
Auth::routes();
Route::get('/home', 'HomeController@index');


//socialit
Route::get('/redirect/{provider?}','SocialAuthController@redirect');
Route::get('/callback/{provider?}','SocialAuthController@callback');

// update delete
Route::get('delete',                ['uses' => 'UsersController@delete']);
Route::get('update',                ['uses' => 'UsersController@update']);

//chat//
Route::get('send_chat',             'ChatController@index')->middleware('login_auth');
Route::post('chat/add',             'ChatController@store');

Route::get('ajax','ChatController@ajax');
Route::post('upload_sms',           ['uses'=>'ChatController@upload']);


//select two chat
Route::get('send_sms_pdf',         ['uses' => 'MailController@sendChatMessage'])->middleware('login_auth');
Route::get('send_chat_two',         ['uses' => 'ChatTwoController@index'])->middleware('login_auth');
Route::post('select_twochat',       ['uses' => 'ChatTwoController@select_twochat']);
Route::post('chat2/add2',           'ChatTwoController@store');
Route::get('ajax2',                 'ChatTwoController@select_new');
Route::get('ajax3',                 'ChatTwoController@select_count_name');

//users select chat
Route::post('users/select',          ['uses' => 'ChatTwoController@users_select']);

//users
Route::get('/',                      ['uses' => 'UsersController@select_all']);
Route::post('product',               ['as'=>'product.index','uses'=>'ProductController@create']);
Route::get('user',                   ['uses' => 'UsersController@select']);
Route::get('email',                  ['uses' => 'UsersController@index']);
Route::post('sendmail',              ['as'=>'sendmail.index','uses' => 'UsermailController@sendmail']);

//send request friend
Route::post('frendrequest',              ['uses' => 'UsersController@frendrequest']);
Route::post('searchusers',              ['uses' => 'HomeController@searchUsers']);

//getfriendrequests
Route::post('getfriendrequests',              ['uses' => 'UsersController@getfriendrequests']);
Route::post('selectfriendrequests',              ['uses' => 'UsersController@selectfriendrequests']);
Route::post('addfriend',              ['uses' => 'UsersController@addfriend']);
Route::post('deletefriend',              ['uses' => 'UsersController@deletefriend']);





//fullcalendar
Route::get('/events', function(){
        return view('calendar/calendar');
    })->middleware('login_auth');

Route::get('calendar_result',       ['uses' => 'FullCalendarController@index']);

////// update user
Route::post('user/update',          ['uses'=>'HomeController@update_user']);



// false url
//Route::get('/{name?}/{name2?}/{name3?}',['uses' => 'HomeController@error']);



