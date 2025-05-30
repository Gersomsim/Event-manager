<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $path = $request->url();
        return [
            'id' => $this->id,
            $this->mergeWhen($path === route('login'), [
                'token_type' => 'Bearer',
                'token' => $this->token,
            ]),
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->getRol() ? $this->getRol() : null,
        ];
    }
}
