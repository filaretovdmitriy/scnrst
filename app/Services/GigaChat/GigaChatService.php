<?php

namespace App\Services\GigaChat;

use App\DTOs\RewriteData;

class GigaChatService
{
    private string $defaultPrompt;

    public function __construct()
    {
        $this->defaultPrompt = config('services.gigachat.default_prompt');
    }

    public function rewriteText(RewriteData $data, ?string $instructions = null): string
    {
        $gigaChatClient = new GigaChatClient;

        return $gigaChatClient->sendRewriteRequest($data, $instructions);
    }
}
