<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('buses', 'ApiController@createBus');

Route::get('buses', 'ApiController@getAllBuses');
Route::get('buses/local/{is_Local}', 'ApiController@getLocalBus');
Route::get('buses/{id}', 'ApiController@getBus');
Route::get('buses/location/{source}/{destination}' , 'ApiController@getBusByLocation');

Route::put('buses/update/{id}', 'ApiController@updateBus');

Route::delete('buses/delete/{id}', 'ApiController@deleteBus');

Route::post('stops/create/{route_id}', 'StopsController@createStops');
Route::get('stops/getall', 'StopsController@getAllStops');
Route::get('stops/getstops/{id}', 'StopsController@getStops');
Route::put('stops/updatestops/{id}', 'StopsController@updateStops');
Route::delete('stops/delete/{id}', 'StopsController@deleteStops');


Route::post('location/create', 'LocationController@createLocation');
Route::get('location/getall', 'LocationController@getAllLocation');
Route::get('location/get/{id}', 'LocationController@getLocation');
Route::put('location/update/{id}', 'LocationController@updateLocation');
Route::delete('location/delete/{id}', 'LocationController@deleteLocation');