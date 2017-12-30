<?php

namespace Tests\API;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * Test get the authenticated user
     *
     * @return void
     * @throws \Exception
     */
    public function testAuthUser()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        $response = $this->auth($user)->get('/api/user');

        $response
            ->assertStatus(200)
            ->assertExactJson($user->toArray());
    }
}
