<?php

namespace App\Controllers;


class CoreController
{

    protected $router;

    public function __construct($router, $match)
    {
        
        $this->router = $router;
        
        $acl =[
            // login accessible à tous le monde on ne la met pas
            'main-home' => ['admin', 'manager', 'client'],
            'security-logout' => ['admin', 'manager', 'client'],
            'vth-list' => ['admin', 'manager', 'client'],
            'vth-filtrebt' => ['admin', 'manager', 'client'],
            'vth-filtreType' => ['admin', 'manager', 'client'],
            'vth-filtreSecteur' => ['admin', 'manager', 'client'],
            'vth-filtreEtat' => ['admin', 'manager', 'client'],
            'vth-see' => ['admin', 'manager', 'client'],
            'vth-seepost' => ['admin', 'manager', 'client'],
            'facture-list' => ['admin', 'manager', 'client'],
            'annule-list' => ['admin', 'manager', 'client'],
            'vth-add' => ['admin', 'manager'],
            'vth-addpost' => ['admin', 'manager'],
            'vth-update'  => ['admin', 'manager'],
            'vth-updatepost' => ['admin', 'manager'],
            'vth-delete' => ['admin', 'manager'],
            'infos-list' => ['manager'],
            'type-add' => ['manager'],
            'type-addPost' => ['manager'],
            'type-update' => ['manager'],
            'type-updatepost' => ['manager'],
            'type-delete' => ['manager'],
            'secteur-add' => ['manager'],
            'secteur-addpost' => ['manager'],
            'secteur-update' => ['manager'],
            'secteur-updatepost' => ['manager'],
            'secteur-delete' => ['manager'],
            'etat-add' => ['manager'],
            'etat-addpost' => ['manager'],
            'etat-update' => ['manager'],
            'etat-updatepost' => ['manager'],
            'etat-delete' => ['manager'],
            'user-list' => ['manager'],
            'user-add' => ['manager'],
            'user-addpost' => ['manager'],
            'user-update' => ['manager'],
            'user-delete' => ['manager'],
            'user-mdp' => ['manager'],
            'user-mdppost' => ['manager'],
            'tl-list' => ['admin', 'manager'],
            'tl-filtrebc' => ['admin', 'manager'],
            'tl-filtreType' => ['admin', 'manager'],
            'tl-filtreEtat' => ['admin', 'manager'],
            'tl-add' => ['admin', 'manager'],
            'tl-addpost' => ['admin', 'manager'],
            'tl-update' => ['admin', 'manager'],
            'tl-updatepost' => ['admin', 'manager'],
            'tl-see' => ['admin', 'manager'],
            'tl-seepost' => ['admin', 'manager'],
            'tl-delete' => ['admin', 'manager'],
            'facturetl-list' => ['admin', 'manager'],
            'annuletl-list' => ['admin', 'manager'],
            'infos-list' => ['admin', 'manager'],

        ];

        $csrfRoutesToCheck = [
            'vth-addpost',
            'vth-updatepost',
            'vth-seepost',
            'vth-delete',
            'type-addPost',
            'type-updatepost',
            'type-delete',
            'secteur-addpost',
            'secteur-updatepost',
            'secteur-delete',
            'etat-addpost',
            'etat-updatepost',
            'etat-delete',
            'user-addpost',
            'user-updatePost',
            'user-delete',
            'user-mdppost',
            'tl-addpost',
            'tl-updatepost',
            'tl-seepost',
            'tl-delete',
        ];
        
        // on peut récupérer le nom de la route actuelle grâce à $match (envoyé depuis index.php)
        if ($match !== false){
            $routeName = $match['name'];
        
            if(array_key_exists($routeName, $acl)){
                // si oui :
                // on vérifie si l'utilisateur a le rôle approprié pour accéder à cette page -> checkAuthorization()
                $this->checkAuthorization($acl[$routeName]);
            }
            // on vérifie si la route actuelle nécessite une vérif CSRF
            if(in_array($routeName, $csrfRoutesToCheck)) {
                // la route nécessite une vérif du token, on le récupère dans le formulaire
                if($_SERVER['REQUEST_METHOD'] == "POST") {
                    // requête en POST, donc on récupère le token dans les paramètres POST
                    $token = filter_input(INPUT_POST, 'csrftoken');
                } else if ($_SERVER['REQUEST_METHOD'] == "GET") {
                    // requête en GET, donc on récupère le token dans les paramètres GET
                    $token = filter_input(INPUT_GET, 'csrftoken');
                }
            
           
                // on le compare à celui stocké en session !
                if ($token !== $_SESSION['CSRFToken']) {
                    // s'ils ne sont pas identiques, on redirige l'utilisateur vers une erreur 403 !
                    http_response_code(403);
                    // on affiche le template err403
                    $this->show('error/err403');   
                    // on arrête le script avec exit pour être sûr qu'il n'aille pas plus loin !
                    exit;
                }
            }
        }
              
    }

     /**
     * Cette méthode détermine si un utilisateur a le role apprprié pour accéder à une page
     * Si il n'a pas le bon rôle (ex : s'il est catalog-manager et que seuls les admins ont le droit d'accéeder à la page) err eur di pas le bon role
     * pas connecté on redirige cers login
     * RAS si bon rôle
     *
     * @param string[] $allowedRoles tableau contenant les rôles autorisés pour la page courante
     * @return bool
     */
    public function checkAuthorization($allowedRoles = [])
    {
        // est-ce que l'user est connecté ?
        if(isset($_SESSION['userObject']) && $_SESSION['userObject']->getStatus() === 1){
        // si oui:
            // on récupère le rôle de l'user
            $role = $_SESSION['userObject']->getRole();
            //est-ce que le rôle de l'user fait partie des rôles autorisés
            if(in_array($role, $allowedRoles)){
            //si oui :
                //on return true, l'user peut accéder à la page !
                return true;
            } else {
            //si non :
                // on affiche "403 Forbidden"
                // pour indiquer qu'il n'a pas le droit d'acces
                header('HTTP/1.0 403 Not Found');

                $this->show('error/err403');
                // on fini le script

                exit;
            }
        } else {
        // si non:
            // on le redirige vers le login
            header("Location:" . $this->router->generate('security-login'));
            exit;
        }
    }

    /**
     * Génère un nouveau token CSRF et le save en session pour vérif ultérieu
     *
     * @return string Le token CSRF généré que l'on va pouvoir cacher dans le formulaire
     */
    public function generateCSRFToken()
    {
        //on génère un token 
        $token = bin2hex(random_bytes(32));

        // on le stocke en session
        $_SESSION['CSRFToken'] = $token;

        return $token;
    }
      

    /**
     * Méthode permettant d'afficher du code HTML en se basant sur les views
     *
     * @param string $viewName Nom du fichier de vue
     * @param array $viewData Tableau des données à transmettre aux vues
     * @return void
     */
    protected function show(string $viewName, $viewData = [])
    {
        
        $this->router;

        
        
        // Comme $viewData est déclarée comme paramètre de la méthode show()
        // les vues y ont accès
        // ici une valeur dont on a besoin sur TOUTES les vues
        // donc on la définit dans show()
        $viewData['currentPage'] = $viewName;
        // définir l'url absolue pour nos assets
        $viewData['assetsBaseUri'] = $_SERVER['BASE_URI'] . 'assets/';
        $viewData['imagesBaseUri'] = $_SERVER['BASE_URI'] . 'images/';
        $viewData['pdfBaseUri'] = $_SERVER['BASE_URI'] . 'doc/bon_travaux/';
        
        // définir l'url absolue pour la racine du site
        // /!\ != racine projet, ici on parle du répertoire public/
        $viewData['baseUri'] = $_SERVER['BASE_URI'];
        
        
        // On veut désormais accéder aux données de $viewData, mais sans accéder au tableau
        // La fonction extract permet de créer une variable pour chaque élément du tableau passé en argument
        extract($viewData);
        // => la variable $currentPage existe désormais, et sa valeur est $viewName
        // => la variable $assetsBaseUri existe désormais, et sa valeur est $_SERVER['BASE_URI'] . '/assets/'
        // => la variable $baseUri existe désormais, et sa valeur est $_SERVER['BASE_URI']
        // => il en va de même pour chaque élément du tableau
        // $viewData est disponible dans chaque fichier de vue
        require_once __DIR__ . '/../views/layout/header.tpl.php';
        require_once __DIR__ . '/../views/' . $viewName . '.tpl.php';
        require_once __DIR__ . '/../views/layout/footer.tpl.php';
    }
}
