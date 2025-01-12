<?php
namespace App\Models\Entities;

use CodeIgniter\Entity\Entity;

class Notes extends Entity
{
    protected $attributes = [
        'NoteID' => null,
        'EtudiantID' => null,
        'ModuleID' => null,
        'Note' => null,
    ];

    /**
     * Vérifie si la note est valide.
     * 
     * @return bool
     */
    public function isValidNote(): bool
    {
        return $this->attributes['Note'] >= 0 && $this->attributes['Note'] <= 20;
    }
}
