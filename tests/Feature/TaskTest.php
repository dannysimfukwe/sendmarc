<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAllTasks()
    {
        $response = $this->get('/api/tasks');

        $response->assertStatus(200);
    }

    public function testCreateTask()
    {
        $response = $this->json('POST', '/api/tasks', ['name' => 'New Task', 'priority' => 0, 'dueIn' => 10]);

        $response
            ->assertStatus(200)
            ->assertSee('created');
    }

    public function testDeleteTask()
    {
        $response = $this->json('DELETE', '/api/tasks/2');

        $response
            ->assertStatus(200)
            ->assertSee('deleted');
    }
}
