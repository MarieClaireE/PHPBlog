<?php
session_start();

use App\Autoload;
use App\Model\UsersModel;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

define('ROOT', dirname(__DIR__));

require_once ROOT.'/public/Autoload.php';
require ROOT.'/vendor/autoload.php';

Autoload::register();

$loader = new FilesystemLoader(ROOT.'/templates');
$twig = new Environment($loader);


$model = new UsersModel;
$cnx_html = filter_input(INPUT_POST, 'connexion');
$data = [];
if (isset($cnx_html)) {
    // si le mail et le mdp sont vides
    if (empty(filter_input(INPUT_POST, 'email')) || empty(filter_input(INPUT_POST, 'password'))) {
        $message = 'Veuillez remplir tous les champs !! ';
    } else {
        $req = $model->cnxUser(filter_input(INPUT_POST, 'email'), filter_input(INPUT_POST, 'password'));
        $count = $req->rowCount();
    }
    // si le couple pseudo password est trouvé
    if ($count > 0) {
        $_SESSION['email'] = filter_input(INPUT_POST, 'email');

        $data = $req->fetch(PDO::FETCH_ASSOC);
        $_SESSION['nom'] = $data['name'];
        $_SESSION['prenom'] = $data['prenom'];
        $_SESSION['password'] = $data['password'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['id'] = $data['id'];

        $model->updateLastCnx(filter_input(INPUT_POST, 'lastCnx'), $data['id']);
        
        header('location: homePageUser.php');
    
    } else {
        print 'Accès refusé';
    }
}

echo $twig->render('homePage.html');