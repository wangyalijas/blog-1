<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * test is pass passport authentication.
     */
    public function testPassportAuth()
    {
        $password = 123456;
        /** @var User $user */
        $user = factory(User::class)->create([
            'password' => bcrypt($password)
        ]);

        $clientId = env('OAUTH_TEST_CLIENT_ID');
        $clientSecret = env('OAUTH_TEST_CLIENT_SECRET');

        $response = $this->post('oauth/token', [
            'grant_type' => 'password',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'username' => $user->getEmail(),
            'password' => $password,
        ]);

        $response->assertJsonStructure([
            'token_type', 'expires_in', 'access_token', 'refresh_token'
        ]);
    }
}
