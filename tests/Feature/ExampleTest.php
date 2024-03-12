<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanRegister()
    {
        $userData = [
            'name' => 'sachou',
            'email' => 'sachou@example.com',
            'password' => 'mdp', 
            'password_confirmation' => 'mdp'
        ];

        $response = $this->postJson('/api/register', $userData);

        $response
    ->assertStatus(200) 
    ->assertJson([
        'status_code' => 200,
        'status_message' => 'L\'utilisateur a bien été créé',
        'user' => [
            'name' => 'sachou',
            'email' => 'sachou@example.com',
        ]
    ]);

        $this->assertDatabaseHas('users', [
            'email' => 'sachou@example.com',
        ]);
    }
}