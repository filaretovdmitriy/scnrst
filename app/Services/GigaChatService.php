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

    protected string $accessToken;

    public function __construct()
    {
        $this->baseUrl = config('base_url');
        $this->clientId = config('client_id');
        $this->clientSecret = config('client_secret');
    }

    public function rewriteText(string $text = 'Пример текста', string $instructions = 'Перепиши текст, сохранив общий смысл'): string
    {
        if (! $this->accessToken) {
            $this->auth();
        }

        $payload = [
            'model' => 'GigaChat',
            'messages' => [
                ['role' => 'system', 'content' => $instructions],
                ['role' => 'user', 'content' => $text],
            ],
            'temperature' => 0.7,
            'max_tokens' => 512,
        ];

        $response = Http::withToken($this->accessToken)->post("{$this->baseUrl}/chat/completions", $payload);

        if ($response->failed()) {
            throw new RuntimeException('Api error'.$response->body());
        }

        return $response->json('choices.0.message.content');
    }

    protected function auth(): void
    {
        $response = Http::asForm()->withHeaders(['RrUID' => Str::uuid()])->post('https://ngw.devices.sberbank.ru:9443/api/v2/oauth', [
            'scope' => 'GIGACHAT_API_PERS',
            'grant_type' => 'client_credentials',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ]);

        if ($response->failed()) {
            throw new RuntimeException('Auth error:'.$response->body());
        }

        $this->accessToken = $response->json('access_token');
    }
}
