<?php

namespace App\DTOs;

use Spatie\LaravelData\Data;

class RewriteData extends Data
{
    public function __construct(
        public string $text,
    ) {}
}
