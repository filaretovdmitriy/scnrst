<?php

namespace Tests\Unit\Services\Ai;

use App\Exceptions\AiClient\AiClientAuthException;
use App\Exceptions\AiClient\AiClientResponseException;
use App\Services\Ai\AiClient;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class AiClientTest extends TestCase
{
    public function test_ai_client_returns_expected_result(): void
    {
        $originalText = 'Оригинальный текст';
        $rewrittenText = 'Переписанный текст';
        $promptText = 'Тестовый промпт';
        Http::fake([
            '*' => Http::response([
                'access_token' => 'demo_token',
                'choices' => [['message' => ['content' => $rewrittenText]]]
            ])
        ]);
        config()->set('services.gigachat.auth_url', 'auth.url');
        config()->set('services.gigachat.base_url', 'base.url');
        config()->set('services.gigachat.client_secret', 'fake_secret');
        config()->set('services.gigachat.default_prompt', 'default prompt');
        $client = new AiClient();

        $result = $client->sendRewriteRequest($originalText, $promptText);

        $this->assertEquals($rewrittenText, $result);
        Http::assertSentCount(2);
    }

    public function test_send_rewrite_request_throws_on_failed_response()
    {
        $originalText = 'Оригинальный текст';
        $promptText = 'Тестовый промпт';
        $fakeSecret = 'fake_secret';
        Http::fake([
            'auth.url' => Http::response(['access_token' => 'demo_token']),
            'base.url/chat/completions' => Http::response(['error' => 'Bad Request'], 400),
        ]);
        config()->set('services.gigachat.auth_url', 'auth.url');
        config()->set('services.gigachat.base_url', 'base.url');
        config()->set('services.gigachat.client_secret', $fakeSecret);
        config()->set('services.gigachat.default_prompt', $promptText);
        $client = new AiClient();

        $this->expectException(AiClientResponseException::class);

        $client->sendRewriteRequest($originalText);
    }

    public function test_auth_throws_on_failed_auth()
    {
        $originalText = 'Оригинальный текст';
        $promptText = 'Тестовый промпт';
        $fakeSecret = 'fake_secret';
        Http::fake([
            '*' => Http::response(['error' => 'unauthorized'], 401),
        ]);
        config()->set('services.gigachat.auth_url', 'auth.url');
        config()->set('services.gigachat.base_url', 'base.url');
        config()->set('services.gigachat.client_secret', $fakeSecret);
        config()->set('services.gigachat.default_prompt', $promptText);
        $client = new AiClient();

        $this->expectException(AiClientAuthException::class);

        $client->sendRewriteRequest($originalText);
    }
}
