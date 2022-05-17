<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;

    private $todolist;

    public function setUp(): void
    {
        parent::setUp();
        $this->todolist = TodoList::factory()->create();
    }

    /**
     * Fetch all to do list resource
     * 
     */
    public function test_fetch_all_todo_list()
    {
        // action
        $response = $this->getJson(route('todo-list.index'));

        // assertion
        $this->assertEquals($this->todolist->count(), count($response->json()));
    }

    /**
     * Fetch spesificied to do list data
     * 
     */
    public function test_fetch_single_todo_list()
    {
        $response = $this->getJson(route('todo-list.show', $this->todolist->id))
            ->assertOk()
            ->json();

        $this->assertEquals($response['name'], $this->todolist->name);
    }

    /**
     * Store a new todo list data
     * 
     */
    public function test_store_a_new_todo_list()
    {
        $todolist = TodoList::factory()->make();

        $response = $this->postJson(route('todo-list.store', ['name' => $todolist->name]))
            ->assertCreated()
            ->json();

        $this->assertDatabaseHas('todo_lists', ['name' => $response['name']]);
    }

    /**
     * Assert name field is required
     * 
     */
    public function test_name_field_is_required()
    {
        $this->withExceptionHandling();

        $this->postJson(route('todo-list.store'))
            ->assertUnprocessable()
            ->assertJsonValidationErrorFor('name');
    }
}