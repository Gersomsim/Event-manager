<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use App\Http\Traits\ObjectManipulation;
use App\Http\Traits\ResponseIndex;
use App\Http\Traits\SuccessResponse;
use Illuminate\Http\Request;
use App\Http\Resources\ProfileResource;

class ProfileController extends Controller
{
    use ObjectManipulation, ResponseIndex, SuccessResponse;

    public function index(Request $request)
    {
        $filters = [
            'query' => ['user_id'],
            'like' => ['first_name', 'last_name', 'bio']
        ];
        return $this->getIndex($request, Profile::class, $filters, 'id', 'desc', ProfileResource::class);
    }

    public function store(StoreProfileRequest $request)
    {
        return $this->createElement(Profile::class, $request->validated(), ProfileResource::class);
    }

    public function show(Profile $profile)
    {
        return $this->response(ProfileResource::make($profile));
    }

    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        return $this->updateElement($profile, $request->validated(), ProfileResource::class);
    }

    public function destroy(Profile $profile)
    {
        return $this->deleteElement($profile, ProfileResource::class);
    }
}
