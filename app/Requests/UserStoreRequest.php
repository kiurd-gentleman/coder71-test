<?php

namespace App\Requests;

use App\Core\Request;

class UserStoreRequest extends Request
{
    public function rules(): array
    {
        return [
            'first_name' =>[self::RULE_REQUIRED],
            'last_name' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
        ];
    }

}