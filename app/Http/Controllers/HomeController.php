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
//        var_dump($request);


        $user = (object)[
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'email' => $_POST['email'],
            'age' => $_POST['age'],
            'country' => $_POST['country'],
        ];

        User::create($user);
    }

}