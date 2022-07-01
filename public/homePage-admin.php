<?php

use App\Autoload;
use App\Core\Cnx;
use App\Model\PostsModel;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

define('ROOT', dirname(__DIR__));
require 'session.php';

require_once ROOT.'/public/Autoload.php';
require ROOT.'/vendor/autoload.php';

Autoload::register();

$loader = new FilesystemLoader(ROOT.'/templates');
$twig = new Environment($loader);

$model = new PostsModel;
$posts = $model->readAllPostClassed();

$count = Cnx::getInstance()->prepare("SELECT count(*) as pid FROM post");
$count->setFetchMode(PDO::FETCH_ASSOC);
$count->execute();
$tcount = $count->fetchAll();

$perPage = 4;
$nbPage = ceil($tcount[0]["pid"] / $perPage);

$html_web_design = filter_input(INPUT_POST, '0');
$html_html = filter_input(INPUT_POST, '1');
$html_js = filter_input(INPUT_POST, '2');
$html_css = filter_input(INPUT_POST, '3');
$html_php = filter_input(INPUT_POST, '4');

if (isset($html_web_design)) {
    $model->searchBy(filter_input(INPUT_POST, '0'));
}
echo $twig->render('admin/homePage.html', [
    'id' => htmlspecialchars($id),
    'nom' => htmlspecialchars($nom),
    'prenom' => htmlspecialchars($prenom),
    'email' => htmlspecialchars($email),
    'pass' => htmlspecialchars($mdp),
    'posts' => $posts,
    'nbpage' => $nbPage
]);

