<?php

namespace App\Requests;

use App\Core\Request;

class StoreProductReviewRequest extends Request
{
    public function rules(): array
    {
        return [
            'product_id' => ['required'],
            'user_id' => ['required'],
            'rating' => ['required', 'min:1', 'max:5'],
            'review' => ['required', 'min:3', 'max:255'],
        ];
    }

}