<?php

namespace App\Http\Controllers\Traits;

use App\Exceptions\NotUpdatable;
use Symfony\Component\HttpFoundation\Response;

trait ObjectManipulation
{
	public function updateElement($object, $data, $resource = '', $validateClean = true): \Illuminate\Http\JsonResponse
	{
		$object->fill($data);

		if ($validateClean && $object->isClean()) {
			throw new NotUpdatable('Nothing to update');
		}

		$affected = $object->save();

		return $this->response(
			$resource ? $resource::make($object->fresh()) : $object->fresh(),
			method: 'PUT',
			message: 'Updated successfully',
			code: Response::HTTP_OK,
			success: $affected
		);
	}


	public function createElement($object, $data, $resource = ''): \Illuminate\Http\JsonResponse
	{
		$newObject = $object::create($data)->fresh();
		return $this->response(
			data: $resource ? $resource::make($newObject) : $newObject,
			method: 'POST',
			message: 'Created successfully',
			code: Response::HTTP_CREATED
		);
	}

	public function deleteElement($element, $resource = ''): \Illuminate\Http\JsonResponse
	{
		$affected = $element->delete();
		return $this->response(
			$resource ? $resource::make($element) : $element,
			method: 'DELETE',
			message: 'Deleted successfully',
			code: Response::HTTP_OK,
			success: $affected
		);
	}
}