<?php

namespace App\Http\API\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\Interfaces\UserRepository;
use App\Validators\UserValidator;
use Dingo\Api\Exception\DeleteResourceFailedException;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class UsersController extends Controller
{

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var UserValidator
     */
    protected $validator;

    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }


    /**
     * get a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->repository->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     * @throws ValidatorException
     */
    public function store(UserCreateRequest $request)
    {
        $data = $request->all();

        $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

        // encrypt password
        $data['password'] = bcrypt($data['password']);

        $user = $this->repository->create($data);
        // throw exception if store failed
//        throw new StoreResourceFailedException('Failed to store.');

        // A. return 201 created
//        return $this->response->created(null);

        // B. return data
        return $user;
    }


    /**
     * Get the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->repository->find($id);
    }


    /**
     * Get the authenticated user resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function me()
    {
        return $this->show(\Auth::id());
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest $request
     * @param  string $id
     *
     * @return \Dingo\Api\Http\Response
     * @throws ValidatorException
     */
    public function update(UserUpdateRequest $request, $id)
    {

        $this->validator->with($request->all())->setId($id)->passesOrFail(ValidatorInterface::RULE_UPDATE);

        $this->repository->update($request->all(), $id);

        // throw exception if update failed
//        throw new UpdateResourceFailedException('Failed to update.');

        // Updated, return 204 No Content
        return $this->response->noContent();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if ($deleted) {
            // Deleted, return 204 No Content
            return $this->response->noContent();
        } else {
            // Failed, throw exception
            throw new DeleteResourceFailedException();
        }
    }
}
