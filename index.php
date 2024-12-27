<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'autoload.php';

class Router
{
    private $routes = [];
    private $prefix;

    public function __construct($prefix = '')
    {
        $this->prefix = trim($prefix, '/');
    }

    public function addRoute($uri, $controllerMethod)
    {
        $this->routes[trim($uri, '/')] = $controllerMethod;
    }

    public function route($url)
    {
        // Enlève le préfixe du début de l'URL
        if ($this->prefix && strpos($url, $this->prefix) === 0) {
            $url = substr($url, strlen($this->prefix) + 1);
        }
        // Enlève les barres obliques en trop
        $url = trim($url, '/');
        // Vérification de la correspondance de l'URL à une route définie
        foreach ($this->routes as $route => $controllerMethod) {
            // Vérifie si l'URL correspond à une route avec des paramètres
            $routeParts = explode('/', $route);
            $urlParts = explode('/', $url);

            // Si le nombre de segments correspond
            if (count($routeParts) === count($urlParts)) {
                // Vérification de chaque segment
                $params = [];
                $isMatch = true;
                foreach ($routeParts as $index => $part) {
                    if (preg_match('/^{\w+}$/', $part)) {
                        // Capture les paramètres
                        $params[] = $urlParts[$index];
                    } elseif ($part !== $urlParts[$index]) {
                        $isMatch = false;
                        break;
                    }
                }

                if ($isMatch) {
                    // Extraction du nom du contrôleur et de la méthode
                    list($controllerName, $methodName) = explode('@', $controllerMethod);

                    // Instanciation du contrôleur et appel de la méthode avec les paramètres
                    $controller = new $controllerName();
                    call_user_func_array([$controller, $methodName], $params);
                    return;
                }
            }
        }

        // Si aucune route n'a été trouvée, gérer l'erreur 404
        require_once 'views/404.php';
    }
}

// Instanciation du routeur
$router = new Router('DungeonXplorer');

// Ajout des routes
//PAGES
$router->addRoute('', 'HomeController@index');                  // Pour la racine
$router->addRoute('home', 'HomeController@index');              // Pour la racine
$router->addRoute('signin', 'SignController@signin');           // Pour afficher le formulaire de connexion
$router->addRoute('signup', 'SignController@signup');           // Pour afficher le formulaire d'inscription
$router->addRoute('chapter', 'ChapterController@showChapter');  // Pour afficher le chapitre actuelle
$router->addRoute('adventure', 'AdventureController@show');     // Pour afficher le choix des aventures
$router->addRoute('fight', 'FightController@fightRound');       // Pour afficher le combat du chapitre actuelle



//BACK-END          /!\ DON'T USE DIRECLY /!\


//connection
$router->addRoute('testlogin', 'SignController@testSignin'); // Try Signing in

//chapter
$router->addRoute('chapter/{id}', 'ChapterController@startAdventure'); // Pour afficher le premier chapitre d'une aventure et la commencé
$router->addRoute('nextchapter/{id}', 'ChapterController@nextChapter');// Pour passer au chapitre suivant choisi
$router->addRoute('chapter/save', 'ChapterController@save');//Save and exit current adventure

//fights
$router->addRoute('resetfight', 'FightController@resetMonster'); // Pour reset un combat

//profil
$router->addRoute('deleteaccount', 'UserController@deleteAccount'); // Try deleting account
$router->addRoute('logout', 'UserController@logOut'); // Try logging out

//adventure
$router->addRoute('startnew/{id}', 'AdventureController@startNew');

// Appel de la méthode route
$router->route(trim($_SERVER['REQUEST_URI'], '/'));
