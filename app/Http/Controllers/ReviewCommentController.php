<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewCommentRequest;
use App\Http\Requests\UpdateReviewCommentRequest;
use App\Models\ReviewComment;
use App\Http\Traits\ObjectManipulation;
use App\Http\Traits\ResponseIndex;
use App\Http\Traits\SuccessResponse;
use Illuminate\Http\Request;
use App\Http\Resources\ReviewComentResource;

class ReviewCommentController extends Controller
{
    use ObjectManipulation, ResponseIndex, SuccessResponse;

    public function index(Request $request)
    {
        $filters = [
            'query' => ['review_id', 'user_id'],
            'like' => ['content']
        ];
        return $this->getIndex($request, ReviewComment::class, $filters, 'id', 'desc', ReviewComentResource::class);
    }

    public function store(StoreReviewCommentRequest $request)
    {
        return $this->createElement(ReviewComment::class, $request->validated(), ReviewComentResource::class);
    }

    public function show(ReviewComment $reviewComment)
    {
        return $this->response(ReviewComentResource::make($reviewComment));
    }

    public function update(UpdateReviewCommentRequest $request, ReviewComment $reviewComment)
    {
        return $this->updateElement($reviewComment, $request->validated(), ReviewComentResource::class);
    }
    
    public function destroy(ReviewComment $reviewComment)
    {
        return $this->deleteElement($reviewComment, ReviewComentResource::class);
    }
}
