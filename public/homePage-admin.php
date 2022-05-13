<?php
require 'session.php';

use App\Autoload;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

define('ROOT', dirname(__DIR__));

require_once ROOT.'/public/Autoload.php';
require ROOT.'/vendor/autoload.php';

Autoload::register();

$loader = new FilesystemLoader(ROOT.'/templates');
$twig = new Environment($loader);


echo $twig->render('admin/homePage.html', [
    'id' => htmlspecialchars($id),
    'nom' => htmlspecialchars($nom),
    'prenom' => htmlspecialchars($prenom),
    'email' => htmlspecialchars($email),
    'pass' => htmlspecialchars($mdp),
]);

