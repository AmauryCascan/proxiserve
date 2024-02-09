<?php

namespace App\Controllers;

use App\Models\Bt;
use App\Models\Etat;
use App\Models\Type;
use App\Models\AppUser;
use App\Models\Secteur;

class FactureController extends CoreController {

    public function list()
    {
        
        $bts = Bt:: findFacture();
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
    
        $this->show('facture/list', $data);
    }
    
}