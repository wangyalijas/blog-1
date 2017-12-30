<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class UserValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required|between:3,20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required|between:3,20',
            'email' => 'required|email|unique:users,email',
        ],
    ];
}
