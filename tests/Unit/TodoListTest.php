<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Assert that a todo list can has many tasks.
     *
     * @return void
     */
    public function test_a_todo_list_can_has_many_tasks()
    {
        $todo_list = TodoList::factory()->hasTasks()->create();

        $this->assertInstanceOf(Task::class, $todo_list->tasks->first());
    }

    /**
     * Assert that related task is deleted when todo list is deleted.
     *
     * @return void
     */
    public function test_the_related_task_is_deleted_when_todo_list_is_deleted()
    {
        $todo_list = TodoList::factory()->hasTasks()->create();
        $task = $todo_list->tasks[0];

        $todo_list->delete();

        $this->assertDatabaseMissing('todo_lists', ['id' => $todo_list->id]);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}