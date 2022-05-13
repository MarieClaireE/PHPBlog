<?php
use App\Autoload;
use App\Model\CommentaireModel;
use App\Model\ReponseModel;
use App\Model\UsersModel;
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

$usersModel = new UsersModel;
$users = $usersModel->readAllUsers();

$modelReponse = new ReponseModel;
$reponses = $modelReponse->readAllClassed();

$nbPage = 4;

echo $twig->render('internaute/commentaire.html', [
    'comment' => $comment,
    'users' => $users,
    'reponses' => $reponses,
    'nbPage' => $nbPage
]);