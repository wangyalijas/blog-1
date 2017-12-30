<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use App\Models\Base\BaseUserModel as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Prettus\Repository\Traits\TransformableTrait;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }
}
