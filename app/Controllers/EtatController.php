<?php

namespace App\Controllers;


use App\Models\Etat;


class EtatController extends CoreController
{
    /**
     * Méthode s'occupant de la page add etat
     *
     * @return void
     */
    public function add()
    {
        $etat = new Etat();

        $this->show('etat/add', ['etat' => $etat]);
    }

    /**
     * Méthode pour create etat
     *
     * @return void
     */
    public function addPost()
    {
        $name = filter_input(INPUT_POST, 'name');
        

        if(is_null($name)) {
            dd("Erreur !");
        }
        
        $etat = new Etat();

        $etat->setName($name);
        
        
        $etat->insert();
        header('Location: ' . $this->router->generate('infos-list'));;
        
    }

    /**
     * Méthode s'occupant de la page update etat
     *
     * @return void
     */
    public function update($id)
    {
        
        $etat = Etat::find($id);

        $data =  [
            'etat' => $etat,
            
        ];

        $this->show('etat/update', $data);
    }

    /**
     * Méthode pour update etat
     *
     * @return void
     */
    public function updatePost($id)
    { 
        
        
        $name = filter_input(INPUT_POST, 'name');
        
        
        if(is_null($name))
         {
            dd("Erreur !");
        }
        
        $etat = Etat::find($id);


        // on met à jour les propriétés de l'objet (avec ce qui a été saisi dans le form)

        $etat->setName($name);
        $etat->update();

        header('Location: ' . $this->router->generate('infos-list'));
        exit;

    }

     /**
     * Méthode pour delete etat
     *
     * @return void
     */
    public function delete($id)
    { 
        
        
        
        $etat = Etat::find($id);

        
        $etat->delete();
        
        header('Location: ' . $this->router->generate('infos-list'));
    exit;
    }   
}