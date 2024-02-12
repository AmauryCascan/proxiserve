<?php

namespace App\Controllers;


use App\Models\Rob;


class RobController extends CoreController
{
    /**
     * Méthode s'occupant de la page add type
     *
     * @return void
     */
    public function add()
    {

        $rob = new Rob();
        
        $this->show('rob/add',['rob' =>$rob]);
    }

    /**
     * Méthode pour create bt
     *
     * @return void
     */
    public function addPost()
    {
        $name = filter_input(INPUT_POST, 'name');
        

        if(is_null($name)) {
            dd("Erreur !");
        }
        
        $rob = new Rob();

        $rob->setName($name);
        
        
        $rob->insert();
        header('Location: ' . $this->router->generate('infos-list'));;
        
    }

    /**
     * Méthode s'occupant de la page update type
     *
     * @return void
     */
    public function update($id)
    {
        
        $rob = Rob::find($id);

        $data =  [
            'rob' => $rob,
            
        ];

        $this->show('rob/update', $data);
    }

    /**
     * Méthode pour update type
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
        
        $rob = Rob::find($id);


        // on met à jour les propriétés de l'objet (avec ce qui a été saisi dans le form)

        $rob->setName($name);
        $rob->update();

        header('Location: ' . $this->router->generate('infos-list'));
        exit;

    }


     /**
     * Méthode pour delete type
     *
     * @return void
     */
    public function delete($id)
    { 
        
        
        
        $rob = Rob::find($id);

        
        $rob->delete();
        
        header('Location: ' . $this->router->generate('infos-list'));
        
    }   
}