<?php

namespace App\Controllers;

use App\Models\Bc;
use App\Models\Etat;
use App\Models\Type;
use App\Models\AppUser;


class TlController extends CoreController
{
    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function list()
    {
        
        $bcs = Bc:: findNonFacture();
        $etats = Etat::findAll();
        $types = Type::findAll();

        $data = [
            'bcs' => $bcs,
            'etats' => $etats,
            'types' => $types,
        ];
    
        $this->show('tl/encours', $data);
    }

    public function filtreBc($bc)
    {
        
        $bcs = Bc::findByBc($bc);
        $types = Type::findAll();
        $etats = Etat::findAll();
        
        
        $this->show('tl/filtre', ['bcs' => $bcs, 'types' =>$types, 'etats' => $etats]);
    }

    public function filtreType($params)
    {
        $urldecode = urldecode($params);
        $type =  str_replace('+', ' ', $urldecode);

        $bcs = Bc::findByType($type);
        $types = Type::findAll();
        $etats = Etat::findAll();
        
        
        $this->show('tl/filtre', ['bcs' => $bcs, 'types' =>$types, 'etats' => $etats,]);
    }
    
    public function filtreEtat($params)
    {      
        $urldecode = urldecode($params);
        $etat =  str_replace('+', ' ', $urldecode);
        $bcs = Bc::findByEtat($etat);
        $types = Type::findAll();
        $etats = Etat::findAll();
        
        $this->show('tl/filtre', ['bcs' => $bcs, 'types' =>$types, 'etats' => $etats]);
    }

    public function listAnnule()
    {
        
        $bcs = Bc:: findAnnule();
        $etats = Etat::findAll();
        $types = Type::findAll();   

        $data = [
            'bcs' => $bcs,
            'etats' => $etats,
            'types' => $types,
        ];
    
        $this->show('tl/annule', $data);
    }

    public function listFacture()
    {
        
        $bcs = Bc:: findFacture();
        $etats = Etat::findAll();
        $types = Type::findAll();

        $data = [
            'bcs' => $bcs,
            'etats' => $etats,
            'types' => $types,
        ];
    
        $this->show('tl/facture', $data);
    }
    

    /**
     * Méthode s'occupant de la page see Bon travaux 
     *
     * @return void
     */
    public function see($id)
    {
        $etats = Etat::findAll();
        $bc = Bc::find($id);
        

        $data = [
            'bc' => $bc,
            'etats' => $etats,
        ];
        
    
        $this->show('tlTravaux/see', $data);
    }


    /**
     * Méthode s'occupant de la page nouveau Bon travaux
     *
     * @return void
     */
    public function add()
    {   
        $etats = Etat::findAll();
        $types = Type::findAll();
        $bc = new Bc();
        $data = [
            'etats' => $etats,
            'types' => $types,
            'bc' => $bc,
        ];
        
        $this->show('tlTravaux/add', $data);
    }

    /**
     * Méthode s'occupant de la page update Bon travaux 
     *
     * @return void
     */
    public function update($id)
    {
        
        $bc = Bc::find($id);
        $etats = Etat::findAll();
        $types = Type::findAll();

        $data = [
            'etats' => $etats,
            'types' => $types,
            'bc' => $bc,
        ];
        
    
        $this->show('tlTravaux/update', $data);
    }

    /**
     * Méthode pour create bt
     *
     * @return void
     */
    public function addPost()
    {

        $name = $_FILES['document']['tmp_name'];
        $fileName = $_FILES['document']['name'];
        $uploadDir = "/var/www/html/proxiserve/public/doc/";
        $destination = $uploadDir . $fileName;
        

        move_uploaded_file($name, $destination);

        $years = filter_input(INPUT_POST, 'years');
        $boncommande = filter_input(INPUT_POST, 'bc');
        $date = filter_input(INPUT_POST, 'date');
        $type = filter_input(INPUT_POST, 'type');
        $price = filter_input(INPUT_POST, 'price');
        $etat = filter_input(INPUT_POST, 'etat');
        $rdv = filter_input(INPUT_POST, 'rdv');
        $document = $fileName;
        $commande = filter_input(INPUT_POST, 'commande');

        if(is_null($years) || is_null($boncommande) || is_null($date) || is_null($type) || is_null($price) || is_null($etat)
        || is_null($rdv) || is_null($document) || is_null($commande)) {
            header('HTTP/1.0 400 Bad');
            $this->show('error/err400');
            exit;
        }
        
        
        
        $bc = new Bc();

        $bc->setYears($years);
        $bc->setbc($boncommande);
        ($date !== "") ? $bc->setDate($date) : NULL;
        $bc->setType($type);
        ($price !== "") ? $bc->setPrice($price) : NULL;
        $bc->setEtat($etat);
        ($rdv !== "") ? $bc->setRdv($rdv) : NULL;
        ($document !== "") ? $bc->setDocument($document) : NULL;
        ($commande !== "") ? $bc->setCommande($commande) : NULL;
        $bc->insert();
        header('Location: ' . $this->router->generate('tl-list'));
        exit;
    }

    public function updatePost($id)
    {

        $name = $_FILES['document']['tmp_name'];
        $fileName = $_FILES['document']['name'];
        $uploadDir = "/var/www/html/proxiserve/public/doc/";
        $destination = $uploadDir . $fileName;
        move_uploaded_file($name, $destination);


        $years = filter_input(INPUT_POST, 'years');
        $boncommande = filter_input(INPUT_POST, 'bc');
        $date = filter_input(INPUT_POST, 'date');
        $type = filter_input(INPUT_POST, 'type');
        $price = filter_input(INPUT_POST, 'price');
        $etat = filter_input(INPUT_POST, 'etat');
        $rdv = filter_input(INPUT_POST, 'rdv');
        $document = $fileName;
        $commande = filter_input(INPUT_POST, 'commande');

        if(is_null($years) || is_null($boncommande) || is_null($date) || is_null($type) || is_null($price) || is_null($etat)
        || is_null($rdv) || is_null($document) || is_null($commande)) {
            header('HTTP/1.0 400 Bad');
            $this->show('error/err400');
            exit;
        }
        
        $bc = Bc::find($id);
        
        $bc->setYears($years);
        $bc->setbc($boncommande);
        ($date !== "") ? $bc->setDate($date) : NULL;
        $bc->setType($type);
        ($price !== "") ? $bc->setPrice($price) : NULL;
        $bc->setEtat($etat);
        ($rdv !== "") ? $bc->setRdv($rdv) : NULL;
        if(!empty($fileName)){
            ($document !== "") ? $bc->setDocument($document) : NULL;
        }
        ($commande !== "") ? $bc->setCommande($commande) : NULL;

        
        $bc->update();
        header('Location: ' . $this->router->generate('tl-see', ['id' => $bc->getId()]));
        exit;
    }

    public function seePost($id) {
        

        $etat = filter_input(INPUT_POST, 'etat');
        $commentaire = filter_input(INPUT_POST, 'commentaire');
        $rdv = filter_input(INPUT_POST, 'rdv');
        
        if(is_null($etat) || is_null($rdv) || is_null($commentaire)) {
            header('HTTP/1.0 400 Bad');
            $this->show('error/err400');
            exit;
        }

        $bc = Bc::find($id);

        $bc->setEtat($etat);
        $bc->setCommentaire($commentaire);
        ($rdv !== "") ? $bc->setRdv($rdv) : NULL;
        

        $bc->update();
        
        
        if ($bc->getEtat() === "Facturé" || $bc->getEtat() === "Terminé"){
            header('Location: ' . $this->router->generate('facturetl-list'));
        } else if ($bc->getEtat() ==="Annulé"){
            header('Location: ' . $this->router->generate('annuletl-list'));
        } else {
            header('Location: ' . $this->router->generate('tl-list'));
        }

        exit;
    }

    public function deleteBt($id)
    { 
        
        
        $bc = Bc::find($id);

        
        $bc->delete();
        
        // $_SERVER["HTTP_REFERER"] redirige vers la page d'ou est lancée la requete
        header('Location: ' . $this->router->generate('tl-list'));
        exit;
    }

    
}