<?php

//Auth
Route::get('{locale}/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('{locale}/login', 'Auth\LoginController@login');
Route::post('{locale}/logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('{locale}/register', 'Auth\RegisterController@showRegistrationForm');
Route::post('{locale}/register', 'Auth\RegisterController@register');
Route::get('{locale}/home', 'HomeController@index');


//socialit
Route::get('/redirect/{provider?}', 'SocialAuthController@redirect');
Route::get('/callback/{provider?}', 'SocialAuthController@callback');

// update delete
Route::get('{locale}/delete', ['uses' => 'UsersController@delete']);
Route::get('{locale}/update', ['uses' => 'UsersController@update']);

//chat//
Route::get('{locale}/send_chat', 'ChatController@index');
Route::post('chat/add', 'ChatController@store');

Route::get('ajax', 'ChatController@ajax');
Route::post('upload_sms', ['uses' => 'ChatController@upload']);


//select two chat
Route::get('send_sms_pdf', ['uses' => 'MailController@sendChatMessage'])->middleware('login_auth');
Route::get('{locale}/send_chat_two', ['uses' => 'ChatTwoController@index'])->middleware('login_auth');
Route::post('select_twochat', ['uses' => 'ChatTwoController@select_twochat']);
Route::post('chat2/add2', 'ChatTwoController@store');
Route::get('ajax2', 'ChatTwoController@select_new');
Route::get('ajax3', 'ChatTwoController@select_count_name');
Route::post('/delete_msg', 'ChatTwoController@delete_msg');
Route::post('/updatemessage', 'ChatTwoController@updatemessage');
Route::post('/getupdatedmessages', 'ChatTwoController@getupdatedmessages');




//online friend
Route::get('online_friend', 'ChatTwoController@online_friend');
Route::get('logaut_online', 'ChatTwoController@logaut_online');


//users select chat
Route::post('users/select', ['uses' => 'ChatTwoController@users_select']);

//users
Route::get('/', ['uses' => 'UsersController@select_all']);
Route::post('product', ['as' => 'product.index', 'uses' => 'ProductController@create']);
Route::get('user', ['uses' => 'UsersController@select']);
Route::get('email', ['uses' => 'UsersController@index']);
Route::post('sendmail', ['as' => 'sendmail.index', 'uses' => 'UsermailController@sendmail']);

//send request friend
Route::post('frendrequest', ['uses' => 'UsersController@frendrequest']);
Route::post('/searchusers', ['uses' => 'HomeController@searchUsers']);

//getfriendrequests
Route::post('/getfriendrequests', ['uses' => 'UsersController@getfriendrequests']);
Route::post('/selectfriendrequests', ['uses' => 'UsersController@selectfriendrequests']);
Route::post('/addfriend', ['uses' => 'UsersController@addfriend']);
Route::post('/deletefriend', ['uses' => 'UsersController@deletefriend']);





//fullcalendar


Route::get('{locale}/events', ['uses' => 'FullCalendarController@showcalendar']);
Route::get('calendar_result', ['uses' => 'FullCalendarController@index']);

////// update user
Route::post('/user/update', ['uses' => 'HomeController@update_user']);



//Admin
Route::get('login/admin', 'AdminController@loginForm');

