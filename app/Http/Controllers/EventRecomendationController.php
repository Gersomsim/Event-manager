<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRecomendationRequest;
use App\Http\Requests\UpdateEventRecomendationRequest;
use App\Models\EventRecomendation;
use App\Http\Traits\ObjectManipulation;
use App\Http\Traits\ResponseIndex;
use App\Http\Traits\SuccessResponse;
use Illuminate\Http\Request;
use App\Http\Resources\EventRecomendationResource;
use App\Models\Event;
use App\Http\Traits\GetProfileLogged;
use App\Http\Resources\EventResource;

class EventRecomendationController extends Controller
{
    use ObjectManipulation, ResponseIndex, SuccessResponse, GetProfileLogged;

    public function index(Request $request)
    {
        $filters = [
            'query' => ['event_id', 'user_id'],
            'like' => ['title', 'description']
        ];
        return $this->getIndex($request, EventRecomendation::class, $filters, 'id', 'desc', EventRecomendationResource::class);
    }
}
