<?php

namespace App\Http\Controllers;

use App\Core\Request;
use App\Models\User;
use App\Requests\UserStoreRequest;

class HomeController
{
    private $userStoreRequest;
    public function __construct()
    {
        $this->userStoreRequest = new UserStoreRequest();
    }

    public function install()
    {

    }
    public function index()
    {
        echo 'Hello from HomeController';
    }

    public function store()
    {
        $validation = $this->userStoreRequest->validation();

        if($validation) {

            return json_encode(array(
                'errors' => $validation,
                'message' => 'Data Validation Error',
//                'code' => $status,
            ));
        }

        $request = $this->userStoreRequest->getBody();
//
        $user = (object)[
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'age' => $request['age'],
            'country' => $request['country'],
        ];

        User::create($user);
    }

}