<?php

use App\Autoload;
use App\Core\Cnx;
use App\Model\PostsModel;
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

$postModel = new PostsModel;
$posts = $postModel->readAllPostClassed();

$usersModel = new UsersModel;
$users = $usersModel->readAllUsers();


$count = Cnx::getInstance()->prepare("SELECT count(*) as pid FROM post");
$count->setFetchMode(PDO::FETCH_ASSOC);
$count->execute();
$tcount = $count->fetchAll();

$perPage = 4;
$nbPage = ceil($tcount[0]["pid"] / $perPage);



echo $twig->render('admin/post-management.html', [
    'id' => $id,
    'users' => $users,
    'posts' => $posts,
    'nbPage' => $nbPage,
    // 'message' => $message
]);