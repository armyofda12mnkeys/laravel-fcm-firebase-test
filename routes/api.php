<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/log', [
  'uses' => 'API\FirebaseController@log'
]);

Route::get('/pushlog/{token?}', [
  'uses' => 'API\FirebaseController@pushLog'
]);



Route::get('/push/{token?}', [
  'uses' => 'API\FirebaseController@pushMessage'
]);

Route::get('/pushwithdata/{token?}', [
  'uses' => 'API\FirebaseController@pushWithDataMessage'
]);

Route::get('/data/{token?}', [
  'uses' => 'API\FirebaseController@dataMessage'
]);


