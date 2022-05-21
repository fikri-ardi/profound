<?php

namespace Tests;

use App\Models\Task;
use App\Models\User;
use App\Models\TodoList;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;

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

    /**
     * Create a dummy user data
     * 
     * @return App\Models\User
     */
    public function createUser($args = [])
    {
        return User::factory()->create($args);
    }

    /**
     * Auth the user
     * 
     * @return App\Models\User
     */
    public function authUser($args = [])
    {
        $user = $this->createUser();
        Sanctum::actingAs($user);
        return $user;
    }
}