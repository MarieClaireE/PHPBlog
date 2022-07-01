<?php

use App\Autoload;
use App\Core\Cnx;
use App\Model\CommentaireModel;
use App\Model\ReponseModel;
use App\Model\UsersModel;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

define('ROOT', dirname(__DIR__));
require 'session.php';

require_once ROOT.'/public/Autoload.php';
require ROOT.'/vendor/autoload.php';

Autoload::register();

$loader = new FilesystemLoader(ROOT.'/templates');
$twig = new Environment($loader);

$commentModel = new CommentaireModel;
$comment = $commentModel->readId(filter_input(INPUT_GET, 'commentId'));
$reponseModel = new ReponseModel;
$reponses = $reponseModel->readClassed();
$userModel = new UsersModel;
$users = $userModel->readAllUsers();

$count = Cnx::getInstance()->prepare("SELECT count(*) as pid FROM reponse");
$count->setFetchMode(PDO::FETCH_ASSOC);
$count->execute();
$tcount = $count->fetchAll();

$perPage = 4;
$nbPage = ceil($tcount[0]["pid"] / $perPage);

if($reponses !== null) {
    $delete = filter_input(INPUT_POST, 'reset');
    if(isset($delete)) {
        $reponseModel->deleteReponse(filter_input(INPUT_POST, 'reponseId'));
    }
}

echo $twig->render('admin/list-reponses.html', [
    'comment' => $comment,
    'reponses' => $reponses,
    'nbPage' => $nbPage,
    'users' => $users
]);