<?php
include 'session.php';

use App\Autoload;
use App\Model\CommentaireModel;
use App\Model\Reponse;
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

$message = '';
$repondre_html = filter_input(INPUT_POST, 'repondre');
if (isset($repondre_html)) {
    $reponse= new Reponse;
    $reponse->setContenu(filter_input(INPUT_POST, 'contenu'));
    $reponse->setCommentaireId(filter_input(INPUT_POST, 'commentaireId'));
    $reponse->setUsersId(filter_input(INPUT_POST, 'usersId'));
    $reponse->setAddedOn(filter_input(INPUT_POST, 'addedOn'));
    $reponse->setStatut(filter_input(INPUT_POST, 'statut'));


    $model = new ReponseModel;
    $model->create($reponse);
    $message = 'Réponse envoyée en vérification';
}

echo $twig->render('users/commentaire.html', [
    'comment' => $comment,
    'id' => $id,
    'users' => $users,
    'reponses' => $reponses,
    'nbPage' => $nbPage,
    'message' => $message
]);