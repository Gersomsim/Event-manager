<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventReviewRequest;
use App\Http\Requests\UpdateEventReviewRequest;
use App\Models\EventReview;
use App\Http\Traits\ObjectManipulation;
use App\Http\Traits\ResponseIndex;
use App\Http\Traits\SuccessResponse;
use Illuminate\Http\Request;
use App\Http\Resources\EventReviewResource;

class EventReviewController extends Controller
{
    use ObjectManipulation, ResponseIndex, SuccessResponse;

    public function index(Request $request)
    {
        $filters = [
            'query' => ['event_id', 'user_id'],
            'like' => ['title', 'content']
        ];
        return $this->getIndex($request, EventReview::class, $filters, 'id', 'desc', EventReviewResource::class);
    }

    public function store(StoreEventReviewRequest $request)
    {
        return $this->createElement(EventReview::class, $request->validated(), EventReviewResource::class);
    }

    public function show(EventReview $eventReview)
    {
        return $this->response(EventReviewResource::make($eventReview));
    }

    public function update(UpdateEventReviewRequest $request, EventReview $eventReview)
    {
        return $this->updateElement($eventReview, $request->validated(), EventReviewResource::class);
    }

    public function destroy(EventReview $eventReview)
    {
        return $this->deleteElement($eventReview, EventReviewResource::class);
    }
}
