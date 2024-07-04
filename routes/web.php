<?php

use App\Core\Route;

Route::get('/hello', 'HomeController@index');
Route::get('/hello/{id}', 'HomeController@index');
