<?php
require 'session.php';

use App\Autoload;
use App\Model\PostsModel;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

define('ROOT', dirname(__DIR__));

require_once ROOT.'/public/Autoload.php';
require ROOT.'/vendor/autoload.php';

Autoload::register();

$loader = new FilesystemLoader(ROOT.'/templates');
$twig = new Environment($loader);

$model = new PostsModel;
$posts = $model->readAllPostClassed();

$nbPage = 4;

echo $twig->render('admin/homePage.html', [
    'id' => htmlspecialchars($id),
    'nom' => htmlspecialchars($nom),
    'prenom' => htmlspecialchars($prenom),
    'email' => htmlspecialchars($email),
    'pass' => htmlspecialchars($mdp),
    'posts' => $posts,
    'nbpage' => $nbPage
]);

