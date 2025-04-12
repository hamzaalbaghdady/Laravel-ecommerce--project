<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class RegisterTest extends TestCase
{
    /**
     * A basic test for user creation.
     */
    public function test_required_inputs(): void
    {
        $route = Route('register');
        $response = $this->postJson($route, []);
        $response->assertJsonValidationErrors(
            [
                'first_name',
                'last_name',
                'email',
                'password',
                'phone',
                'country',
            ]
        );
    }


    public function test_email_is_uniqe(): void
    {
        $user = User::factory()->create();
        $route = Route('register');
        $response = $this->postJson($route, [
            'first_name' => 'myname',
            'last_name' => 'my lastname',
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
            'phone' => '13543153451',
            'country' => 'Palestine',

        ]);
        $response->assertJsonValidationErrors(
            [
                'email',
            ]
        );
    }

    public function test_registerition(): void
    {
        $route = Route('register');
        $response = $this->postJson($route, [
            'first_name' => 'myname',
            'last_name' => 'my lastname',
            'email' => 'myemail@mail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'phone' => '13543153451',
            'country' => 'Palestine',
        ]);
        $response->assertCreated();
        $this->assertDatabaseHas(
            'users',
            [
                'first_name' => 'myname',
                'last_name' => 'my lastname',
                'email' => 'myemail@mail.com',
            ]
        );
    }
}
