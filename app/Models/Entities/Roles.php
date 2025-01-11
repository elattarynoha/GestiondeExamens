<?php
namespace App\Models\Entities;

use CodeIgniter\Entity\Entity;

class Roles extends Entity
{
    protected $attributes = [
        'RoleID' => null,
        'RoleName' => null,
    ];
}
