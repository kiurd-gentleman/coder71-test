<?php

namespace App\Http\Controllers;

use App\Models\ProductReview;
use App\Requests\StoreProductReviewRequest;

class ProductReviewController
{
    public $storeProductReviewRequest;
    public function __construct()
    {
        $this->storeProductReviewRequest = new StoreProductReviewRequest();

    }
    public function store()
    {
        $validation = $this->storeProductReviewRequest->validation();

        if($validation) {

            return json_encode(array(
                'errors' => $validation,
                'message' => 'Data Validation Error',
//                'code' => $status,
            ));
        }

        $request = $this->storeProductReviewRequest->getBody();

        $productReview = (object)[
            'product_id' => $request['product_id'],
            'user_id' => $request['user_id'],
            'rating' => $request['rating'],
            'review' => $request['review'],
        ];

        ProductReview::create($productReview);

        echo 'Product Review Stored';
    }
}