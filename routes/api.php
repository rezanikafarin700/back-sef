<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::group(['prefix' => 'users'],function (){
    Route::namespace('\App\Http\Controllers\API')->group(function (){
        Route::get('/','UserController@index');
        Route::get('/{id}','UserController@show');
    });
});
