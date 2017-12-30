<?php

namespace Tests\API\Concerns;

use App\User;
use Illuminate\Contracts\Auth\Authenticatable;

trait AuthRequest
{
    /**
     * @param Authenticatable|null $user
     * @return $this
     * @throws \Exception
     */
    protected function auth(Authenticatable $user = null)
    {
        $user = $user ?: $this->getAPITestUser();

        $this->actingAs($user, 'api');

        return $this;
    }

    /**
     * @return Authenticatable
     * @throws \Exception
     */
    private function getAPITestUser()
    {
        $user_id = env('API_TEST_AUTH_USER_ID');

        if (!$user_id) {
            throw new \Exception('Can not find the "API_TEST_AUTH_USER_ID" environment variable in .env file');
        }

        $user = User::find($user_id);
        if (is_null($user)) {
            throw new \Exception('Can not find user with "API_TEST_AUTH_USER_ID" environment variable');
        }

        if (!($user instanceof Authenticatable)) {
            throw new \Exception('User model does not implement "Illuminate\Contracts\Auth\Authenticatable" interfaces');
        }

        return $user;
    }
}
