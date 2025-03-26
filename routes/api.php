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

Route::post('validate-memberhsip-id', 'UsersController@validateMemberShipId')->name('validate-memberhsip-id');
Route::post('validate-memberhsip-ids', 'UsersController@validateMemberShipIds')->name('validate-memberhsip-ids');

Route::get('validate-memberhsip-ids', function(){ return response()->json( ['error' => 'no method found!'], 404); })->name('validate-memberhsip-ids');