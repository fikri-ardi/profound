<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Assert that user can register.
     *
     * @return void
     */
    public function test_user_can_register()
    {
        $response = $this->postJson(route('register'), [
            'name' => 'fikri',
            'email' => 'fikri@gmail.com',
            'password' => 'password',
        ])->assertCreated();

        $this->assertDatabaseHas('users', ['email' => $response['email']]);
    }
}