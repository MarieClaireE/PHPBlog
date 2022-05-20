<?php
include 'session.php';

use App\Autoload;
use App\Core\Cnx;
use App\Model\Commentaire;
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
$twig->getExtension(\Twig\Extension\CoreExtension::class)->setTimezone('Europe/Paris');


$model = new PostsModel;
$post = $model->readPost(filter_input(INPUT_GET, 'postId'));

$userModel = new UsersModel;
$users = $userModel->readAllUsers();

$commentModel = new CommentaireModel;
$commentaires = $commentModel->readAllClassedByPost($post->getId());

$count = Cnx::getInstance()->prepare("SELECT count(*) as pid FROM commentaire");
$count->setFetchMode(PDO::FETCH_ASSOC);
$count->execute();
$tcount = $count->fetchAll();

$perPage = 4;
$nbPage = ceil($tcount[0]["pid"] / $perPage);

$message = '';
$publier_html = filter_input(INPUT_POST, 'publier');
if(isset($publier_html))
{
    $comment = new Commentaire;
    $comment->setUsersId(filter_input(INPUT_POST, 'usersId'));
    $comment->setPostId((filter_input(INPUT_POST, 'postId')));
    $comment->setStatut(filter_input(INPUT_POST, 'statut'));
    $comment->setContenu(filter_input(INPUT_POST, 'comment'));
    $comment->setAddedOn(filter_input(INPUT_POST, 'addedOn'));

    $model = new CommentaireModel;
    $model->create($comment);
    $message = 'Commentaire est envoyé en vérification';
}
echo $twig->render('admin/post.html', [
    'post' => $post,
    'users' => $users,
    'commentaires' => $commentaires,
    'nbpage' => $nbPage,
    'id' => $id,
    'message' => $message
]);