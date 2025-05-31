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
Route::patch('events/{event}/finalize', [EventController::class, 'finalize'])->middleware(['auth:sanctum']);

######################### EVENT RECOMENDATIONS #########################
Route::apiResource('event-recomendations', EventRecomendationController::class);
Route::apiResource('event-registrations', EventRegistrationController::class);
Route::apiResource('event-reviews', EventReviewController::class);
Route::apiResource('event-tasks', EventTaskController::class);
Route::apiResource('locations', LocationController::class);
Route::apiResource('organizers', OrganizerController::class);
Route::apiResource('organizer-types', OrganizerTypeController::class);
Route::apiResource('profiles', ProfileController::class);
Route::apiResource('review-comments', ReviewCommentController::class);
Route::apiResource('review-likes', ReviewLikeController::class);
Route::apiResource('review-photos', ReviewPhotoController::class);
Route::apiResource('roles', RoleController::class);
