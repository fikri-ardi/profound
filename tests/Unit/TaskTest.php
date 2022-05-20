<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Assert that a task should belongs to one todo list.
     *
     * @return void
     */
    public function test_task_should_belongs_to_one_todo_list()
    {
        $task = Task::factory()->create();

        $this->assertInstanceOf(TodoList::class, $task->todo_list);
    }
}