<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'Users'; // Nom de la table
    protected $primaryKey = 'UserID'; // Nom de la clé primaire
    protected $allowedFields = ['UserName', 'Email', 'Password']; // Champs autorisés pour insert et update
    protected $returnType = 'array';

    /**
     * Fonction de connexion d'utilisateur
     */
    public function login(string $email, string $password)
    {
        // Rechercher l'utilisateur par email
        $user = $this->where('Email', $email)->first();

        // Vérifier si l'utilisateur existe et si le mot de passe correspond
        if ($user && password_verify($password, $user['Password'])) {
            return $user;
        }

        return null; // Retourner null si l'authentification échoue
    }

    /**
     * Fonction d'inscription d'utilisateur
     */
    public function register(array $data)
    {
        // Vérifier si l'email est déjà utilisé
        $existingUser = $this->where('Email', $data['Email'])->first();
        if ($existingUser) {
            return [
                'status' => false,
                'message' => 'Cet email est déjà enregistré.'
            ];
        }

        // Hacher le mot de passe avant de l'insérer
        $data['Password'] = password_hash($data['Password'], PASSWORD_BCRYPT);

        // Insérer les données de l'utilisateur
        $insertID = $this->insert([
            'UserName' => $data['UserName'],
            'Email' => $data['Email'],
            'Password' => $data['Password']
        ]);

        if ($insertID) {
            return [
                'status' => true,
                'message' => 'Utilisateur enregistré avec succès.',
                'UserID' => $insertID
            ];
        }

        return [
            'status' => false,
            'message' => 'Échec de l\'enregistrement. Veuillez réessayer.'
        ];
    }
}