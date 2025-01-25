<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */

    protected function authenticateUser()
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        return ['Authorization' => 'Bearer ' . $token];
    }

    // public function test_create_task()
    // {
    //     $headers = $this->authenticateUser();

    //     $response = $this->postJson('/api/tasks', [
    //         'title' => 'Test Task',
    //         'description' => 'This is a test task',
    //     ], $headers);

    //     $response->assertStatus(201)
    //          ->assertJsonStructure([
    //              'status', 
    //              'data' => [ 
    //                  'data' => [
    //                     'id',
    //                     'title',
    //                     'description',
    //                     'created_at',
    //                     'updated_at',
    //                  ],
    //              ],
    //          ]);
    // }

    // public function test_retrieve_tasks()
    // {
    //     $headers = $this->authenticateUser();

    //     Task::factory()->count(3)->create();

    //     $response = $this->getJson('/api/tasks', $headers);

    //     $response->assertStatus(200)
    //              ->assertJsonCount(3);
    // }

    public function test_mark_task_as_completed()
    {
        $headers = $this->authenticateUser();

        $task = Task::factory()->create();

        $response = $this->putJson("/api/tasks/{$task->id}", $headers);

        $response->assertStatus(200)
             ->assertJson([
                 'status' => 'success',
                 'data' => [
                     'data' => [
                         'id' => $task->id,
                         'status' => 'completed',
                     ],
                 ],
             ]);
    }

    public function test_delete_task()
    {
        $headers = $this->authenticateUser();

        $task = Task::factory()->create();

        $response = $this->deleteJson("/api/tasks/{$task->id}", $headers);

        $response->assertStatus(200)
                 ->assertJson([
                     'data' => [
                         "message" => "Task deleted successfully",
                     ],
                ]);
    }
}
