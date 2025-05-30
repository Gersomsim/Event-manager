<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use App\Http\Traits\ObjectManipulation;
use App\Http\Traits\ResponseIndex;
use App\Http\Traits\SuccessResponse;
use Illuminate\Http\Request;
use App\Http\Resources\RoleResource;

class RoleController extends Controller
{
    use ObjectManipulation, ResponseIndex, SuccessResponse;

    public function index(Request $request)
    {
        $filters = [
            'like' => ['name', 'description']
        ];
        return $this->getIndex($request, Role::class, $filters, 'id', 'desc', RoleResource::class);
    }

    public function store(StoreRoleRequest $request)
    {
        return $this->createElement(Role::class, $request->validated(), RoleResource::class);
    }

    public function show(Role $role)
    {
        return $this->response(RoleResource::make($role));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        return $this->updateElement($role, $request->validated(), RoleResource::class);
    }

    public function destroy(Role $role)
    {
        return $this->deleteElement($role, RoleResource::class);
    }
}
