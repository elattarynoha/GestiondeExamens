<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Accounts extends Entity
{
    protected $attributes = [
        'AccountID' => null,
        'UserID' => null,
        'RoleID' => null,
        'AcademicEmail' => null,
        'Password' => null,
    ];

    /**
     * Hache le mot de passe avant de le stocker.
     * 
     * @param string $password
     * @return void
     */
    public function setPassword(string $password)
    {
        $this->attributes['Password'] = password_hash($password, PASSWORD_DEFAULT);
    }
}
