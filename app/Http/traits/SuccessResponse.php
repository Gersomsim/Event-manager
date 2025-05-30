<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

trait SuccessResponse
{
	/**
	 * @param $data
	 * @param $method string  method to call
	 * @param $message string Message to display
	 * @param $code int http status code
	 * @param $success bool Database response
	 * @return JsonResponse
	 */
	public function response(
		$data,
		string $method = 'GET',
		string $message = '',
		int $code = ResponseAlias::HTTP_OK,
		bool $success = true,
	): JsonResponse {
		$response = [
			"http" => [
				"status" => $code,
				"message" => $message,
				"method" => $method,
				"success" => $success
			],
			"data" => $data,
		];
		return response()->json($response, $code);
	}

	public function responseWithPagination($paginator, $resource = ''): JsonResponse
	{
		$totalRows = $paginator->total();
		$currentPage = $paginator->currentPage();
		$totalPages = $paginator->lastPage();
		$nextPage = ($totalPages > $currentPage) ? ($currentPage + 1) : $currentPage;
		$prevPage = ($currentPage === 1) ? null : ($currentPage - 1);
		$response = [
			"http" => [
				"status" => Response::HTTP_OK,
				"message" => null,
				"method" => "GET",
				"success" => true
			],
			"data" => $resource ? $resource::Collection($paginator->items()) : $paginator->items(),
			"pages" => [
				"currentPage" => $currentPage,
				"nextPage" => $nextPage,
				"totalPages" => $paginator->lastPage(),
				"perPage" => $paginator->perPage(),
				"totalRecords" => $totalRows,
				"prevPage" => $prevPage
			]
		];
		return response()->json($response, Response::HTTP_OK);
	}
}