<?php

namespace App\Http\Controllers;

use App\Core\Request;

class HomeController
{
    public function index()
    {
        echo 'Hello from HomeController';
    }

    public function store(Request $request)
    {
        print_r($request);
        //post method
        echo $_POST['name'];
        echo $_POST['email'];
        echo 'Hello from HomeController@store';
    }

}