<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrganizerRequest;
use App\Http\Requests\UpdateOrganizerRequest;
use App\Models\Organizer;
use App\Http\Traits\ObjectManipulation;
use App\Http\Traits\ResponseIndex;
use App\Http\Traits\SuccessResponse;
use Illuminate\Http\Request;
use App\Http\Resources\OrganizerResource;

class OrganizerController extends Controller
{
    use ObjectManipulation, ResponseIndex, SuccessResponse;

    public function index(Request $request)
    {
        $filters = [
            'query' => ['organizer_type_id'],
            'like' => ['name', 'description']
        ];
        return $this->getIndex($request, Organizer::class, $filters, 'id', 'desc', OrganizerResource::class);
    }

    public function store(StoreOrganizerRequest $request)
    {
        return $this->createElement(Organizer::class, $request->validated(), OrganizerResource::class);
    }

    public function show(Organizer $organizer)
    {
        return $this->response(OrganizerResource::make($organizer));
    }

    public function update(UpdateOrganizerRequest $request, Organizer $organizer)
    {
        return $this->updateElement($organizer, $request->validated(), OrganizerResource::class);
    }

    public function destroy(Organizer $organizer)
    {
        return $this->deleteElement($organizer, OrganizerResource::class);
    }
}
