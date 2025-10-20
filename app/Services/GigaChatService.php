<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use RuntimeException;

class GigaChatService
{
    protected string $baseUrl;

    protected string $clientId;

    protected string $clientSecret;

    protected string $authUrl;

    protected ?string $accessToken = null;

    public function __construct()
    {
        $this->baseUrl = config('services.gigachat.base_url');
        $this->authUrl = config('services.gigachat.auth_url');
        $this->clientId = config('services.gigachat.client_id');
        $this->clientSecret = config('services.gigachat.client_secret');
    }

    public function rewriteText(string $text, string $instructions = 'Перепиши текст, сохранив общий смысл'): string
    {
        if (!$this->accessToken) {
            $this->auth();
        }

        $payload = [
            'model' => 'GigaChat',
            'messages' => [
                ['role' => 'system', 'content' => $instructions],
                ['role' => 'user', 'content' => $text],
            ],
            'temperature' => 0.7,
            'max_tokens' => 256,
        ];

        $response = Http::withOptions(['verify' => false])->withToken($this->accessToken)->post("{$this->baseUrl}/chat/completions", $payload);

        if ($response->failed()) {
            throw new RuntimeException('Api error' . $response->body());
        }

        return $response->json('choices.0.message.content');
    }

    protected function auth(): void
    {
        $response = Http::asForm()
            ->withOptions(['verify' => false])
            ->withHeaders([
                'Accept' => 'application/json',
                'RqUID' => (string)Str::uuid(),
                'Authorization' => 'Basic ' . $this->clientSecret,
            ])
            ->post('https://ngw.devices.sberbank.ru:9443/api/v2/oauth', [
                'scope' => 'GIGACHAT_API_PERS',
            ]);

        if ($response->failed()) {
            throw new RuntimeException('Auth error:' . $response->body());
        }

        $this->accessToken = $response->json('access_token');
    }
}
