<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrganizerTypeRequest;
use App\Http\Requests\UpdateOrganizerTypeRequest;
use App\Models\OrganizerType;
use App\Http\Traits\ObjectManipulation;
use App\Http\Traits\ResponseIndex;
use App\Http\Traits\SuccessResponse;
use Illuminate\Http\Request;
use App\Http\Resources\OrganizerTypeResource;

class OrganizerTypeController extends Controller
{
    use ObjectManipulation, ResponseIndex, SuccessResponse;

    public function index(Request $request)
    {
        $filters = [
            'like' => ['name', 'description']
        ];
        return $this->getIndex($request, OrganizerType::class, $filters, 'id', 'desc', OrganizerTypeResource::class);
    }

    public function store(StoreOrganizerTypeRequest $request)
    {
        return $this->createElement(OrganizerType::class, $request->validated(), OrganizerTypeResource::class);
    }

    public function show(OrganizerType $organizerType)
    {
        return $this->response(OrganizerTypeResource::make($organizerType));
    }

    public function update(UpdateOrganizerTypeRequest $request, OrganizerType $organizerType)
    {
        return $this->updateElement($organizerType, $request->validated(), OrganizerTypeResource::class);
    }

    public function destroy(OrganizerType $organizerType)
    {
        return $this->deleteElement($organizerType, OrganizerTypeResource::class);
    }
}
