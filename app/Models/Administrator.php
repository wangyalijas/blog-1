<?php

namespace App\Models;

use App\Notifications\ResetAdministratorPassword;
use Illuminate\Notifications\Notifiable;
use App\Models\Base\BaseUserModel as Authenticatable;

class Administrator extends Authenticatable
{
    use Notifiable;

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

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetAdministratorPassword($token));
    }
}
