<?php

namespace Rewrite;

use Tests\TestCase;

class AiControllerTest extends TestCase
{
    public function test_it_rewrites_text(): void
    {
        $originalText = 'Ехал человек на машине по снегу, свернул на узкую дорогу и застрял.';

        $response = $this->postJson('/api/rewrite', [
            'text' => $originalText,
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'text',
            ],
        ]);
        $rewrittenText = $response->json('data.text');
        $this->assertIsString($rewrittenText);
        $this->assertNotEmpty($rewrittenText);
        $this->assertNotSame($originalText, $rewrittenText, 'Text should be rewritten');
    }
}
