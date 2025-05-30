<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewLikeRequest;
use App\Http\Requests\UpdateReviewLikeRequest;
use App\Models\ReviewLike;
use App\Http\Traits\ObjectManipulation;
use App\Http\Traits\ResponseIndex;
use App\Http\Traits\SuccessResponse;
use Illuminate\Http\Request;
use App\Http\Resources\ReviewLikeResource;

class ReviewLikeController extends Controller
{
    use ObjectManipulation, ResponseIndex, SuccessResponse;

    public function index(Request $request)
    {
        $filters = [
            'query' => ['review_id', 'user_id']
        ];
        return $this->getIndex($request, ReviewLike::class, $filters, 'id', 'desc', ReviewLikeResource::class);
    }

    public function store(StoreReviewLikeRequest $request)
    {
        return $this->createElement(ReviewLike::class, $request->validated(), ReviewLikeResource::class);
    }

    public function show(ReviewLike $reviewLike)
    {
        return $this->response(ReviewLikeResource::make($reviewLike));
    }

    public function update(UpdateReviewLikeRequest $request, ReviewLike $reviewLike)
    {
        return $this->updateElement($reviewLike, $request->validated(), ReviewLikeResource::class);
    }

    public function destroy(ReviewLike $reviewLike)
    {
        return $this->deleteElement($reviewLike, ReviewLikeResource::class);
    }
}
