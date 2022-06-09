<?php

use App\Autoload;
use App\Core\Cnx;
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
$posts = $model->readAllPost();

$count = Cnx::getInstance()->prepare("SELECT count(*) as pid FROM post");
$count->setFetchMode(PDO::FETCH_ASSOC);
$count->execute();
$tcount = $count->fetchAll();

$perPage = 4;
$nbPage = ceil($tcount[0]["pid"] / $perPage);



echo $twig->render('internaute/list-posts.html', [
    'nbpage' => $nbPage,
    'posts' => $posts
]);