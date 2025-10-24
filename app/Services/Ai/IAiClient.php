<?php

namespace App\Services\Ai;

interface IAiClient
{
    public function sendRewriteRequest(string $text, ?string $instructions = null): string;

}
