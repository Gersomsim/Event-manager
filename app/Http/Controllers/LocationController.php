<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\Location;
use App\Http\Traits\ObjectManipulation;
use App\Http\Traits\ResponseIndex;
use App\Http\Traits\SuccessResponse;
use Illuminate\Http\Request;
use App\Http\Resources\LocationResource;

class LocationController extends Controller
{
    use ObjectManipulation, ResponseIndex, SuccessResponse;

    public function index(Request $request)
    {
        $filters = [
            'query' => ['city_id'],
            'like' => ['name', 'address']
        ];
        return $this->getIndex($request, Location::class, $filters, 'id', 'desc', LocationResource::class);
    }
    public function store(StoreLocationRequest $request)
    {
        return $this->createElement(Location::class, $request->validated(), LocationResource::class);
    }

    public function show(Location $location)
    {
        return $this->response(LocationResource::make($location));
    }

    public function update(UpdateLocationRequest $request, Location $location)
    {
        return $this->updateElement($location, $request->validated(), LocationResource::class);
    }

    public function destroy(Location $location)
    {
        return $this->deleteElement($location, LocationResource::class);
    }
}
