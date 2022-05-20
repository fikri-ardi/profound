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
}