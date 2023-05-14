<?php

namespace Tests\Feature;

use App\Models\Department;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class DepartmentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_department_list()
    {
        $response = $this->get('/api/departments');

        $response->assertStatus(200);
    }

    public function test_department_show()
    {
        $department = Department::first();
        $response = $this->get("/api/departments/{$department->id}");

        $response->assertStatus(200);
    }


    public function test_create_department()
    {
        $response = $this->post('/api/departments', [
            'department_name' => 'department test',
            'description' => 'it it it'
        ]);

        $response->assertStatus(201);

    }

    public function test_edit_department()
    {
        $department = Department::first();
        $response = $this->patch("/api/departments/{$department->id}", [
            'department_name' => 'It',
            'description' => 'it it it'
        ]);

        $response->assertStatus(200);
    }

    public function test_delete_department()
    {
        $department = Department::where('department_name', 'department test')->first();
        $response = $this->delete("/api/departments/{$department->id}");

        $response->assertStatus(200);
    }


}
