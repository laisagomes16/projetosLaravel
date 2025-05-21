<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;

class ProjectTest extends TestCase
{
    //use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_create_project_valid()
    {
        $user = User::create([
            'name' => 'Usuário Teste',
            'email' => 'teste'.Str::random(2) .'@gmail.com',
            'password' => bcrypt('senha123'),
        ]);

        $response = $this->postJson('/api/v1/login', [
            'email' => $user->email,
            'password' => 'senha123',
        ]);

        $token = $response['access_token'];

        $data = [
            'nome' => 'Projeto Teste'. Str::random(2),
            'descricao' => 'Descrição'. Str::random(2),
        ];

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
            'Accept' => "application/json"
        ])->postJson('/api/v1/projects', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['nome' => $data['nome']]);
    }

    public function test_list_projects()
    {

        $user = User::create([
            'name' => 'Usuário Teste',
            'email' => 'teste' . Str::random(2) . '@gmail.com',
            'password' => bcrypt('senha123'),
        ]);

        $loginResponse = $this->postJson('/api/v1/login', [
            'email' => $user->email,
            'password' => 'senha123',
        ]);

        $token = $loginResponse['access_token'];

        Project::create(['nome' => 'Projeto 1', 'descricao' => 'Descricao 1']);
        Project::create(['nome' => 'Projeto 2', 'descricao' => 'Descricao 2']);
        Project::create(['nome' => 'Projeto 3', 'descricao' => 'Descricao 3']);

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
            'Accept' => 'application/json',
        ])->getJson('/api/v1/projects');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }
}
