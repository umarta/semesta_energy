<?php

namespace Tests\Feature;

use App\Models\Position;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PositionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_position_list()
    {
        $response = $this->get('/api/positions');

        $response->assertStatus(200);
    }

    public function test_position_show()
    {
        $position = Position::first();
        $response = $this->get("/api/positions/{$position->id}");

        $response->assertStatus(200);
    }


    public function test_create_position()
    {
        $response = $this->post('/api/positions', [
            'job_position_name' => 'Position test',
            'description' => 'it it it'
        ]);

        $response->assertStatus(201);

    }

    public function test_edit_position()
    {
        $position = Position::first();
        $response = $this->patch("/api/positions/{$position->id}", [
            'job_position_name' => 'It',
            'description' => 'it it it'
        ]);

        $response->assertStatus(200);
    }

    public function test_delete_position()
    {
        $position = Position::where('job_position_name', 'Position test')->first();
        $response = $this->delete("/api/positions/{$position->id}");

        $response->assertStatus(200);
    }
}
