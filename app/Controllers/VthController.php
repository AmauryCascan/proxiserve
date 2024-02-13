<?php

namespace App\Controllers;

use App\Models\Bt;
use App\Models\Rob;
use App\Models\Etat;
use App\Models\Type;
use App\Models\AppUser;
use App\Models\Secteur;

class VthController extends CoreController
{
    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function list()
    {
        
        $bts = Bt:: findNonFacture();
        $etats = Etat::findAll();
        $types = Type::findAll();
        $robs = Rob::findAll();
        $secteurs = Secteur::findAll();
        $users = AppUser::findAll();

        $data = [
            'bts' => $bts,
            'etats' => $etats,
            'types' => $types,
            'robs' => $robs,
            'secteurs' => $secteurs,
            'users' => $users
        ];
    
        $this->show('vth/encours', $data);
    }

    public function filtreBt($bt)
    {
        
        $bts = BT::findByBt($bt);
        $types = Type::findAll();
        $robs = Rob::findAll();
        $secteurs = Secteur::findAll();
        $etats = Etat::findAll();
        $users = AppUser::findAll();
        
        $this->show('vth/filtre', ['bts' => $bts, 'types' =>$types, 'robs' =>$robs, 'secteurs' =>$secteurs, 'etats' => $etats,'users' => $users]);
    }

    public function filtreType($params)
    {
        $urldecode = urldecode($params);
        $type =  str_replace('+', ' ', $urldecode);

        $bts = BT::findByType($type);
        $types = Type::findAll();
        $robs = Rob::findAll();
        $secteurs = Secteur::findAll();
        $etats = Etat::findAll();
        $users = AppUser::findAll();
        
        $this->show('vth/filtre', ['bts' => $bts, 'types' =>$types, 'robs' =>$robs, 'secteurs' =>$secteurs, 'etats' => $etats, 'users' => $users]);
    }
    public function filtreSecteur($params)
    {   
        $urldecode = urldecode($params);
        $secteur =  str_replace('+', ' ', $urldecode);
        $bts = BT::findBySecteur($secteur);
        $types = Type::findAll();
        $robs = Rob::findAll();
        $secteurs = Secteur::findAll();
        $etats = Etat::findAll();
        $users = AppUser::findAll();
        
        $this->show('vth/filtre', ['bts' => $bts, 'types' =>$types, 'robs' =>$robs, 'secteurs' =>$secteurs, 'etats' => $etats, 'users' => $users]);
    }
    public function filtreEtat($params)
    {      
        $urldecode = urldecode($params);
        $etat =  str_replace('+', ' ', $urldecode);
        $bts = BT::findByEtat($etat);
        $types = Type::findAll();
        $robs = Rob::findAll();
        $secteurs = Secteur::findAll();
        $etats = Etat::findAll();
        $users = AppUser::findAll();
        
        $this->show('vth/filtre', ['bts' => $bts, 'types' =>$types, 'robs' =>$robs, 'secteurs' =>$secteurs, 'etats' => $etats, 'users' => $users]);
    }
    public function filtreRob($params)
    {      
        $urldecode = urldecode($params);
        $rob =  str_replace('+', ' ', $urldecode);
        $bts = BT::findByRob($rob);
        $types = Type::findAll();
        $robs = Rob::findAll();
        $secteurs = Secteur::findAll();
        $etats = Etat::findAll();
        $users = AppUser::findAll();
        
        $this->show('vth/filtre', ['bts' => $bts, 'types' =>$types, 'robs' =>$robs, 'secteurs' =>$secteurs, 'etats' => $etats, 'users' => $users]);
    }

    public function listAnnule()
    {
        
        $bts = Bt:: findAnnule();
        $etats = Etat::findAll();
        $robs = Rob::findAll();
        $types = Type::findAll();
        $secteurs = Secteur::findAll();
        $users = AppUser::findAll();

        $data = [
            'bts' => $bts,
            'etats' => $etats,
            'types' => $types,
            'robs' => $robs,
            'secteurs' => $secteurs,
            'users' => $users
        ];
    
        $this->show('vth/annule', $data);
    }

    public function listFacture()
    {
        
        $bts = Bt:: findFacture();
        $etats = Etat::findAll();
        $robs = Rob::findAll();
        $types = Type::findAll();
        $secteurs = Secteur::findAll();
        $users = AppUser::findAll();

        $data = [
            'bts' => $bts,
            'etats' => $etats,
            'types' => $types,
            'robs' => $robs,
            'secteurs' => $secteurs,
            'users' => $users
        ];
    
        $this->show('vth/facture', $data);
    }

    public function listRobinetterie()
    {
        
        $bts = Bt:: findRob();
        $etats = Etat::findAll();
        $robs = Rob::findAll();
        $types = Type::findAll();
        $secteurs = Secteur::findAll();
        $users = AppUser::findAll();

        $data = [
            'bts' => $bts,
            'etats' => $etats,
            'types' => $types,
            'robs' => $robs,
            'secteurs' => $secteurs,
            'users' => $users
        ];
    
        $this->show('vth/robinetterie', $data);
    }
    
    public function listInfo()
    {
        $etats = Etat::findAll();
        $types = Type::findAll();
        $secteurs = Secteur::findAll();
        $robs = Rob::findAll();

        $data = [
            'etats' => $etats,
            'types' => $types,
            'robs' => $robs,
            'secteurs' => $secteurs,
        ];
        
        $this->show('vth/infos', $data);
    }

    /**
     * Méthode s'occupant de la page see Bon travaux 
     *
     * @return void
     */
    public function see($id)
    {
        $etats = Etat::findAll();
        $bt = Bt::find($id);
        $robs = Rob::findAll();
        

        $data = [
            'bt' => $bt,
            'etats' => $etats,
            'robs' => $robs
        ];
        
    
        $this->show('vthTravaux/see', $data);
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
        $robs = Rob::findAll();
        $secteurs = Secteur::findAll();
        $appUsers = AppUser::findAll();
        $bt = new Bt();
        $data = [
            'etats' => $etats,
            'types' => $types,
            'robs' => $robs,
            'secteurs' => $secteurs,
            'bt' => $bt,
            'appUsers' => $appUsers,
        ];
        
        $this->show('vthTravaux/add', $data);
    }

    /**
     * Méthode s'occupant de la page update Bon travaux 
     *
     * @return void
     */
    public function update($id)
    {
        
        $bt = Bt::find($id);
        $etats = Etat::findAll();
        $robs = Rob::findAll();
        $types = Type::findAll();
        $secteurs = Secteur::findAll();

        $data = [
            'etats' => $etats,
            'types' => $types,
            'robs' => $robs,
            'secteurs' => $secteurs,
            'bt' => $bt,
        ];
        
    
        $this->show('vthTravaux/update', $data);
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
        $bontravaux = filter_input(INPUT_POST, 'bt');
        $type = filter_input(INPUT_POST, 'type');
        $secteur = filter_input(INPUT_POST, 'secteur');
        $rob = filter_input(INPUT_POST, 'rob');
        $start = filter_input(INPUT_POST, 'start');
        $end = filter_input(INPUT_POST, 'end');
        $person = filter_input(INPUT_POST, 'person');
        $etat = filter_input(INPUT_POST, 'etat');
        $document = $fileName;
        $price = filter_input(INPUT_POST, 'price');
        $rdv = filter_input(INPUT_POST, 'rdv');
        $commande = filter_input(INPUT_POST, 'commande');

        if(is_null($years) || is_null($bontravaux) || is_null($type) || is_null($rob) || is_null($secteur) || is_null($start) || is_null($end)
        || is_null($person) || is_null($etat) || is_null($document) || is_null($price) || is_null($rdv) || is_null($commande)) {
            header('HTTP/1.0 400 Bad');
            $this->show('error/err400');
            exit;
        }
        
        
        
        $bt = new Bt();

        $bt->setYears($years);
        $bt->setBt($bontravaux);
        $bt->setType($type);
        $bt->setSecteur($secteur);
        ($rob !== "") ? $bt->setRob($rob) : NULL;
        ($start !== "") ? $bt->setStart($start) : NULL;
        ($end !== "") ? $bt->setEnd($end) : NULL;
        ($person !== "") ? $bt->setPerson($person) : NULL;
        $bt->setEtat($etat);
        ($document !== "") ? $bt->setDocument($document) : NULL;
        ($price !== "") ? $bt->setPrice($price) : NULL;
        ($rdv !== "") ? $bt->setRdv($rdv) : NULL;
        ($commande !== "") ? $bt->setCommande($commande) : NULL;
        
        $bt->insert();

        header('Location: ' . $this->router->generate('vth-list'));
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
        $bontravaux = filter_input(INPUT_POST, 'bt');
        $type = filter_input(INPUT_POST, 'type');
        $rob = filter_input(INPUT_POST, 'rob');
        $secteur = filter_input(INPUT_POST, 'secteur');
        $start = filter_input(INPUT_POST, 'start');
        $end = filter_input(INPUT_POST, 'end');
        $person = filter_input(INPUT_POST, 'person');
        $etat = filter_input(INPUT_POST, 'etat');
        $document = $fileName;
        $price = filter_input(INPUT_POST, 'price');
        $rdv = filter_input(INPUT_POST, 'rdv');
        $commande = filter_input(INPUT_POST, 'commande');

        if(is_null($years) || is_null($bontravaux) || is_null($type) || is_null($rob) || is_null($secteur) || is_null($start) || is_null($end)
        || is_null($person) || is_null($etat) || is_null($document) || is_null($price) || is_null($rdv) || is_null($commande)) {
            header('HTTP/1.0 400 Bad');
            $this->show('error/err400');
            exit;
        }
        
        $bt = Bt::find($id);
        
        $bt->setYears($years);
        $bt->setBt($bontravaux);
        $bt->setType($type);
        ($rob !== "") ? $bt->setRob($rob) : NULL;
        $bt->setSecteur($secteur);
        ($start !== "") ? $bt->setStart($start) : NULL;
        ($end !== "") ? $bt->setEnd($end) : NULL;
        ($person !== "") ? $bt->setPerson($person) : NULL;
        $bt->setEtat($etat);
        if(!empty($fileName)){
        ($document !== "") ? $bt->setDocument($document) : NULL;
        }
        ($price !== "") ? $bt->setPrice($price) : NULL;
        ($rdv !== "") ? $bt->setRdv($rdv) : NULL;
        ($commande !== "") ? $bt->setCommande($commande) : NULL;
        
        $bt->update();
        header('Location: ' . $this->router->generate('vth-see', ['id' => $bt->getId()]));
        exit;
    }

    public function seePost($id) {
        

        $etat = filter_input(INPUT_POST, 'etat');
        $rdv = filter_input(INPUT_POST, 'rdv');
        $commentaire = filter_input(INPUT_POST, 'commentaire');
        $commentaireVth = filter_input(INPUT_POST, 'commentaireVth');
        $rob = filter_input(INPUT_POST, 'rob');

     
        $bt = Bt::find($id);

        if(is_null($etat)){
            $etat = $bt->getEtat();
        }
        if(is_null($commentaire)){
            $commentaire = $bt->getCommentaire();
        }
        if(is_null($commentaireVth)){
            $commentaireVth = $bt->getCommentaireVth();
        }
        if(is_null($rdv)){
            $rdv = $bt->getRdv();
        }

        $bt->setEtat($etat);
        $bt->setCommentaire($commentaire);
        $bt->setCommentaireVth($commentaireVth);
        ($rdv !== "") ? $bt->setRdv($rdv) : NULL;
        ($rob !== "") ? $bt->setRob($rob) : NULL;

        $bt->update();
        
        
        if ($bt->getEtat() === "Facturé" || $bt->getEtat() === "Terminé"){
            header('Location: ' . $this->router->generate('facture-list'));
        } else if ($bt->getEtat() ==="Annulé"){
            header('Location: ' . $this->router->generate('annule-list'));
        } else {
            header('Location: ' . $this->router->generate('vth-list'));
        }

        exit;
    }

    public function deleteBt($id)
    { 
        
        
        $bt = Bt::find($id);

        
        $bt->delete();
        
        // $_SERVER["HTTP_REFERER"] redirige vers la page d'ou est lancée la requete
        header('Location: ' . $this->router->generate('vth-list'));
        exit;
    }

    
}