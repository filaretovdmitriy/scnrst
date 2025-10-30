<?php

namespace Tests\Unit;

use App\Interfaces\Ai\IAiClient;
use App\Services\Ai\AiService;
use Mockery;
use Tests\TestCase;

class AiServiceTest extends TestCase
{
    public function test_ai_service_method_rewrite_text(): void
    {
        $originalText = 'Оригинальный текст';
        $rewrittenText = 'Переписанный текст';
        config()->set('services.gigachat.default_prompt', 'default prompt');

        $mockClient = Mockery::mock(IAiClient::class);
        $mockClient->shouldReceive('sendRewriteRequest')
            ->once()
            ->with($originalText, null)
            ->andReturn($rewrittenText);
        $service = new AiService($mockClient);
        $result = $service->rewriteText($originalText);

        $this->assertEquals($rewrittenText, $result);
    }
}
