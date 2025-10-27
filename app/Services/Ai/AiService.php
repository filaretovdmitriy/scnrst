<?php

namespace App\Services\Ai;

use App\Interfaces\Ai\IAiClient;

class AiService
{
    public function __construct(private IAiClient $AiClient)
    {
        $this->defaultPrompt = config('services.gigachat.default_prompt');
    }

    public function rewriteText(string $text, ?string $instructions = null): string
    {
        return $this->AiClient->sendRewriteRequest($text, $instructions);
    }
}
