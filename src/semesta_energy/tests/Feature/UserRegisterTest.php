<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_register_correctly_way()
    {
        $response = $this->post('/api/auth/register', [
            'name' => 'Rahmad',
            'email' => 'rahmad@umarta.com',
            'username' => 'rahmadcom',
            'password' => 'sasd',
            're_password' => 'sasd',
        ]);
        User::where('email', 'rahmad@umarta.com')->delete();
        $response->assertStatus(200);
    }

    public function test_register_with_username_existing_account()
    {
        $response = $this->post('/api/auth/register', [
            'name' => 'Rahmad',
            'email' => 'rahmad@umartaa.com',
            'username' => 'umbara',
            'password' => 'sasd',
            're_password' => 'sasd',
        ]);

        $response->assertStatus(302);
    }

    public function test_register_with_email_existing_account()
    {
        $response = $this->post('/api/auth/register', [
            'name' => 'Rahmad',
            'email' => 'umbara@gmail.com',
            'username' => 'rahmadcom',
            'password' => 'sasd',
            're_password' => 'sasd',
        ]);

        $response->assertStatus(302);
    }


    public function test_register_with_blank_form()
    {
        $response = $this->post('/api/auth/register');

        $response->assertStatus(302);
    }

    public function test_register_with_name_invalid_format()
    {
        $response = $this->post('/api/auth/register', [
            'name' => 'Rahmad!',
            'email' => 'rahmad@umarta.com',
            'username' => 'rahmadcom',
            'password' => 'sasd',
            're_password' => 'sasd',
        ]);

        $response->assertStatus(302);
    }

    public function test_register_with_email_invalid_format()
    {
        $response = $this->post('/api/auth/register', [
            'name' => 'Rahmad',
            'email' => 'rahmadumarta.com',
            'username' => 'rahmadcom',
            'password' => 'sasd',
            're_password' => 'sasd',
        ]);

        $response->assertStatus(302);
    }

    public function test_register_with_password_invalid_format()
    {
        $response = $this->post('/api/auth/register', [
            'name' => 'Rahmad',
            'email' => 'rahmadumarta.com',
            'username' => 'rahmadcom',
            'password' => 'sasd!',
            're_password' => 'sasd!',
        ]);

        $response->assertStatus(302);
    }

    public function test_register_with_password_not_match()
    {
        $response = $this->post('/api/auth/register', [
            'name' => 'Rahmad',
            'email' => 'rahmadumarta.com',
            'username' => 'rahmadcom',
            'password' => 'sasd2',
            're_password' => 'sasd',
        ]);

        $response->assertStatus(302);
    }



}
