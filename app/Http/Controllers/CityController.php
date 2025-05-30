<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use App\Http\Traits\ObjectManipulation;
use App\Http\Traits\ResponseIndex;
use App\Http\Traits\SuccessResponse;
use Illuminate\Http\Request;
use App\Http\Resources\CityResource;

class CityController extends Controller
{
    use ObjectManipulation, ResponseIndex, SuccessResponse;

    public function index(Request $request)
    {
        $filters = [
            'query' => ['country_id'],
            'like' => ['name']
        ];
        return $this->getIndex($request, City::class, $filters, 'id', 'desc', CityResource::class);
    }

    public function store(StoreCityRequest $request)
    {
        return $this->createElement(City::class, $request->validated(), CityResource::class);
    }

    public function show(City $city)
    {
        return $this->response(CityResource::make($city));
    }

    public function update(UpdateCityRequest $request, City $city)
    {
        return $this->updateElement($city, $request->validated(), CityResource::class);
    }

    public function destroy(City $city)
    {
        return $this->deleteElement($city, CityResource::class);
    }
}
