<?php

namespace Tests;

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
}