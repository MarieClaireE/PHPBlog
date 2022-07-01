<?php
use App\Autoload;
use App\Core\Cnx;
use App\Model\CommentaireModel;
use App\Model\ReponseModel;
use App\Model\UsersModel;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

define('ROOT', dirname(__DIR__));
require 'session.php';

require_once ROOT.'/public/Autoload.php';
require ROOT.'/vendor/autoload.php';

Autoload::register();

$model = new CommentaireModel;
$commentaires = $model->readAllClassed();

$reponseModel = new ReponseModel;
$reponses = $reponseModel->readAll();

$userModel = neW UsersModel;
$users = $userModel->readAllUsers();

$loader = new FilesystemLoader(ROOT.'/templates');
$twig = new Environment($loader);

$count = Cnx::getInstance()->prepare("SELECT count(*) as pid FROM commentaire");
$count->setFetchMode(PDO::FETCH_ASSOC);
$count->execute();
$tcount = $count->fetchAll();

$perPage = 4;
$nbPage = ceil($tcount[0]["pid"] / $perPage);

if($commentaires !== null) {
    $delete = filter_input(INPUT_POST, 'reset');
    if(isset($delete)) {
        if (null !== $reponses) {
            foreach($reponses as $reponse) {
                $model->delete(filter_input(INPUT_POST, 'commentaireId'), $reponse);
            }
        } else {
            $model->deleteComment(filter_input(INPUT_POST, 'commentaireId'));
        } 
    }
    $poster = filter_input(INPUT_POST, 'poster');
    if(isset($poster)) { 
        $model->update(filter_input(INPUT_POST, 'commentaireId'));   
    }       
  }    

echo $twig->render('admin/verif-commentaire.html', [
    'nbPage' => $nbPage,
    'commentaires' => $commentaires,
    'users' => $users
    
]);