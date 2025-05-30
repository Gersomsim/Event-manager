<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Http\Traits\ObjectManipulation;
use App\Http\Traits\ResponseIndex;
use App\Http\Traits\SuccessResponse;
use Illuminate\Http\Request;
use App\Http\Resources\EventResource;

class EventController extends Controller
{
    use ObjectManipulation, ResponseIndex, SuccessResponse;

    public function index(Request $request)
    {
        $filters = [
            'query' => ['category_id', 'organizer_id', 'location_id'],
            'like' => ['name', 'description']
        ];
        return $this->getIndex($request, Event::class, $filters, 'id', 'desc', EventResource::class);
    }

    public function store(StoreEventRequest $request)
    {
        return $this->createElement(Event::class, $request->validated(), EventResource::class);
    }

    public function show(Event $event)
    {
        return $this->response(EventResource::make($event));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        return $this->updateElement($event, $request->validated(), EventResource::class);
    }

    public function destroy(Event $event)
    {
        return $this->deleteElement($event, EventResource::class);
    }
}
