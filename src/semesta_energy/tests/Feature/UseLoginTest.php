<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UseLoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_with_un_exists_user()
    {
        $response = $this->post('/api/auth/login', ['username' => 'dummy', 'password' => 'dummy']);

        $response->assertStatus(401);
    }

    public function test_login_with_exists_user_wrong_password()
    {
        $response = $this->post('/api/auth/login', ['username' => 'umarta', 'password' => 'dummy']);

        $response->assertStatus(401);
    }

    public function test_login_with_exists_user_role_user_correct_password()
    {
        $response = $this->post('/api/auth/login', ['username' => 'umbara', 'password' => '12345']);
        $response->assertStatus(200);
    }
    public function test_login_with_exists_user_role_admin_correct_password()
    {
        $response = $this->post('/api/auth/login', ['username' => 'Doni', 'password' => '12345']);
        $response->assertStatus(401);
    }



}
