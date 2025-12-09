<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_user(): void
    {
        $payload = [
            'name' => 'Dmitriy',
            'email' => 'test@example.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ];

        $response = $this->postJson('/api/user/register', $payload);
        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                ],
            ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);
    }

    public function test_user_can_login_and_receive_token(): void
    {
        $userEmail = 'test12@example.com';
        $userPassword = 'secret123';

        $user = User::factory()->create([
            'email' => $userEmail,
            'password' => bcrypt($userPassword),
        ]);
        $response = $this->postJson('/api/user/login', [
            'email' => $userEmail,
            'password' => $userPassword,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'email',
                    'name',
                    'token',
                    'password',
                ],
            ]);

        $this->assertDatabaseHas('personal_access_tokens', [
            'tokenable_id' => $user->id,
        ]);
    }

    public function test_guest_cannot_logout(): void
    {
        $response = $this->postJson('/api/user/logout');

        $response->assertStatus(401);
    }
}
