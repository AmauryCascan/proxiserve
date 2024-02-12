<?php 

require_once '../vendor/autoload.php';

session_start();

$router = new AltoRouter();

if (array_key_exists('BASE_URI', $_SERVER)) {
    
    $router->setBasePath($_SERVER['BASE_URI']);
   
} else { // sinon
  
    $_SERVER['BASE_URI'] = '/';
}

//Security

$router->map(
    'GET',
    '/login',
    [
        'method' =>'login',
        'controller' => '\App\Controllers\SecurityController'
    ],
    'security-login'
);

$router->map(
    'POST',
    '/login',
    [
        'method' =>'loginPost',
        'controller' => '\App\Controllers\SecurityController'
    ],
    'security-loginpost'
);

$router->map(
    'GET',
    '/logout',
    [
        'method' => 'logout',
        'controller' => '\App\Controllers\SecurityController'
    ],
    'security-logout'
);

//home
$router->map(
    'GET',
    '/',
    [
        'method' => 'home',
        'controller' => '\App\Controllers\MainController' 
    ],
    'main-home'
);

//vth 
$router->map(
    'GET',
    '/vth/encours/liste',
    [
        'method' => 'list',
        'controller' => '\App\Controllers\VthController' 
    ],
    'vth-list'
);

$router->map(
    'GET',
    '/filtre/vth/[i:id]',
    [
        'method' => 'filtreBt',
        'controller' => '\App\Controllers\VthController' 
    ],
    'vth-filtrebt'
);

$router->map(
    'GET',
    '/vth/filtre/type/[*:type]',
    [
        'method' => 'filtreType',
        'controller' => '\App\Controllers\VthController' 
    ],
    'vth-filtreType'
);
$router->map(
    'GET',
    '/vth/filtre/secteur/[*:secteur]',
    [
        'method' => 'filtreSecteur',
        'controller' => '\App\Controllers\VthController' 
    ],
    'vth-filtreSecteur'
);
$router->map(
    'GET',
    '/vth/filtre/etat/[*:etat]',
    [
        'method' => 'filtreEtat',
        'controller' => '\App\Controllers\VthController' 
    ],
    'vth-filtreEtat'
);


//bon travaux vth

$router->map(
    'GET',
    '/vth/add',
    [
        'method' => 'add',
        'controller' => '\App\Controllers\VthController' 
    ],
    'vth-add'
);

$router->map(
    'POST',
    '/vth/add',
    [
        'method' => 'addPost',
        'controller' => '\App\Controllers\VthController' 
    ],
    'vth-addpost'
);

$router->map(
    'GET',
    '/vth/update/[i:id]',
    [
        'method' => 'update',
        'controller' => '\App\Controllers\VthController' 
    ],
    'vth-update'
);

$router->map(
    'POST',
    '/vth/update/[i:id]',
    [
        'method' => 'updatePost',
        'controller' => '\App\Controllers\VthController' 
    ],
    'vth-updatepost'
);

$router->map(
    'GET',
    '/vth/see/[i:id]',
    [
        'method' => 'see',
        'controller' => '\App\Controllers\VthController' 
    ],
    'vth-see'
);

$router->map(
    'POST',
    '/vth/see/[i:id]',
    [
        'method' => 'seePost',
        'controller' => '\App\Controllers\VthController' 
    ],
    'vth-seepost'
);

$router->map(
    'GET',
    '/vth/delete/[i:id]',
    [
        'method' => 'deleteBt',
        'controller' => '\App\Controllers\VthController'
    ],
    'vth-delete'
);

//Facturé vth

$router->map(
    'GET',
    '/vth/facture/liste',
    [
        'method' => 'listFacture',
        'controller' => '\App\Controllers\VthController' 
    ],
    'facture-list'
);

//Annulé vth
$router->map(
    'GET',
    '/vth/annule/liste',
    [
        'method' => 'listAnnule',
        'controller' => '\App\Controllers\VthController' 
    ],
    'annule-list'
);

//Annulé vth
$router->map(
    'GET',
    '/vth/robinetterie/liste',
    [
        'method' => 'listRobinetterie',
        'controller' => '\App\Controllers\VthController' 
    ],
    'robinetterie-list'
);

//tl
$router->map(
    'GET',
    '/tl/encours/liste',
    [
        'method' => 'list',
        'controller' => '\App\Controllers\TlController' 
    ],
    'tl-list'
);

$router->map(
    'GET',
    '/filtre/tl/[i:id]',
    [
        'method' => 'filtreBc',
        'controller' => '\App\Controllers\TlController' 
    ],
    'tl-filtrebc'
);

$router->map(
    'GET',
    '/tl/filtre/type/[*:type]',
    [
        'method' => 'filtreType',
        'controller' => '\App\Controllers\TlController' 
    ],
    'tl-filtreType'
);

$router->map(
    'GET',
    '/tl/filtre/etat/[*:etat]',
    [
        'method' => 'filtreEtat',
        'controller' => '\App\Controllers\TlController' 
    ],
    'tl-filtreEtat'
);

//bon travaux tl

$router->map(
    'GET',
    '/tl/add',
    [
        'method' => 'add',
        'controller' => '\App\Controllers\TlController' 
    ],
    'tl-add'
);

$router->map(
    'POST',
    '/tl/add',
    [
        'method' => 'addPost',
        'controller' => '\App\Controllers\TlController' 
    ],
    'tl-addpost'
);

$router->map(
    'GET',
    '/tl/update/[i:id]',
    [
        'method' => 'update',
        'controller' => '\App\Controllers\TlController' 
    ],
    'tl-update'
);

$router->map(
    'POST',
    '/tl/update/[i:id]',
    [
        'method' => 'updatePost',
        'controller' => '\App\Controllers\TlController' 
    ],
    'tl-updatepost'
);

$router->map(
    'GET',
    '/tl/see/[i:id]',
    [
        'method' => 'see',
        'controller' => '\App\Controllers\TlController' 
    ],
    'tl-see'
);

$router->map(
    'POST',
    '/tl/see/[i:id]',
    [
        'method' => 'seePost',
        'controller' => '\App\Controllers\TlController' 
    ],
    'tl-seepost'
);

$router->map(
    'GET',
    '/tl/delete/[i:id]',
    [
        'method' => 'deleteBt',
        'controller' => '\App\Controllers\TlController'
    ],
    'tl-delete'
);

//Facturé TL

$router->map(
    'GET',
    '/tl/facture/liste',
    [
        'method' => 'listFacture',
        'controller' => '\App\Controllers\TlController' 
    ],
    'facturetl-list'
);

//Annulé TL
$router->map(
    'GET',
    '/tl/annule/liste',
    [
        'method' => 'listAnnule',
        'controller' => '\App\Controllers\TlController' 
    ],
    'annuletl-list'
);

//infos

$router->map(
    'GET',
    '/infos/liste',
    [
        'method' => 'listInfo',
        'controller' => '\App\Controllers\VthController' 
    ],
    'infos-list'
);


//type

$router->map(
    'GET',
    '/type/add',
    [
        'method' => 'add',
        'controller' => '\App\Controllers\TypeController' 
    ],
    'type-add'
);

$router->map(
    'POST',
    '/type/add',
    [
        'method' => 'addPost',
        'controller' => '\App\Controllers\TypeController' 
    ],
    'type-addPost'
);

$router->map(
    'GET',
    '/type/update/[i:id]',
    [
        'method' => 'update',
        'controller' => '\App\Controllers\TypeController' 
    ],
    'type-update'
);

$router->map(
    'POST',
    '/type/update/[i:id]',
    [
        'method' => 'updatePost',
        'controller' => '\App\Controllers\TypeController' 
    ],
    'type-updatepost'
);


$router->map(
    'GET',
    '/type/delete/[i:id]',
    [
        'method' => 'delete',
        'controller' => '\App\Controllers\TypeController'
    ],
    'type-delete'
);

//rob

$router->map(
    'GET',
    '/rob/add',
    [
        'method' => 'add',
        'controller' => '\App\Controllers\RobController' 
    ],
    'rob-add'
);

$router->map(
    'POST',
    '/rob/add',
    [
        'method' => 'addPost',
        'controller' => '\App\Controllers\RobController' 
    ],
    'rob-addPost'
);

$router->map(
    'GET',
    '/rob/update/[i:id]',
    [
        'method' => 'update',
        'controller' => '\App\Controllers\RobController' 
    ],
    'rob-update'
);

$router->map(
    'POST',
    '/rob/update/[i:id]',
    [
        'method' => 'updatePost',
        'controller' => '\App\Controllers\RobController' 
    ],
    'rob-updatepost'
);


$router->map(
    'GET',
    '/rob/delete/[i:id]',
    [
        'method' => 'delete',
        'controller' => '\App\Controllers\RobController'
    ],
    'rob-delete'
);

//secteur

$router->map(
    'GET',
    '/secteur/add',
    [
        'method' => 'add',
        'controller' => '\App\Controllers\SecteurController' 
    ],
    'secteur-add'
);

$router->map(
    'POST',
    '/secteur/add',
    [
        'method' => 'addPOst',
        'controller' => '\App\Controllers\SecteurController' 
    ],
    'secteur-addpost'
);

$router->map(
    'GET',
    '/secteur/update/[i:id]',
    [
        'method' => 'update',
        'controller' => '\App\Controllers\SecteurController' 
    ],
    'secteur-update'
);

$router->map(
    'POST',
    '/secteur/update/[i:id]',
    [
        'method' => 'updatePost',
        'controller' => '\App\Controllers\SecteurController' 
    ],
    'secteur-updatepost'
);

$router->map(
    'GET',
    '/secteur/delete/[i:id]',
    [
        'method' => 'delete',
        'controller' => '\App\Controllers\SecteurController'
    ],
    'secteur-delete'
);



//etat

$router->map(
    'GET',
    '/etat/add',
    [
        'method' => 'add',
        'controller' => '\App\Controllers\EtatController' 
    ],
    'etat-add'
);

$router->map(
    'POST',
    '/etat/add',
    [
        'method' => 'addpost',
        'controller' => '\App\Controllers\EtatController' 
    ],
    'etat-addpost'
);

$router->map(
    'GET',
    '/etat/update/[i:id]',
    [
        'method' => 'update',
        'controller' => '\App\Controllers\EtatController' 
    ],
    'etat-update'
);

$router->map(
    'POST',
    '/etat/update/[i:id]',
    [
        'method' => 'updatePost',
        'controller' => '\App\Controllers\EtatController' 
    ],
    'etat-updatepost'
);

$router->map(
    'GET',
    '/etat/delete/[i:id]',
    [
        'method' => 'delete',
        'controller' => '\App\Controllers\EtatController'
    ],
    'etat-delete'
);

// Utilisateurs

$router->map(
    'GET',
    '/user/list',
    [
        'method' => 'list',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-list'
);

$router->map(
    'GET',
    '/user/add',
    [
        'method' => 'add',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-add'
);

$router->map(
    'POST',
    '/user/add',
    [
        'method' => 'addPost',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-addpost'
);

$router->map(
    'GET',
    '/user/update/[i:id]',
    [
        'method' => 'update',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-update'
);

$router->map(
    'POST',
    '/user/update/[i:id]',
    [
        'method' => 'updatePost',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-updatePost'
);

$router->map(
    'GET',
    '/user/delete/[i:id]',
    [
        'method' => 'delete',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-delete'
);

$router->map(
    'GET',
    '/user/mdp/[i:id]',
    [
        'method' => 'updateMdp',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-mdp'
);
$router->map(
    'POST',
    '/user/mdp/[i:id]',
    [
        'method' => 'updateMdpPost',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-mdppost'
);



$match = $router->match();

$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::err404');

$dispatcher->setControllersArguments($router, $match);

$dispatcher->dispatch();
