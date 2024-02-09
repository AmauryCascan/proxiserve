<?php 

namespace App\Controllers;

use App\Models\AppUser;


class SecurityController extends CoreController 
{
    /**
     * Méthode gérant l'affichage de la page login
     *
     * @return void
     */
    public function login()
    {
       
        $this->show('security/login');
    }

    public function logout()
    {

        // on peut utiliser session_destroy mais on vire tout ça peut poser problème
        // a la place on peut supprimer les donées userId et userObject
        unset($_SESSION['userId']);
        unset($_SESSION['userObject']);

        // une fois deconecter, on le redirige
        header('Location: ' . $this->router->generate('security-login'));
        exit;
    }

    public function loginPost()
    {   
        $errorList = [];

        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        if(is_null($email) || is_null($password)) {
            $errorList[] = "Formulaire erroné.";
        }
        $user = AppUser::findByEmail($email);

        if($user === false){
            $errorList[] = "Veuillez indiquer une adresse email ou un mot de passe valide";
        
        } else {
            //si le mdp transformé en HASH correspond à la BDD c'est ok
             if(password_verify($password, $user->getPassword())){
                $_SESSION['userId'] = $user->getId();
                $_SESSION['userObject'] = $user; 
                
                header('Location: ' . $this->router->generate('main-home'));
                exit;
            } else {
                
                $errorList[] = "Veuillez indiquer une adresse email ou un mot de passe valide";
            }
        }
        
        $this->show('security/login', ['errorList' => $errorList]);
    }
}