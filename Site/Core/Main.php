<?php
namespace App\Core;

use App\Controller\MainController;

class Main 
{
    public function start()
    {
        $controller = new MainController;
        $controller->index();
        
        // // on retire le "trailing slash" éventuel de l'URL

        // $uri = $_SERVER['REQUEST_URI'];

        // // on vérifie que uri n'est pas vide est se termine par un slash

        // if (!empty($uri) && $uri != '/' &&  $uri[-1] === "/") {
        //     // on elève le slash
        //     $uri = substr($uri, 0, -1);

        //     // on envoie un code de redirectioon permanente
        //     http_response_code(301);

        //     // on redirige vers l'url sans /
        //     header('Location: '.$uri);
        // } 

        // // on gère les paramètres
        // // p = controller/method/param
        // // on sépare en tableau les paramètres
        // $params = explode('/', $_GET["p"]);
        

        // if ($params[0] != ''){
        //     //  on a au moins un param
        //     $controller = '\\App\\Controller\\'.ucfirst(array_shift($params)).'Controller';
        //   	$controller = new $controller;
            
        //     $action = (isset($params[0])) ? array_shift($params) : 'index';
          	
        //   	if (method_exists($controller, $action)
        //     {
        //         // si il reste des params
        //         $parametres[] = (isset($params[0])) ? $controller->$action($params) : $controller->$action;
        //     } else {
        //       http_response_code(404);
        //       echo 'la page recherchée n\‘existe pas';

        // } else {
        //    // on a pas de paramètre 
        //   	// on instancie le controller par defaut
        //     $controller = new MainController;
        //     $controller->index();
        // }
    }
}