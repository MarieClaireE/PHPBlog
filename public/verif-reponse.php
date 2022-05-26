<?php
require 'session.php';


use App\Autoload;
use App\Core\Cnx;
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

$count = Cnx::getInstance()->prepare("SELECT count(*) as pid FROM commentaire");
$count->setFetchMode(PDO::FETCH_ASSOC);
$count->execute();
$tcount = $count->fetchAll();

$perPage = 4;
$nbPage = ceil($tcount[0]["pid"] / $perPage);

$modelReponse = new ReponseModel;
$reponses = $modelReponse->readClassed();

$model = new UsersModel;
$users = $model->readAllUsers();

if($reponses !== null) {
    $delete = filter_input(INPUT_POST, 'reset');
    if(isset($delete)) {
        $modelReponse->deleteReponse(filter_input(INPUT_POST, 'reponseId'));
    }
    $poster = filter_input(INPUT_POST, 'poster');
    if(isset($poster)) {
        $modelReponse->update(filter_input(INPUT_POST, 'reponseId'));
    }       
}

echo $twig->render('admin/verif-reponse.html', [
    'nbPage' => $nbPage,
    'reponses' =>$reponses,
    'users' => $users
]);