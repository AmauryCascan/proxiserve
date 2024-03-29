<?php

namespace App\Controllers;

// Classe gérant les erreurs (404, 403)
class ErrorController extends CoreController
{
    /**
     * Méthode gérant l'affichage de la page 404
     *
     * @return void
     */
    public function err404()
    {
        // On envoie le header 404
        header('HTTP/1.0 404 Not Found');

        // Puis on gère l'affichage
        $this->show('error/err404');
    }

    public function err403()
    {
        header('HTTP/1.0 403 Not Found');

        $this->show('error/err403');
    }

    public function err400()
    {
        header('HTTP/1.0 400 Bad Request');

        $this->show('error/err400');
    }
}
