<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_guest_can_create_a_new_user()
    {
        $newUser = [
            'gamertag' => 'Syro',
            'email' => 'hello@world.com',
            'password' => 'gamereel',
            'password_confirmation' => 'gamereel'
        ];

        $this->postJson('/api/users', $newUser)
             ->assertStatus(200);

        $this->assertDatabaseHas('users', ['email' => $newUser['email']]);
    }

    /** @test */
    public function a_user_requires_a_gamertag()
    {
        $newUser = [
            'email' => 'hello@world.com',
            'password' => 'gamereel',
            'password_confirmation' => 'gamereel'
        ];

        $response = $this->postJson('/api/users', $newUser)
                         ->assertStatus(422);

        $this->assertTrue(array_key_exists('gamertag', $response->getOriginalContent()['errors']));
    }

    /** @test */
    public function a_user_requires_a_valid_email()
    {
        $firstUser = [
            'gamertag' => 'Syro',
            'password' => 'gamereel',
            'password_confirmation' => 'gamereel'
        ];

        $secondUser = [
            'gamertag' => 'Syro',
            'email' => 'foobar',
            'password' => 'gamereel',
            'password_confirmation' => 'gamereel'
        ];

        $firstResponse = $this->postJson('/api/users', $firstUser)
                         ->assertStatus(422);
        $secondResponse = $this->postJson('/api/users', $secondUser)
                         ->assertStatus(422);

        $this->assertTrue(array_key_exists('email', $firstResponse->getOriginalContent()['errors']));

        $this->assertTrue(array_key_exists('email', $secondResponse->getOriginalContent()['errors']));
    }

    /** @test */
    public function a_user_requires_a_confirmed_password()
    {
        $firstUser = [
            'gamertag' => 'Syro',
            'email' => 'hello@world.com',
        ];

        $secondUser = [
            'gamertag' => 'Syro',
            'email' => 'hello@world.com',
            'password' => 'gamereel',
            'password_confirmation' => 'pineapple',
        ];

        $firstResponse = $this->postJson('/api/users', $firstUser)
                              ->assertStatus(422);
        $secondResponse = $this->postJson('/api/users', $secondUser)
                               ->assertStatus(422);
        $this->assertTrue(array_key_exists('password', $firstResponse->getOriginalContent()['errors']));
        dd($firstResponse->getOriginalContent());
        $this->assertTrue(array_key_exists('password', $secondResponse->getOriginalContent()['errors']));
    }
}
