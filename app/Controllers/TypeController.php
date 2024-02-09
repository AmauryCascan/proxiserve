<?php

namespace App\Controllers;


use App\Models\Type;


class TypeController extends CoreController
{
    /**
     * Méthode s'occupant de la page add type
     *
     * @return void
     */
    public function add()
    {

        $type = new Type();
        
        $this->show('type/add',['type' =>$type]);
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
        
        $type = new Type();

        $type->setName($name);
        
        
        $type->insert();
        header('Location: ' . $this->router->generate('infos-list'));;
        
    }

    /**
     * Méthode s'occupant de la page update type
     *
     * @return void
     */
    public function update($id)
    {
        
        $type = Type::find($id);

        $data =  [
            'type' => $type,
            
        ];

        $this->show('type/update', $data);
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
        
        $type = Type::find($id);


        // on met à jour les propriétés de l'objet (avec ce qui a été saisi dans le form)

        $type->setName($name);
        $type->update();

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
        
        
        
        $type = Type::find($id);

        
        $type->delete();
        
        header('Location: ' . $this->router->generate('infos-list'));
        
    }   
}