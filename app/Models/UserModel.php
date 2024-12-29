<?php
namespace App\Models;
// use CodeIgniter\Model;
use CodeIgniter\Model;
use App\Models\AccountModel;

class UserModel extends Model{

 protected $table ='Users' ;
 protected $primarykey ='UserID';
 protected $allowedfields = ['UserName','Email','Password' ];
 protected $returnType = 'array';

public function login(String $Email, String $Password ){

    $user =$this->where('logemail',$Email)->first();

    if ($user && password_verify($Password, $user['logpass']))

         return $user;
}
 /*fonction register*/
public function register(array $data){
   
   
   
    $existingUser = $this->where('Email', $data['Email'])->first();

    if ($existingUser) {
        return [
            'status' => false,
            'message' => 'Cet email est déjà enregistré.'
        ];
    }

    if ($insertID) {
        // Vérifier si l'utilisateur a déjà un compte dans la table Account
        if ($this->accountModel->userHasAccount($insertID)) {
            return [
                'status' => false,
                'message' => 'Cet utilisateur possède déjà un compte.'
            ];
        }

    $data['Password'] = password_hash($data['Passowrd'],PASSWORD_BCRYPT);

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





}