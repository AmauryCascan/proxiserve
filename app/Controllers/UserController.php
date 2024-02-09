<?php 

namespace App\Controllers;

use App\Models\AppUser;

class UserController extends CoreController
{   
    /**
     * Affiche les liste des utilisateurs si admin
     *
     * 
     */
    public function list()
    {
        
        $users = AppUser::findAll();


        $this->show('user/list', ['users' => $users]);
    }

    /**
     * Méthode s'occupant de la page add user
     *
     * @return void
     */
    public function add()
    {
        
        $users = AppUser::findAll();


        $this->show('user/add', ['users' => $users]);
    }

    /**
     * methode ajout new user
     *
     * @return void
     */
    public function addPost()
    {
        
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $firstname = filter_input(INPUT_POST, 'firstname');
        $lastname = filter_input(INPUT_POST, 'lastname');
        $role = filter_input(INPUT_POST, 'role');
        $status = filter_input(INPUT_POST, 'status');
        
        
        if(is_null($email) || is_null($password) || is_null($firstname) || is_null($lastname) || is_null($role) || is_null($status))
         {
            dd("Erreur !");
        }
        
    
        $user = new AppUSer();

        $user->setEmail($email);
        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setRole($role);
        $user->setStatus($status);

        $user->insert();
        
        

        header('Location: ' . $this->router->generate('user-list'));
        exit;
    }

    /**
     * Méthode s'occupant de la page update user
     *
     * @return void
     */
    public function update($id)
    {
        
        $user = AppUser::find($id);

        $data =  [
            'user' => $user,
            
        ];

        $this->show('user/update', $data);
    }

    /**
     * Méthode pour update user
     *
     * @return void
     */
    public function updatePost($id)
    { 
        
        
        $email = filter_input(INPUT_POST, 'email');
        $firstname = filter_input(INPUT_POST, 'firstname');
        $lastname = filter_input(INPUT_POST, 'lastname');
        $role = filter_input(INPUT_POST, 'role');
        $status = filter_input(INPUT_POST, 'status');
        
        
        if(is_null($email) || is_null($firstname) || is_null($lastname) || is_null($role) || is_null($status))
         {
            dd("Erreur !");
        }
        
        $user = AppUser::find($id);


        // on met à jour les propriétés de l'objet (avec ce qui a été saisi dans le form)

        $user->setEmail($email);
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setRole($role);
        $user->setStatus($status);

        $user->update();

        header('Location: ' . $this->router->generate('user-list'));
        exit;

    }

    /**
     * supprime un user
     *
     * @param [type] $id
     * @return void
     */
    public function delete($id)
    { 
                          
        $brand = AppUser::find($id);

        
        $brand->delete();
        
        // $_SERVER["HTTP_REFERER"] redirige vers la page d'ou est lancée la requete
        header('Location: ' . $_SERVER["HTTP_REFERER"]);
        exit;
    }

    /**
     * Méthode s'occupant de la page add user
     *
     * @return void
     */
    public function updateMdp($id)
    {
        
        $user = AppUser::find($id);

        $data =  [
            'user' => $user,
            
        ];

        $this->show('user/mdp', $data);
    }

    /**
     * Méthode pour update user
     *
     * @return void
     */

    public function updateMdpPost($id)
    { 
        
        $password = filter_input(INPUT_POST, 'password');
        
       
        
        if(is_null($password))
         {
            dd("Erreur !");
        }
        
        $user = AppUser::find($id);


        // on met à jour les propriétés de l'objet (avec ce qui a été saisi dans le form)

       
        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
        
        $user->updateMdp();
        
        header('Location: ' . $this->router->generate('user-update', ['id' => $user->getId()]));
        exit;

    }
}