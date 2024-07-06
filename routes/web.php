<?php

use App\Core\Route;

Route::get('/', 'HomeController@index');
Route::get('/install', 'HomeController@install');
Route::get('/hello/{id}', 'HomeController@index');
Route::post('/store', 'HomeController@store');
