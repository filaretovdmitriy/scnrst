<?php

namespace App\Services\Rewrite;

interface RewriteServiceInterface
{
    public function rewriteText(string $text, ?string $instructions = null): string;
}
