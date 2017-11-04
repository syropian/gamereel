<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManagesAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_authenticate_themselves()
    {
        $user = create('GameReel\Models\User', [
            'password' => 'gamereel',
        ]);

        $this->postJson('api/auth', [
            'email' => $user->email,
            'password' => 'gamereel'
        ])->assertStatus(200)
          ->assertJsonStructure(['token']);
    }

    /** @test */
    public function the_authenticated_user_can_be_fetched()
    {
        $user = create('GameReel\Models\User');
        $this->login($user)
             ->getJson('/api/auth')
             ->assertStatus(200)
             ->assertJson($user->toArray());
    }
}
