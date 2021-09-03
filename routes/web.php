<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;


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

Route::get('/n', function () {
    return view('welcome');
});

Route::group(['namespace' => 'App\Http\Controllers'], function () {
Route::get('/', 'SiteController@videoindex');

Route::post('/ajax_upload/action', 'SiteController@quote_update')->name('ajaxupload.action');

Route::post('/ajax_upload/video', 'SiteController@update_video')->name('ajaxupload.video');

Route::get('/quote/index','SiteController@quote')->name('quote');
Route::post('/quote/update/{id?}','SiteController@quote_update')->name('quote_update');
Route::get('/quote/edit/{id}',['as'=>'quote_edit' ,'uses'=>'SiteController@quote_edit']);
Route::delete('/quote/delete/{id}','SiteController@quote_delete')->name('quote_delete');
Route::get('/quote/load_data','SiteController@quote_data');

Route::get('quote-add','SiteController@redrit')->name('quote-add');

});

Route::get('students/list', [SiteController::class, 'quote_data'])->name('students.list');
