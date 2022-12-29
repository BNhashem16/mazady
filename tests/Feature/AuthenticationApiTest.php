<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthenticationApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_for_api()
    {
        $response = $this->post('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function test_register_for_api()
    {
        $response = $this->post('/api/register', [
            'name' => 'Test User',
            'username' => 'test_2',
            'email' => 'test@test.test2',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(201);
    }

}
