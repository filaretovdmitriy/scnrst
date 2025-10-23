<?php

namespace App\Services\GigaChat;

class GigaChatService
{
    private string $defaultPrompt;

    public function __construct(private GigaChatClient $gigaChatClient)
    {
        $this->defaultPrompt = config('services.gigachat.default_prompt');
    }

    public function rewriteText(string $text, ?string $instructions = null): string
    {
        return $this->gigaChatClient->sendRewriteRequest($text, $instructions);
    }
}
