<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
	/**
	 * The list of the inputs that are never flashed to the session on validation exceptions.
	 *
	 * @var array<int, string>
	 */
	protected $dontFlash = [
		'current_password',
		'password',
		'password_confirmation',
	];

	/**
	 * Register the exception handling callbacks for the application.
	 */
	public function register(): void
	{
		$this->reportable(function (Throwable $e) {
			Log::channel('slack')->error($e->getMessage(), [
				'file' => $e->getFile(),
				'Line' => $e->getLine(),
				'code' => $e->getCode(),
			]);
		});
		$this->renderable(function (Throwable $e, Request $request) {
			$dataValidated = $this->validateException($e, $request);
			$response = [
				"http" => [
					"status" => $dataValidated['code'],
					"message" => $dataValidated['message'],
					"method" => $request->getMethod(),
					"success" => false
				],
				"errors" => $dataValidated['errors'],
			];
			return response()->json($response, $dataValidated['code']);
		});
	}

	protected function validateException(Throwable $e, Request $request): array
	{
		$response['errors'] = [];
		$response['message'] = $e->getMessage();
		$response['code'] = Response::HTTP_INTERNAL_SERVER_ERROR;

		if ($e instanceof \Maatwebsite\Excel\Validators\ValidationException) {
			$response['message'] = $e->getMessage();
			$response['errors'] = $e->validator->errors()->getMessages();
		}
		if ($e instanceof NotFoundHttpException) {
			$response['code'] = Response::HTTP_NOT_FOUND;
			$response['message'] = 'Element not found';
		}
		if ($e instanceof AccessDeniedHttpException) {
			$response['code'] = Response::HTTP_FORBIDDEN;
			$response['message'] = $e->getMessage() ?? 'Unauthorized';
		}
		if ($e instanceof ValidationException) {
			$response['errors'] = $e->validator->errors()->getMessages();
			$response['code'] = Response::HTTP_UNPROCESSABLE_ENTITY;
		}
		if ($e instanceof MethodNotAllowedHttpException) {
			$response['message'] = "The {$request->getMethod()} method is not supported for this route";
			$response['code'] = Response::HTTP_METHOD_NOT_ALLOWED;
		}
		if ($e instanceof UnauthorizedException || $e instanceof AuthenticationException) {
			$response['message'] = $e->getMessage();
			$response['code'] = Response::HTTP_UNAUTHORIZED;
		}
		if ($e instanceof BadRequestException) {
			$response['message'] = $e->getMessage();
			$response['code'] = Response::HTTP_BAD_REQUEST;
		}
		if ($e instanceof \BadMethodCallException) {
			$response['message'] = "Error during execution, please contact the administrator";
		}
		if ($e instanceof \ParseError || $e instanceof \Error) {
			$response['message'] = "Error during execution, please contact the administrator";
		}
		if ($e instanceof NotUpdatable) {
			$response['code'] = Response::HTTP_UNPROCESSABLE_ENTITY;
		}
		if($e instanceof UnauthorizedHttpException) {
			$response['message'] = $e->getMessage();
			$response['code'] = Response::HTTP_UNAUTHORIZED;
		}
		return $this->errorsDB($e, $response);
	}

	protected function errorsDB(Throwable $e, $response): array
	{
		if ($e instanceof QueryException) {
			$code = $e->getCode();
			switch ($code) {
				case 'HY000':
					$response['message'] = 'Missing data to insert';
					break;
				case '23000':
					$response['message'] = 'Duplicate element';
					$response['code'] = Response::HTTP_UNPROCESSABLE_ENTITY;
					break;
				case '1049':
					$response['message'] = 'Connection error, please contact the administrator.';
					break;
				case '1045':
					$response['message'] = 'Access denied to the database, please contact the administrator.';
					break;
				case '23502':
					$response['message'] = 'Error de constraint';
					$response['code'] = Response::HTTP_UNPROCESSABLE_ENTITY;
					if ($e->errorInfo[1] === 7) {
						$response['message'] = $e->errorInfo[2];
					}
					break;
				case '23514':
					$response['message'] = 'Value not accepted';
					$response['code'] = Response::HTTP_UNPROCESSABLE_ENTITY;
					if ($e->errorInfo[1] === 7) {
						$response['message'] = $e->errorInfo[2];
					}
					break;
				default:
					$response['message'] = 'Error DB. Please contact the administrator. Error code: ' . $e->getCode();
			}
		}
		return $response;
	}
}