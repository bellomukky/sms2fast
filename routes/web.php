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

Auth::routes(['verify'=>true]);
Route::get('/','HomeController@index')->name("home");
Route::get('/about-us','HomeController@about')->name("about");
Route::get('/sms-pricing','HomeController@pricing')->name("pricing");
Route::get('/contact','HomeController@contact')->name("contact");

Route::get('/user/coverage-lists','User\DashboardController@coverageList')->name('coverage.lists');
Route::get('/user/dashboard','User\DashboardController@index')->name("user.dashboard");
Route::get('/user/compose-sms','User\SMSController@composeSMS')->name("compose.sms");
Route::post('/user/send-sms','User\SMSController@sendSMS')->name("send.sms");
Route::get('/user/buy-sms','User\SMSController@buySMS')->name("buy.sms");
Route::post('/user/buy-sms','User\SMSController@verifySMSToken');
Route::get('/user/transfer-credit','User\SMSController@transferCredit')->name("transfer.credit");
Route::post('/user/transfer-credit','User\SMSController@postTransferCredit');
Route::get('/user/sms-log','User\SMSController@smsLog')->name("sms.log");
Route::post('/user/groups/get-contact','User\SMSController@getContact')->name('contacts.get');

Route::post('/user/groups/create','User\GroupController@create')->name("group.store");
Route::get('/user/groups','User\GroupController@index')->name("groups.index");
Route::get('/user/groups/{id}/manage','User\GroupController@manageGroup')->name("group.manage");
Route::get('/user/groups/{id}/upload','User\GroupController@uploadContact')->name("contact.upload");
Route::post('/user/groups/{id}/upload','User\GroupController@saveContact');
Route::get('user/contact/{id}/edit','User\GroupController@editContact')->name('contact.edit');
Route::post('user/contact/{id}/edit','User\GroupController@updateContact');
Route::delete('user/contact/{id}/delete','User\GroupController@deleteContact')->name('contact.delete');
Route::delete('user/groups/{id}/delete','User\GroupController@deleteGroup')->name('group.delete');







