<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewPhotoRequest;
use App\Http\Requests\UpdateReviewPhotoRequest;
use App\Models\ReviewPhoto;
use App\Http\Traits\ObjectManipulation;
use App\Http\Traits\ResponseIndex;
use App\Http\Traits\SuccessResponse;
use Illuminate\Http\Request;
use App\Http\Resources\ReviewPhotoResource;

class ReviewPhotoController extends Controller
{
    use ObjectManipulation, ResponseIndex, SuccessResponse;

    public function index(Request $request)
    {
        $filters = [
            'query' => ['event_review_id'],
            'like' => ['photo_url']
        ];
        return $this->getIndex($request, ReviewPhoto::class, $filters, 'id', 'desc', ReviewPhotoResource::class);
    }

    public function destroy(ReviewPhoto $reviewPhoto)
    {
        return $this->deleteElement($reviewPhoto, ReviewPhotoResource::class);
    }
}
