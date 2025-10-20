<?php

namespace Tests\Feature;

use Tests\TestCase;

class GigaChatControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_it_rewrites_text(): void
    {
        $text = 'Ехал человек на машине по снегу, свернул на узкую дорогу и застрял.';

        $response = $this->post('/api/rewrite/', ['text' => $text]);

        $response->assertStatus(200);
    }
}
