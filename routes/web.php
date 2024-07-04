<?php

use App\Core\Route;

Route::get('/hello', 'HomeController@index');
Route::get('/hello/{id}', 'HomeController@index');
Route::post('/hello', 'HomeController@store');
