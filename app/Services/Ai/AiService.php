<?php

namespace App\Services\Ai;

class AiService
{
    private string $defaultPrompt;

    public function __construct(private IAiClient $AiClient)
    {
        $this->defaultPrompt = config('services.gigachat.default_prompt');
    }

    public function rewriteText(string $text, ?string $instructions = null): string
    {
        return $this->AiClient->sendRewriteRequest($text, $instructions);
    }
}
