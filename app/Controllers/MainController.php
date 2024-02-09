<?php

namespace App\Controllers;

use App\Models\Bt;
use App\Models\Etat;
use App\Models\Type;
use App\Models\AppUser;
use App\Models\Secteur;

class MainController extends CoreController
{
    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function home()
    {
        
        $bts = Bt:: findNonFacture();
        $etats = Etat::findAll();
        $types = Type::findAll();
        $secteurs = Secteur::findAll();
        $users = AppUser::findAll();

        $data = [
            'bts' => $bts,
            'etats' => $etats,
            'types' => $types,
            'secteurs' => $secteurs,
            'users' => $users
        ];
    
        $this->show('main/home', $data);
    }

    public function filtreBt($bt)
    {
        
        $bts = BT::findByBt($bt);
        $types = Type::findAll();
        $secteurs = Secteur::findAll();
        $etats = Etat::findAll();
        $users = AppUser::findAll();
        
        $this->show('main/filtre', ['bts' => $bts, 'types' =>$types, 'secteurs' =>$secteurs, 'etats' => $etats,'users' => $users]);
    }

    public function filtreType($params)
    {
        $urldecode = urldecode($params);
        $type =  str_replace('+', ' ', $urldecode);

        $bts = BT::findByType($type);
        $types = Type::findAll();
        $secteurs = Secteur::findAll();
        $etats = Etat::findAll();
        $users = AppUser::findAll();
        
        $this->show('main/filtre', ['bts' => $bts, 'types' =>$types, 'secteurs' =>$secteurs, 'etats' => $etats, 'users' => $users]);
    }
    public function filtreSecteur($params)
    {   
        $urldecode = urldecode($params);
        $secteur =  str_replace('+', ' ', $urldecode);
        $bts = BT::findBySecteur($secteur);
        $types = Type::findAll();
        $secteurs = Secteur::findAll();
        $etats = Etat::findAll();
        $users = AppUser::findAll();
        
        $this->show('main/filtre', ['bts' => $bts, 'types' =>$types, 'secteurs' =>$secteurs, 'etats' => $etats, 'users' => $users]);
    }
    public function filtreEtat($params)
    {      
        $urldecode = urldecode($params);
        $etat =  str_replace('+', ' ', $urldecode);
        $bts = BT::findByEtat($etat);
        $types = Type::findAll();
        $secteurs = Secteur::findAll();
        $etats = Etat::findAll();
        $users = AppUser::findAll();
        
        $this->show('main/filtre', ['bts' => $bts, 'types' =>$types, 'secteurs' =>$secteurs, 'etats' => $etats, 'users' => $users]);
    }
}