<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventRecomendationController;
use App\Http\Controllers\EventRegistrationController;
use App\Http\Controllers\EventReviewController;
use App\Http\Controllers\EventTaskController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\OrganizerTypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewCommentController;
use App\Http\Controllers\ReviewLikeController;
use App\Http\Controllers\ReviewPhotoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;


Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);

######################### CATEGORIES #########################
Route::apiResource('categories', CategoryController::class);
Route::patch('categories/{category}/discontinue', [CategoryController::class, 'discontinue'])->middleware(['auth:sanctum']);
Route::patch('categories/{category}/reactivate', [CategoryController::class, 'reactivate'])->middleware(['auth:sanctum']);

######################### ADDRESSES #########################
Route::apiResource('cities', CityController::class)->except(['update', 'destroy']);
Route::apiResource('countries', CountryController::class)->except(['update', 'destroy']);

######################### EVENTS #########################
Route::apiResource('events', EventController::class)->except(['update', 'destroy', 'store']);
Route::post('events', [EventController::class, 'store'])->middleware(['auth:sanctum']);
Route::put('events/{event}', [EventController::class, 'update'])->middleware(['auth:sanctum']);
Route::delete('events/{event}', [EventController::class, 'destroy'])->middleware(['auth:sanctum']);
Route::patch('events/{event}/publish', [EventController::class, 'publish'])->middleware(['auth:sanctum']);
Route::patch('events/{event}/cancel', [EventController::class, 'cancel'])->middleware(['auth:sanctum']);
//// Event recommendation
Route::patch('events/{event}/add-recommendation', [EventController::class, 'storeRecommendation'])->middleware(['auth:sanctum']);
Route::delete('events/{event}/remove-recommendation', [EventController::class, 'destroyRecommendation'])->middleware(['auth:sanctum']);
//// Event registration
Route::patch('events/{event}/register', [EventController::class, 'register'])->middleware(['auth:sanctum']);
Route::patch('events/{event}/unregister', [EventController::class, 'unregister'])->middleware(['auth:sanctum']);
Route::get('events/{event}/attendance-list', [EventController::class, 'getAttendanceList'])->middleware(['auth:sanctum']);
//// Event review
Route::post('events/{event}/reviews', [EventController::class, 'storeReview'])->middleware(['auth:sanctum']);
//// Event task
Route::post('events/{event}/tasks', [EventController::class, 'storeTask'])->middleware(['auth:sanctum']);
######################### EVENT RECOMENDATIONS #########################
Route::apiResource('event-recomendations', EventRecomendationController::class)->only(['index']);

######################### EVENT REVIEWS #########################
Route::apiResource('event-reviews', EventReviewController::class)->only(['index', 'show', 'update', 'destroy'])->middleware(['auth:sanctum']);
//// Review like
Route::post('event-reviews/{eventReview}/like', [EventReviewController::class, 'like'])->middleware(['auth:sanctum']);
Route::post('event-reviews/{eventReview}/unlike', [EventReviewController::class, 'unlike'])->middleware(['auth:sanctum']);
Route::post('event-reviews/{eventReview}/dislike', [EventReviewController::class, 'dislike'])->middleware(['auth:sanctum']);
Route::post('event-reviews/{eventReview}/undislike', [EventReviewController::class, 'undislike'])->middleware(['auth:sanctum']);
//// Review comment
Route::post('event-reviews/{eventReview}/add-comment', [EventReviewController::class, 'comment'])->middleware(['auth:sanctum']);
//// Review photo
Route::post('event-reviews/{eventReview}/add-photo', [EventReviewController::class, 'photo'])->middleware(['auth:sanctum']);
######################### EVENT TASKS #########################
Route::apiResource('event-tasks', EventTaskController::class)->only(['index', 'show', 'update', 'destroy'])->middleware(['auth:sanctum']);

######################### LOCATIONS #########################
Route::apiResource('locations', LocationController::class)->only(['index', 'show']);
Route::post('locations', [LocationController::class, 'store'])->middleware(['auth:sanctum']);
Route::put('locations/{location}', [LocationController::class, 'update'])->middleware(['auth:sanctum']);
Route::delete('locations/{location}', [LocationController::class, 'destroy'])->middleware(['auth:sanctum']);

######################### ORGANIZERS #########################
Route::apiResource('organizers', OrganizerController::class)->except(['show'])->middleware(['auth:sanctum']);
Route::get('organizers/{organizer}', [OrganizerController::class, 'show']);
Route::apiResource('organizer-types', OrganizerTypeController::class)->middleware(['auth:sanctum']);

######################### PROFILES #########################
Route::apiResource('profiles', ProfileController::class)->except(['destroy'])->middleware(['auth:sanctum']);

######################### REVIEW COMMENTS #########################
Route::apiResource('review-comments', ReviewCommentController::class)->only(['index', 'show', 'update', 'destroy'])->middleware(['auth:sanctum']);

######################### REVIEW PHOTOS #########################
Route::apiResource('review-photos', ReviewPhotoController::class)->only(['index', 'destroy'])->middleware(['auth:sanctum']);

######################### ROLES #########################
Route::apiResource('roles', RoleController::class)->only(['index', 'show'])->middleware(['auth:sanctum']);
