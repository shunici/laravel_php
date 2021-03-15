<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::group(['prefix' => 'football'], function() {
    Route::get('/', 'footballController@index');   
    Route::post('/create', 'footballController@create');
    Route::get('/edit/{id}', 'footballController@edit');
    Route::put('/update/{id}', 'footballController@update');
    Route::delete('/delete/{id}', 'footballController@delete');
});



