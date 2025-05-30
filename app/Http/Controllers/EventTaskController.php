<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventTaskRequest;
use App\Http\Requests\UpdateEventTaskRequest;
use App\Models\EventTask;
use App\Http\Traits\ObjectManipulation;
use App\Http\Traits\ResponseIndex;
use App\Http\Traits\SuccessResponse;
use Illuminate\Http\Request;
use App\Http\Resources\EventTaskResource;

class EventTaskController extends Controller
{
    use ObjectManipulation, ResponseIndex, SuccessResponse;

    public function index(Request $request)
    {
        $filters = [
            'query' => ['event_id', 'assigned_to'],
            'like' => ['title', 'description', 'status']
        ];
        return $this->getIndex($request, EventTask::class, $filters, 'id', 'desc', EventTaskResource::class);
    }

    public function store(StoreEventTaskRequest $request)
    {
        return $this->createElement(EventTask::class, $request->validated(), EventTaskResource::class);
    }

    public function show(EventTask $eventTask)
    {
        return $this->response(EventTaskResource::make($eventTask));
    }

    public function update(UpdateEventTaskRequest $request, EventTask $eventTask)
    {
        return $this->updateElement($eventTask, $request->validated(), EventTaskResource::class);
    }

    public function destroy(EventTask $eventTask)
    {
        return $this->deleteElement($eventTask, EventTaskResource::class);
    }
}
