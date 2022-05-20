<?php

namespace Tests;

use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    /**
     * Create a dummy todo list data
     * 
     * @return App\Models\TodoList
     */
    public function createTodoList($args = [])
    {
        return TodoList::factory()->create($args);
    }

    /**
     * Create a dummy task data
     * 
     * @return App\Models\Task
     */
    public function createTask($args = [])
    {
        return Task::factory()->create($args);
    }
}