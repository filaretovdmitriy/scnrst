<?php

namespace App\Services\GigaChat;

use App\DTOs\RewriteData;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use RuntimeException;

class GigaChatClient
{
    protected string $baseUrl;

    protected string $clientSecret;

    protected string $authUrl;

    protected string $default_prompt;

    protected ?string $accessToken = null;

    public function __construct()
    {
        $this->baseUrl = config('services.gigachat.base_url');
        $this->clientSecret = config('services.gigachat.client_secret');
        $this->authUrl = config('services.gigachat.auth_url');
        $this->default_prompt = config('services.gigachat.default_prompt');
    }

    public function sendRewriteRequest(RewriteData $data, ?string $instructions = null): string
    {
        if (!$this->accessToken) {
            $this->auth();
        }

        $instructions = $instructions ?? $this->default_prompt;
        $textData = $data->text;
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
            throw new RuntimeException('Api error', $response->body());
        }

        return $response->json('choices.0.message.content');
    }

    private function auth(): void
    {
        $responce = Http::asForm()->withOptions(['verify' => false])->withHeaders([
            'Accept' => 'application/json',
            'RqUID' => (string)Str::uuid(),
            'Authorization' => 'Basic ' . $this->clientSecret,
        ])->post($this->authUrl, ['scope' => 'GIGACHAT_API_PERS']);

        if ($responce->failed()) {
            throw new RuntimeException('Failed auth', $responce->body());
        }

        $this->accessToken = $responce->json('access_token');
    }
}
