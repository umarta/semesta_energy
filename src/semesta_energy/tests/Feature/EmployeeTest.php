<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_create_employee()
    {
        $job = Position::first();
        $response = $this->post('/api/employees', [
            'name' => 'employee test',
            'id_card' => '12312312',
            'gender' => 'male',
            'religion' => 'islam',
            'photo' => 'https://google.com',
            'address' => 'padang',
            'handphone' => '0912123121',
            'job_position_id' => $job->id,
        ]);

        $response->assertStatus(201);

    }
    public function test_employee_list()
    {
        $response = $this->get('/api/employees');

        $response->assertStatus(200);
    }

    public function test_employee_show()
    {
        $employee = Employee::first();
        $response = $this->get("/api/employees/{$employee->id}");

        $response->assertStatus(200);
    }




    public function test_edit_employee()
    {
        $employee = Employee::first();
        $job = Position::first();
        $user = User::where('username', 'umbara')->first();
        $token = $user->createToken('se')->accessToken;
        $response = $this->patch("/api/employees/{$employee->id}", [
            'name' => 'employee test',
            'id_card' => '12312312',
            'gender' => 'male',
            'religion' => 'islam',
            'photo' => 'https://google.com',
            'address' => 'padang',
            'handphone' => '0912123121',
            'job_position_id' => $job->id,
        ],
            ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $token]
        );

        $response->assertStatus(200);
    }

    public function test_edit_employee_with_admin_role()
    {
        $employee = Employee::first();
        $job = Position::first();
        $user = User::where('username', 'admin')->first();
        $token = $user->createToken('se')->accessToken;
        $response = $this->patch("/api/employees/{$employee->id}", [
            'name' => 'employee test',
            'id_card' => '12312312',
            'gender' => 'male',
            'religion' => 'islam',
            'photo' => 'https://google.com',
            'address' => 'padang',
            'handphone' => '0912123121',
            'job_position_id' => $job->id,
        ],
            ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $token]
        );

        $response->assertStatus(403);
    }


    public function test_delete_employee()
    {
        $employee = Employee::where('name', 'employee test')->first();
        $response = $this->delete("/api/employees/{$employee->id}");

        $response->assertStatus(200);
    }
}
