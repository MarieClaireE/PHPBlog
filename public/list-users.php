<?php
session_start();

use App\Autoload;
use App\Core\Cnx;
use App\Model\UsersModel;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


define('ROOT', dirname(__DIR__));

require ROOT.'/vendor/autoload.php';
require_once ROOT.'/public/Autoload.php';

Autoload::register();

$loader = new FilesystemLoader(ROOT.'/templates');
$twig = new Environment($loader);

$count = Cnx::getInstance()->prepare("SELECT count(*) as pid FROM users");
$count->setFetchMode(PDO::FETCH_ASSOC);
$count->execute();
$tcount = $count->fetchAll();

$perPage = 4;
$nbPage = ceil($tcount[0]["pid"] / $perPage);

$model = new UsersModel;
$users = $model->readClassed();

echo $twig->render('admin/list-users.html', [
    'nbPage' => $nbPage,
    'users' => $users
]);