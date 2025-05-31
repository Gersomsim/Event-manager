<?php

namespace App\Http\Traits;
use Illuminate\Http\Request;

trait GetProfileLogged
{
	public function getProfileId(Request $request)
	{
		return $request->user()->Profile->id;
	}
}