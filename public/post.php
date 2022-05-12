<?php
include 'session.php';

use App\Autoload;
use App\Core\Cnx;
use App\Model\CommentaireModel;
use App\Model\PostsModel;
use App\Model\UsersModel;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

define('ROOT', dirname(__DIR__));

require_once ROOT.'/public/Autoload.php';
require ROOT.'/vendor/autoload.php';

Autoload::register();

$loader = new FilesystemLoader(ROOT.'/templates');
$twig = new Environment($loader);

$model = new PostsModel;
$post = $model->readPost(filter_input(INPUT_GET, 'postId'));

$userModel = new UsersModel;
$users = $userModel->readAllUsers();

$commentModel = new CommentaireModel;
$commentaires = $commentModel->readAllClassed();

$count = Cnx::getInstance()->prepare("SELECT count(*) as pid FROM commentaire");
$count->setFetchMode(PDO::FETCH_ASSOC);
$count->execute();
$tcount = $count->fetchAll();

$perPage = 4;
$nbPage = ceil($tcount[0]["pid"] / $perPage);

echo $twig->render('users/post.html', [
    'post' => $post,
    'users' => $users,
    'commentaires' => $commentaires
]);