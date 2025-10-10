<?php

namespace App\DTOs;

class ScriptData
{
    public function __construct(
        public readonly int    $id,
        public readonly string $description,
        public readonly int    $status,
        public readonly int    $duration,
        public readonly string $created_at,
        public readonly string $updated_at,
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            description: $data['description'],
            status: $data['status'],
            duration: $data['duration'],
            created_at: $data['created_at'],
            updated_at: $data['updated_at'],
        );
    }
}


