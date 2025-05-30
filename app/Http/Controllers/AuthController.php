<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\ObjectManipulation;
use App\Http\Traits\ResponseIndex;
use App\Http\Traits\SuccessResponse;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\AuthUserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AuthController extends Controller
{
	use SuccessResponse, ObjectManipulation, ResponseIndex;

	public function login(LoginRequest $request)
	{
        $data = $request->validated();
		if (!Auth::attempt($request->only('email', 'password'))) {
			throw  new BadRequestException('Las credenciales no coinciden');
		}
		$user = User::where('email', $data['email'])->firstOrFail();

		$user['token'] = $user->createToken('auth_token')->plainTextToken;

		return $this->response(AuthUserResource::make($user), method: $request->getMethod());
	}

	public function register(RegisterRequest $request)
	{
		$data = $request->validated();
		$data['password'] = Hash::make($data['password']);

		$user = User::create($data);
        // TODO: Assign role to user
        // TODO: Create profile for user with default values
        // TODO: Send welcome message to user
		return $this->response(
			AuthUserResource::make($user),
			method: $request->getMethod(),
			message: 'Elemento creado exitosamente'
		);
	}
    // TODO: Add forgot password functionality
    // TODO: Add reset password functionality
    // TODO: Add change password functionality
    // TODO: Add change email functionality

	public function logout()
	{
		Auth::user()->currentAccessToken()->delete();
		return $this->response([], message: 'Successfully logged out');
	}
}