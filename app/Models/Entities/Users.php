<?php
namespace App\Models\Entities;

use CodeIgniter\Entity\Entity;

class Users extends Entity
{
    protected $attributes = [
        'UserID' => null,
        'FirstName' => null,
        'LastName' => null,
        'AcademicEmail' => null,
        'RoleID' => null,
    ];

    /**
     * Retourne le nom complet de l'utilisateur.
     * 
     * @return string
     */
    public function getFullName(): string
    {
        return $this->attributes['FirstName'] . ' ' . $this->attributes['LastName'];
    }
}
