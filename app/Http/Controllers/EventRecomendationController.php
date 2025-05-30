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

class EventRecomendationController extends Controller
{
    use ObjectManipulation, ResponseIndex, SuccessResponse;

    public function index(Request $request)
    {
        $filters = [
            'query' => ['event_id', 'user_id'],
            'like' => ['title', 'description']
        ];
        return $this->getIndex($request, EventRecomendation::class, $filters, 'id', 'desc', EventRecomendationResource::class);
    }

    public function store(StoreEventRecomendationRequest $request)
    {
        return $this->createElement(EventRecomendation::class, $request->validated(), EventRecomendationResource::class);
    }

    public function show(EventRecomendation $eventRecomendation)
    {
        return $this->response(EventRecomendationResource::make($eventRecomendation));
    }

    public function update(UpdateEventRecomendationRequest $request, EventRecomendation $eventRecomendation)
    {
        return $this->updateElement($eventRecomendation, $request->validated(), EventRecomendationResource::class);
    }

    public function destroy(EventRecomendation $eventRecomendation)
    {
        return $this->deleteElement($eventRecomendation, EventRecomendationResource::class);
    }
}
