<?php

namespace App\DTOs;

use Spatie\LaravelData\Data;

class ScriptData extends Data
{
    public function __construct(
        public string $name,
        public string $description,
        public int $status,
        public int $duration,
    ) {
    }
}
