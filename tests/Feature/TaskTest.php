<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Task;

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
        $task = Task::first();
        $response = $this->json('DELETE', '/api/tasks/'.$task->id); 

        $response
            ->assertStatus(200)
            ->assertSee('deleted');
    }

    public function testTickList()
    {
        $response = $this->json('GET', '/api/list/tick');

        $response
            ->assertStatus(200)
            ->assertSee('tick');
    }
}
