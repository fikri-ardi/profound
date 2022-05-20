<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    protected $task;
    protected $todolist;

    public function setUp(): void
    {
        parent::setUp();
        $this->task = $this->createTask();
        $this->todo_list = $this->createTodoList();
    }

    /**
     * Fetch all the task resource from one todo list.
     *
     * @return void
     */
    public function test_fetch_all_tasks_of_a_todo_list()
    {
        $response = $this->getJson(route('tasks.index', $this->task->todo_list->id))
            ->assertOk()
            ->json();

        $this->assertEquals($this->task->count(), count($response));
        $this->assertEquals($this->task->name, $response[0]['name']);
    }

    /**
     * Create a task resource.
     *
     * @return void
     */
    public function test_store_a_new_task_for_a_todo_list()
    {
        $task = Task::factory()->make();

        $response = $this->postJson(route('tasks.store', $this->todo_list->id), ['name' => $task->name])
            ->assertCreated()
            ->json();

        $this->assertDatabaseHas('tasks', ['name' => $response['name']]);
    }

    /**
     * Assert that name field is required when storing.
     *
     * @return void
     */
    public function test_name_field_is_required_when_storing()
    {
        $this->withExceptionHandling();

        $this->postJson(route('tasks.store', $this->todo_list->id))
            ->assertUnprocessable()
            ->assertJsonValidationErrorFor('name');
    }

    /**
     * Update the specified task resource.
     *
     * @return void
     */
    public function test_update_the_specified_task_of_a_todo_list()
    {
        $task = Task::factory()->make();

        $response = $this->patchJson(route('tasks.update', [$this->task->todo_list->id, $this->task->id]), ['name' => $task->name])
            ->assertOk()
            ->json();

        $this->assertDatabaseHas('tasks', ['id' => $response['id'], 'name' => $task->name]);
    }

    /**
     * Assert that name field is required when updating.
     *
     * @return void
     */
    public function test_name_field_is_required_when_updating()
    {
        $this->withExceptionHandling();

        $this->postJson(route('tasks.store', $this->todo_list->id, $this->task->id))
            ->assertUnprocessable()
            ->assertJsonValidationErrorFor('name');
    }

    /**
     * Delete the specified task resource.
     *
     * @return void
     */
    public function test_delete_the_specified_task_of_a_todo_list()
    {
        $this->deleteJson(route('tasks.destroy', [$this->task->todo_list->id, $this->task->id]))
            ->assertNoContent();

        $this->assertDatabaseMissing('tasks', ['id' => $this->task->id]);
    }
}