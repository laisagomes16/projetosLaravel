<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_register_user_success()
    {
        $data = [
            'name' => 'Maria'. Str::random(2),
            'email' => 'maria' . Str::random(2) . '@gmail.com',
            'password' => '123456',
            'password_confirmation' => '123456',
        ];

        $response = $this->postJson('/api/v1/register', $data);

        $response->assertStatus(201)
            ->assertJsonStructure(['message', 'user' => ['id', 'name', 'email']]);
    }

    public function test_login_returns_token()
    {
        $name = 'Usuário Teste'. Str::random(2);
        $email = 'teste@' . Str::random(2) . 'gmail.com';

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make('senha123'),
        ]);

        $response = $this->postJson('/api/v1/login', [
            'email' => $email,
            'password' => 'senha123',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['access_token', 'token_type', 'expires_in']);
    }
}
