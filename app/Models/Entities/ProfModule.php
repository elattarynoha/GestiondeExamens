<?php
namespace App\Models\Entities;

use CodeIgniter\Entity\Entity;

class ProfModule extends Entity
{
    protected $attributes = [
        'ProfesseurID' => null,
        'ModuleID' => null,
    ];
}
