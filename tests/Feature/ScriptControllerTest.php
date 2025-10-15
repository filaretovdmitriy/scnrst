<?php

namespace Tests\Feature;

use App\Models\Script;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScriptControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_script_list(): void
    {
        Script::factory()->count(10)->create();
        $response = $this->getJson('/api/scripts');

        $response->assertOk()->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'description',
                    'duration',
                    'status',
                    'created_at',
                    'updated_at',
                ],
            ]]);

        $this->assertCount(10, $response->json('data'));
        $this->assertDatabaseCount('scripts', 10);
    }

    public function test_it_creates_new_script(): void
    {
        $data = [
            'name' => 'Test name',
            'description' => 'Test description text',
            'duration' => 1,
            'status' => 1,
        ];

        $response = $this->postJson('/api/scripts', $data);
        $response->assertCreated();

        $this->assertDatabaseHas('scripts', $data);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'description',
                'duration',
                'status',
                'created_at',
                'updated_at',
            ],
        ]);
    }

    public function test_it_updates_script(): void
    {
        $script = Script::factory()->create([
            'name' => 'Old script name',
            'description' => 'Old script description',
            'duration' => 2,
            'status' => 0,
        ]);

        $updateData = [
            'name' => 'Updated script name',
            'description' => 'Updated script description',
            'duration' => 1,
            'status' => 1,
        ];

        $response = $this->putJson("/api/scripts/{$script->id}", $updateData);

        $response->assertOk();

        $this->assertDatabaseHas('scripts', $updateData);
    }

    public function test_it_deletes_script(): void
    {
        $script = Script::factory()->create();

        $response = $this->deleteJson("/api/scripts/{$script->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('scripts', ['id' => $script->id]);
    }


}
