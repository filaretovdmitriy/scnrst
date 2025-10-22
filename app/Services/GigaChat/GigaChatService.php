<?php

namespace App\Services\GigaChat;

use App\DTOs\RewriteData;

class GigaChatService
{
    protected string $default_prompt;

    public function __construct()
    {
        $this->default_prompt = config('services.gigachat.default_prompt');
    }

    public function rewriteText(RewriteData $data, ?string $instructions = null): string
    {
        $gigaCharClient = new GigaChatClient;
        $rewritenText = $gigaCharClient->sendRewriteRequest($data, $instructions);

        return $rewritenText;
    }
}
