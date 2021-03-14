<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::group(['prefix' => 'football'], function() {
    Route::get('/', 'footballController@index');   
    Route::post('/create', 'footballController@create');
    Route::get('/edit/{id}', 'footballController@edit');
    Route::put('/update/{id}', 'footballController@update');
    Route::delete('/delete/{id}', 'footballController@delete');
});


// Route::resource('todo', 'toDoController');
// Route::group(['prefix' => 'product'], function() {
//     Route::get('/', 'ProductController@index');
//     Route::get('/new', 'ProductController@create');
//     Route::post('/', 'ProductController@save');
//     Route::get('/{id}', 'ProductController@edit');
//     Route::put('/{id}', 'ProductController@update');
//     Route::delete('/{id}', 'ProductController@destroy');
//     });
