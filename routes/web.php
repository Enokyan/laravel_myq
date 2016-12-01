<?php


Route::get('/', function () {
    return view('welcome');
});

//Auth
Auth::routes();
Route::get('/home', 'HomeController@index');

//socialit
Route::get('/redirect/{provider?}','SocialAuthController@redirect');
Route::get('/callback/{provider?}','SocialAuthController@callback');

// update delete
Route::get('delete',['uses' => 'UsersController@delete']);
Route::get('update',['uses' => 'UsersController@update']);

//chat//
Route::get('send/chat','ChatController@index');
Route::post('chat/add','ChatController@store');
Route::get('ajax','ChatController@ajax');
Route::post('upload_sms',['uses'=>'ChatController@upload']);

//users
Route::get('/',['uses' => 'UsersController@select_all']);
Route::post('product',['as'=>'product.index','uses'=>'ProductController@create']);
Route::get('user',['uses' => 'UsersController@select']);
Route::get('email',['uses' => 'UsersController@index']);
Route::post('sendmail',['as'=>'sendmail.index','uses' => 'UsermailController@sendmail']);

// false url
Route::get('/{name?}/{name2?}/{name3?}',['uses' => 'HomeController@error']);
