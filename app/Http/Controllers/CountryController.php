<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Country;
use App\Http\Traits\ObjectManipulation;
use App\Http\Traits\ResponseIndex;
use App\Http\Traits\SuccessResponse;
use Illuminate\Http\Request;
use App\Http\Resources\CountryResource;

class CountryController extends Controller
{
    use ObjectManipulation, ResponseIndex, SuccessResponse;

    public function index(Request $request)
    {
        $filters = [
            'query' => ['code'],
            'like' => ['name']
        ];
        return $this->getIndex($request, Country::class, $filters, 'id', 'desc', CountryResource::class);
    }

    public function store(StoreCountryRequest $request)
    {
        return $this->createElement(Country::class, $request->validated(), CountryResource::class);
    }

    public function show(Country $country)
    {
        return $this->response(CountryResource::make($country));
    }

    public function update(UpdateCountryRequest $request, Country $country)
    {
        return $this->updateElement($country, $request->validated(), CountryResource::class);
    }

    public function destroy(Country $country)
    {
        return $this->deleteElement($country, CountryResource::class);
    }
}
