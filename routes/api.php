<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::namespace('\App\Http\Controllers\API')->group(function (){
    Route::post('/login','AuthController@login');
});
Route::get('/test',function (Request $request){
    dd('salam reza');
})->middleware('check-token');

Route::group(['prefix' => 'users'],function (){
    Route::namespace('\App\Http\Controllers\API')->group(function (){
        Route::get('/','UserController@index')->middleware('check-token');
        Route::get('/{id}','UserController@show');
        Route::post('/','UserController@store');
        Route::put('/{id}','UserController@update');
        Route::delete('/{id}','UserController@destroy');
    });
});


Route::group(['prefix' => 'products'],function (){
    Route::namespace('\App\Http\Controllers\API')->group(function (){
        Route::get('/','ProductController@index');
        Route::get('/{id}','ProductController@show');
        Route::post('/','ProductController@store');
        Route::put('/{id}','ProductController@update');
        Route::delete('/{id}','ProductController@destroy');
    });
});
