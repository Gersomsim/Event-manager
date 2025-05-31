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

    // TODO: Revisar si se necesita este controlador
}
