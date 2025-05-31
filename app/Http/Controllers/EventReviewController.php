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
use App\Http\Traits\GetProfileLogged;
use App\Http\Requests\StoreReviewCommentRequest;
use App\Http\Resources\ReviewCommentResource;
use App\Http\Requests\StoreReviewPhotoRequest;
use App\Http\Resources\ReviewPhotoResource;
use App\Exceptions\BadRequestException;

class EventReviewController extends Controller
{
    use ObjectManipulation, ResponseIndex, SuccessResponse, LoggGetProfileLogged;

    public function index(Request $request)
    {
        $filters = [
            'query' => ['event_id', 'user_id'],
            'like' => ['title', 'content']
        ];
        return $this->getIndex($request, EventReview::class, $filters, 'id', 'desc', EventReviewResource::class);
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

    public function like(Request $request, EventReview $eventReview)
    {
        $profile_id = $this->getProfileLogged($request);
        $like = $eventReview->likes()->where('profile_id', $profile_id)->first();
        if ($like && $like->is_like) {
            throw new BadRequestException('You already liked this review');
        }
        if ($like) {
            $like->update([
                'is_like' => true,
            ]);
        } else {
            $eventReview->likes()->create([
                'profile_id' => $profile_id,
                'is_like' => true,
            ]);
        }
        return $this->response(EventReviewResource::make($eventReview), 'Liked successfully');
    }

    public function unlike(Request $request, EventReview $eventReview)
    {
        $profile_id = $this->getProfileLogged($request);
        $like = $eventReview->likes()->where('profile_id', $profile_id)->first();
        if (!$like) {
            throw new BadRequestException('You have not liked this review');
        }
        $like->delete();
        return $this->response(EventReviewResource::make($eventReview), 'Unliked successfully');
    }

    public function dislike(Request $request, EventReview $eventReview)
    {
        $profile_id = $this->getProfileLogged($request);
        $like = $eventReview->likes()->where('profile_id', $profile_id)->first();
        if ($like && !$like->is_like) {
            throw new BadRequestException('You already disliked this review');
        }
        if ($like) {
            $like->update([
                'is_like' => false,
            ]);
        } else {
            $eventReview->likes()->create([
                'profile_id' => $profile_id,
                'is_like' => false,
            ]);
        }
        return $this->response(EventReviewResource::make($eventReview), 'Disliked successfully');
    }

    public function undislike(Request $request, EventReview $eventReview)
    {
        $profile_id = $this->getProfileLogged($request);
        $like = $eventReview->likes()->where('profile_id', $profile_id)->first();
        if (!$like) {
            throw new BadRequestException('You have not disliked this review');
        }
        $like->delete();
        return $this->response(EventReviewResource::make($eventReview), 'Undisliked successfully');
    }

    public function comment(StoreReviewCommentRequest $request, EventReview $eventReview)
    {
        $profile_id = $this->getProfileLogged($request);
        $eventReview->comments()->create([
            'profile_id' => $profile_id,
            'comment' => $request->comment,
        ]);
        return $this->response(ReviewCommentResource::make($eventReview), 'Commented successfully');
    }

    public function photo(StoreReviewPhotoRequest $request, EventReview $eventReview)
    {
        $profile_id = $this->getProfileLogged($request);
        if( $eventReview->profile_id !== $profile_id) {
            throw new BadRequestException('You are not the owner of this review');
        }
        $eventReview->photos()->create([
            'photo' => $request->photo,
        ]);
        return $this->response(ReviewPhotoResource::make($eventReview), 'Photo added successfully');
    }
}
