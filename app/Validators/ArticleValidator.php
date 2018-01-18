<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ArticleValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'title' => 'required|max:255',
            'summary' => 'required|max:255',
            'content' => 'required|max:16777215', // maximum size of MySQL MEDIUMTEXT type
            'published_at' => 'nullable|date',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'title' => 'max:255',
            'summary' => 'max:255',
            'content' => 'max:16777215',
            'published_at' => 'date',
        ],
    ];
}
