<?php

namespace App\DTOs;

class ScriptData
{
    public function __construct(
        public readonly string $description,
        public readonly int $status,
        public readonly int $duration,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            description: $data['description'],
            status: $data['status'],
            duration: $data['duration'],
        );
    }

    public function toArray(): array
    {
        return [
            'description' => $this->description,
            'status' => $this->status,
            'duration' => $this->duration,

        ];
    }
}
