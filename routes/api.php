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

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('categories', CategoryController::class);
Route::apiResource('cities', CityController::class);
Route::apiResource('countries', CountryController::class);
Route::apiResource('events', EventController::class);
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
