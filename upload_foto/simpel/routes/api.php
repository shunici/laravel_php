<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/ambil_data', 'footballController@index');   
Route::post('/upload', 'footballController@upload');
Route::delete('/hapus/{id}', 'footballController@delete');