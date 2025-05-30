<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRegistrationRequest;
use App\Http\Requests\UpdateEventRegistrationRequest;
use App\Models\EventRegistration;
use App\Http\Traits\ObjectManipulation;
use App\Http\Traits\ResponseIndex;
use App\Http\Traits\SuccessResponse;
use Illuminate\Http\Request;
use App\Http\Resources\EventRegistrationResource;

class EventRegistrationController extends Controller
{
    use ObjectManipulation, ResponseIndex, SuccessResponse;

    public function index(Request $request)
    {
        $filters = [
            'query' => ['event_id', 'user_id'],
            'like' => ['status']
        ];
        return $this->getIndex($request, EventRegistration::class, $filters, 'id', 'desc', EventRegistrationResource::class);
    }

    public function store(StoreEventRegistrationRequest $request)
    {
        return $this->createElement(EventRegistration::class, $request->validated(), EventRegistrationResource::class);
    }

    public function show(EventRegistration $eventRegistration)
    {
        return $this->response(EventRegistrationResource::make($eventRegistration));
    }

    public function update(UpdateEventRegistrationRequest $request, EventRegistration $eventRegistration)
    {
        return $this->updateElement($eventRegistration, $request->validated(), EventRegistrationResource::class);
    }

    public function destroy(EventRegistration $eventRegistration)
    {
        return $this->deleteElement($eventRegistration, EventRegistrationResource::class);
    }
}
