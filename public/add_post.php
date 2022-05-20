<?php
require 'session.php';

use App\Autoload;
use App\Model\Posts;
use App\Model\PostsModel;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

define('ROOT', dirname(__DIR__));

require_once ROOT.'/public/Autoload.php';
require ROOT.'/vendor/autoload.php';

Autoload::register();

$loader = new FilesystemLoader(ROOT.'/templates');
$twig = new Environment($loader);

$add_html = filter_input(INPUT_POST, 'ajouter');
$image_html = filter_input(INPUT_POST, 'image');
$message = '';

if(isset($add_html)) {
    $post = new Posts;

    $post->setTitre(filter_input(INPUT_POST, 'titre'));
    $post->setChapo(filter_input(INPUT_POST, 'chapo'));
    if(empty($image_html)) {
        $image_html = 'https://pbs.twimg.com/media/D-lInYQXsAEnXKt.jpg';
    }
    $post->setImage(filter_input(INPUT_POST, $image_html));
    $post->setContenu(filter_input(INPUT_POST, 'contenu'));
    $post->setUsersId(filter_input(INPUT_POST, 'usersId'));
    $post->setAddedOn(filter_input(INPUT_POST, 'addedOn'));
    $post->setType(filter_input(INPUT_POST, 'type'));

    $model = new PostsModel;
    $model->create($post);
    $message = 'Post crée avec succès!';
}

echo $twig->render('admin/add_post.html', [
    'id' => $id,
    'message' => $message
]);