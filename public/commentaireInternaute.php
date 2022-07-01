<?php
use App\Autoload;
use App\Core\Cnx;
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
$reponses = $modelReponse->readAllClassed($comment->getId());

$count = Cnx::getInstance()->prepare("SELECT count(*) as pid FROM commentaire");
$count->setFetchMode(PDO::FETCH_ASSOC);
$count->execute();
$tcount = $count->fetchAll();

$perPage = 4;
$nbPage = ceil($tcount[0]["pid"] / $perPage);

echo $twig->render('internaute/commentaire.html', [
    'comment' => $comment,
    'users' => $users,
    'reponses' => $reponses,
    'nbPage' => htmlspecialchars($nbPage)
]);