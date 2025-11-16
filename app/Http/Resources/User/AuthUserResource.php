<?php

namespace App\Http\Resources\User;

use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;

class AuthUserResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    private ?string $token = null;

    public function withToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }

    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];

        if ($this->token) {
            $data['token'] = $this->token;
        }

        return [
            'data' => $data,
            'result' => 'success'
        ];
    }
}
