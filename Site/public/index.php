<?php
use App\Autoload;
use App\Core\Main;

//On défini une const contenant le dossier racine du projet 
define('ROOT', dirname(__DIR__));

// On apporte autoload
require_once ROOT.'/Autoload.php';
Autoload::register();

// on instancie Main = router
$app = new Main;

// on démarre l'app
$app->start();