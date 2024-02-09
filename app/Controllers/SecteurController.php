<?php

namespace App\Controllers;


use App\Models\Secteur;


class SecteurController extends CoreController
{
    /**
     * Méthode s'occupant de la page add secteur
     *
     * @return void
     */
    public function add()
    {
        $secteur = new Secteur();

        $this->show('secteur/add',['secteur' => $secteur]);
    }

    /**
     * Méthode pour create etat
     *
     * @return void
     */
    public function addpost()
    {
        $name = filter_input(INPUT_POST, 'name');
        

        if(is_null($name)) {
            dd("Erreur !");
        }
        
        $secteur = new Secteur();

        $secteur->setName($name);
        
        
        $secteur->insert();
        header('Location: ' . $this->router->generate('infos-list'));;
        
    }

    /**
     * Méthode s'occupant de la page update secteur
     *
     * @return void
     */
    public function update($id)
    {
        
        $secteur = Secteur::find($id);

        $data =  [
            'secteur' => $secteur,
            
        ];

        $this->show('secteur/update', $data);
    }

    /**
     * Méthode pour update Secteur
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
        
        $secteur = Secteur::find($id);


        // on met à jour les propriétés de l'objet (avec ce qui a été saisi dans le form)

        $secteur->setName($name);
        $secteur->update();

        header('Location: ' . $this->router->generate('infos-list'));
        exit;

    }


     /**
     * Méthode pour delete secteur
     *
     * @return void
     */
    public function delete($id)
    { 
        
        
        
        $secteur = Secteur::find($id);

        
        $secteur->delete();
        
        header('Location: ' . $this->router->generate('infos-list'));
        
    }   
}