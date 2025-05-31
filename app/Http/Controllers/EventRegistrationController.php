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

    //TODO: Eliminar este controlador si no se usa
}
