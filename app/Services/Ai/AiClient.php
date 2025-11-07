<?php

namespace App\Services\Ai;

use App\Exceptions\AiClient\AiClientAuthException;

use App\Exceptions\AiClient\AiClientResponseException;
use App\Interfaces\Ai\IAiClient;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use InvalidArgumentException;
use RuntimeException;

class AiClient implements IAiClient
{
    private string $baseUrl;

    private string $clientSecret;

    private string $authUrl;

    private string $defaultPrompt;

    private ?string $accessToken = null;

    public function __construct(string $baseUrl, string $clientSecret, string $authUrl, string $defaultPrompt)
    {
        $this->baseUrl = $baseUrl;
        $this->clientSecret = $clientSecret;
        $this->authUrl = $authUrl;
        $this->defaultPrompt = $defaultPrompt;
    }

    public function sendRewriteRequest(string $text, ?string $instructions = null): string
    {
        if (!$this->accessToken) {
            $this->auth();
        }

        $instructions = $instructions ?? $this->defaultPrompt;
        $textData = $text;
        $payload = [
            'model' => 'GigaChat',
            'messages' => [
                ['role' => 'system', 'content' => $instructions],
                ['role' => 'user', 'content' => $textData],
            ],
            'temperature' => 0.7,
            'max_tokens' => 256,
        ];

        $response = Http::withOptions(['verify' => false])->withToken($this->accessToken)->post("{$this->baseUrl}/chat/completions", $payload);
        if ($response->failed()) {
            throw new AiClientResponseException();
        }

        return $response->json('choices.0.message.content');
    }

    private function auth(): void
    {
        $responce = Http::asForm()->withOptions(['verify' => false])->withHeaders([
            'Accept' => 'application/json',
            'RqUID' => Str::uuid()->toString(),
            'Authorization' => 'Basic ' . $this->clientSecret,
        ])->post($this->authUrl, ['scope' => 'GIGACHAT_API_PERS']);

        if ($responce->failed()) {
            throw new AiClientAuthException();
        }

        $this->accessToken = $responce->json('access_token');
    }
}
