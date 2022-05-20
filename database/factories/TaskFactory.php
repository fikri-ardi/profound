<?php

namespace Database\Factories;

use App\Models\TodoList;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // 'todo_list_id' => rand(TodoList::first('id')->id, TodoList::latest()->first('id')->id),
            'todo_list_id' => TodoList::factory()->create(),
            'name' => $this->faker->sentence(5),
        ];
    }
}