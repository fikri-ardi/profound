<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use App\Models\TodoList;
use App\Enums\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskStatusTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Assert that task status can be changed.
     *
     * @return void
     */
    public function test_a_task_status_can_be_changed()
    {
        $todo_list = TodoList::factory()->hasTasks()->create();

        $this->patchJson(route('tasks.update', $todo_list->tasks[0]->id), ['status' => TaskStatus::STARTED])
            ->assertOk();

        $this->assertDatabaseHas('tasks', ['todo_list_id' => $todo_list->id, 'status' => TaskStatus::STARTED]);
    }
}