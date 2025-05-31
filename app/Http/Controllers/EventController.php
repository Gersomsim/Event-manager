<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Const\EventStatus;
use App\Models\Event;
use App\Models\EventRecomendation;
use App\Models\EventRegistration;
use App\Models\EventReview;
use App\Models\EventTask;
use App\Http\Traits\ResponseIndex;
use App\Http\Traits\SuccessResponse;
use App\Http\Traits\GetProfileLogged;
use App\Http\Traits\ObjectManipulation;
use Illuminate\Http\Request;
use App\Exceptions\BadRequestException;
use App\Http\Requests\StoreEventReviewRequest;
use App\Http\Requests\StoreEventTaskRequest;
use App\Http\Requests\UpdateEventTaskRequest;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventTaskResource;
use App\Http\Resources\EventReviewResource;
use App\Http\Resources\EventRegistrationResource;

class EventController extends Controller
{
    use ObjectManipulation, ResponseIndex, SuccessResponse, GetProfileLogged;

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
    public function publish(Event $event)
    {
        if ($event->status === EventStatus::CANCELLED) {
            throw new BadRequestException('The event is cancelled');
        }
        if ($event->status === EventStatus::PUBLISHED) {
            throw new BadRequestException('The event is already published');
        }
        $event->status = EventStatus::PUBLISHED;
        $event->save();
        return $this->response(EventResource::make($event), 'Event published successfully');
    }

    public function cancel(Event $event)
    {
        if ($event->status === EventStatus::CANCELLED) {
            throw new BadRequestException('The event is already cancelled');
        }
        $event->status = EventStatus::CANCELLED;
        $event->save();
        return $this->response(EventResource::make($event), 'Event cancelled successfully');
    }
    public function storeRecommendation(Request $request, Event $event)
    {
        $profile_id = $this->getProfileId($request);
        $event_id = $event->id;
        $event_recomendation = EventRecomendation::where('event_id', $event_id)->where('profile_id', $profile_id)->first();
        if ($event_recomendation) {
            throw new BadRequestException('The event has already been recommended');
        }

        $event->recommendations()->create(['profile_id' => $profile_id]);
        return $this->response(EventResource::make($event), 'Event recommended successfully');
    }

    public function destroyRecommendation(Request $request, Event $event)
    {
        $profile_id = $this->getProfileId($request);
        $event_recomendation = EventRecomendation::where('event_id', $event_id)->where('profile_id', $profile_id)->first();
        if (!$event_recomendation) {
            throw new BadRequestException('The event has not been recommended');
        }
        $event_recomendation->delete();
        return $this->response(EventResource::make($event), 'Event recommendation deleted successfully');
    }
    public function register(Request $request, Event $event)
    {
        $profile_id = $this->getProfileId($request);
        $event_registration = EventRegistration::where('event_id', $event_id)->where('profile_id', $profile_id)->first();
        if ($event_registration) {
            throw new BadRequestException('The event has already been registered');
        }
        $event->registrations()->create(['profile_id' => $profile_id]);
        return $this->response(EventResource::make($event), 'Event registered successfully');
    }

    public function unregister(Request $request, Event $event)
    {
        $profile_id = $this->getProfileId($request);
        $event_registration = EventRegistration::where('event_id', $event_id)->where('profile_id', $profile_id)->first();
        if (!$event_registration) {
            throw new BadRequestException('The event has not been registered');
        }
        $event_registration->delete();
        return $this->response(EventResource::make($event), 'Event unregistered successfully');
    }
    public function getAttendanceList(Request $request, Event $event)
    {
        $event_registrations = EventRegistration::where('event_id', $event_id)->get();
        return $this->response(EventRegistrationResource::collection($event_registrations));
    }
    public function storeReview(StoreEventReviewRequest $request, Event $event)
    {
        $profile_id = $this->getProfileId($request);
        $event_review = EventReview::where('event_id', $event_id)->where('profile_id', $profile_id)->first();
        if ($event_review) {
            throw new BadRequestException('The event has already been reviewed');
        }
        $event_review = $event->reviews()->create($request->validated());
        return $this->response(EventReviewResource::make($event_review), 'Review created successfully');
    }
    public function storeTask(StoreEventTaskRequest $request, Event $event)
    {
        $profile_id = $this->getProfileId($request);
        $event_task = $event->tasks()->create($request->validated());
        return $this->response(EventTaskResource::make($event_task), 'Task created successfully');
    }
}
