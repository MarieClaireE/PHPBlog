<?php

use App\Autoload;
use App\Model\CommentaireModel;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

define('ROOT', dirname(__DIR__));

require_once ROOT.'/public/Autoload.php';
require ROOT.'/vendor/autoload.php';

Autoload::register();

$loader = new FilesystemLoader(ROOT.'/templates');
$twig = new Environment($loader);
$twig->getExtension(\Twig\Extension\CoreExtension::class)->setTimezone('Europe/Paris');

$commentaireModel = new CommentaireModel;
$comment = $commentaireModel->readId(filter_input(INPUT_GET, 'id'));

echo $twig->render('internaute/commentaire.html', [
    'comment' => $comment,
]);