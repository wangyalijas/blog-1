<?php

namespace Tests\API;

use App\Models\User;
use App\Presenters\BasicPresenter;
use App\Transformers\UserTransformer;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

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

        $response = $this->auth($user)->get(api_route('auth.user'));

        $basicPresenter = new BasicPresenter();
        $basicPresenter->setTransformer(UserTransformer::class);

        $response->assertStatus(200)
            ->assertExactJson($basicPresenter->present($user));
    }


    /**
     * Test get all users
     *
     * @return void
     * @throws \Exception
     */
    public function testGetAllUsers()
    {
        $response = $this->auth()->get(api_route('users.index'));

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id', 'name', 'email', 'created_at', 'updated_at'
                ]
            ]
        ]);
        $response->assertStatus(Response::HTTP_OK);
    }


    /**
     * Test get the specified user
     *
     * @return void
     * @throws \Exception
     */
    public function testGetSpecifiedUser()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        $response = $this->auth()->get(api_route('users.show', $user->getKey()));

        $response->assertJsonStructure([
            'data' => [
                'id', 'name', 'email', 'created_at', 'updated_at'
            ]
        ]);
        $this->assertEquals($user->getName(), $response->json()['data']['name']);
        $response->assertStatus(Response::HTTP_OK);
    }


    /**
     * Test create a user
     *
     * @return void
     * @throws \Exception
     */
    public function testCreateUser()
    {
        $userData = [
            'name' => 'example',
            'email' => strtolower(Str::random(10)) . '@gmail.com', // Because the factory generated e-mail may be repeated
            'password' => 123456
        ];
        $response = $this->auth()->post(api_route('users.store'), $userData);

        $response->assertSuccessful();

        $this->assertTrue(User::whereEmail($userData['email'])->exists(), 'The user does not exist after created the user.');
    }


    /**
     * Test update the specified user
     *
     * @return void
     * @throws \Exception
     */
    public function testUpdateUser()
    {
        /** @var User $user */
        $user = factory(User::class)->create();
        $name = 'foobar';

        $response = $this->auth()->put(api_route('users.update', $user->getKey()), [
            'name' => $name,
            'email' => $user->getEmail()
        ]);

        $response->assertSuccessful();

        $user->refresh();
        $this->assertEquals($user->getName(), $name);
    }


    /**
     * Test destroy the specified user
     *
     * @return void
     * @throws \Exception
     */
    public function testDestroyUser()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        $response = $this->auth()->delete(api_route('users.destroy', $user->getKey()));

        $response->assertSuccessful();
        $this->assertFalse(User::whereKey($user->getKey())->exists());
    }
}
