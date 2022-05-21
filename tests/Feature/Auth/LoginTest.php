<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * User can login with email and password.
     *
     * @return void
     */
    public function test_a_user_can_login_with_email_and_password()
    {
        $user = User::factory()->create();

        $response = $this->postJson(route('login'), [
            'email' => $user,
            'password' => 'password',
        ])->assertOk();

        $this->assertArrayHasKey('access_token', $response->json());
    }

    /**
     * Throw an error if the given credentials was invalid.
     *
     * @return void
     */
    public function test_throw_an_error_if_the_given_credentials_was_invalid()
    {
        $this->postJson(route('login'), [
            'email' => 'random@gmail.com',
            'password' => 'password',
        ])->assertUnauthorized();
    }
}