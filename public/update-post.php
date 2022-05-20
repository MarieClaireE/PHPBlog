<?php
require 'session.php';

use App\Autoload;
use App\Core\Cnx;
use App\Model\Commentaire;
use App\Model\CommentaireModel;
use App\Model\PostsModel;
use App\Model\Reponse;
use App\Model\ReponseModel;
use App\Model\UsersModel;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

define('ROOT', dirname(__DIR__));

require_once ROOT.'/vendor/autoload.php';
require ROOT.'/public/Autoload.php';

Autoload::register();

$loader = new FilesystemLoader(ROOT.'/templates');
$twig = new Environment($loader);

$postId = filter_input(INPUT_GET, 'postId');
$postModel = new PostsModel;
$post = $postModel->readPost($postId);

$update_html = filter_input(INPUT_POST, 'update');

if (isset($update_html)) {
    $post->setId($postId);
    $post->setTitre(filter_input(INPUT_POST, 'titre'));
    $post->setChapo(filter_input(INPUT_POST, 'chapo'));
    $post->setImage(filter_input(INPUT_POST, 'image'));
    $post->setContenu(filter_input(INPUT_POST, 'contenu'));
    $post->setType(filter_input(INPUT_POST, 'type'));
    $post->setUpdatedOn(filter_input(INPUT_POST, 'updatedOn'));

    $postModel->update($post);
}

$commentmodel = new CommentaireModel;
$comments = $commentmodel->readAllClassedByPost($postId);
$usersModel = new UsersModel;
$users = $usersModel->readAllUsers();
$reponseModel = new ReponseModel;
if (null !== $comments) {
    foreach ($comments as $comment) {
        $reponses = $reponseModel->readId($comment->getId());
    }
}

$count = Cnx::getInstance()->prepare("SELECT count(*) as pid FROM commentaire");
$count->setFetchMode(PDO::FETCH_ASSOC);
$count->execute();
$tcount = $count->fetchAll();

$perPage = 4;
$nbPage = ceil($tcount[0]["pid"] / $perPage);


echo $twig->render('admin/up-post.html', [
    'post' => $post,
    'nbPage' => $nbPage,
    'comments' => $comments,
    'users' => $users
]);

