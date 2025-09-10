<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ScriptCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($script) {
            return [
                'id' => $script->id,
                'name' => $script->name,
                'description' => $script->description,
                'status' => $script->status,
                'duration' => $script->duration,
                'created_at' => $script->created_at,
                'updated_at' => $script->updated_at,
            ];
        })->toArray();
    }
}
