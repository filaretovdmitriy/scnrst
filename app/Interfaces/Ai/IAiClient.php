<?php

namespace App\Interfaces\Ai;

interface IAiClient
{
    public function sendRewriteRequest(string $text, ?string $instructions = null): string;

}
