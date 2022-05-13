<?php
session_start();

use App\Autoload;
use App\Model\Users;
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
$error = '';
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
        $error = 'Accès refusé';
    }
}

$message = '';
$error2 = '';
$inscription_html = filter_input(INPUT_POST, 'inscription');
if (isset($inscription_html)) {
    $user = new Users();
    $user->setName(filter_input(INPUT_POST, 'name'));
    $user->setPrenom(filter_input(INPUT_POST, 'prenom'));
    $user->setEmail(filter_input(INPUT_POST, 'email'));
    $user->setPassword(filter_input(INPUT_POST, 'password'));
    $user->setStatut(filter_input(INPUT_POST, 'statut'));
    $user->setFirstCnx(filter_input(INPUT_POST, 'firstCnx'));
    
    if (filter_input(INPUT_POST, 'password') === filter_input(INPUT_POST, 'password2')){
        $model->createUser($user);
        $message = 'Vous êtes inscrit, connectez vous pour accéder à votre espace personnel';
    } else {
        $error2 = 'Les mots de passes sont différents';
    }
}

echo $twig->render('homePage.html', [
    'error' => $error,
    'error2' => $error2,
    'message' => $message
]);