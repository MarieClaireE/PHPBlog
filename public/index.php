<?php
// session_start();

use App\Model\SessionManager;
use App\Autoload;
use App\Core\Cnx;
use App\Model\Security;
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
$pass = filter_input(INPUT_POST, 'password');
$pass_hash = Security::hasher($pass);

if (isset($cnx_html)) {
    // si le mail et le mdp sont vides
    if (empty(filter_input(INPUT_POST, 'email')) || empty($pass)) {
        $message = 'Veuillez remplir tous les champs !! ';
    } else {
        $req = $model->cnxUser();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $count = $req->rowCount();
    }
    // si le couple pseudo password est trouvé
    if ($count > 0) {
        $session = new SessionManager();
        $session->set('email', filter_input(INPUT_POST, 'email'));

        $session->set('nom', $data['name']);
        $session->set('prenom', $data['prenom']);
        $session->set('password', $data['password']);
        $session->set('email', $data['email']);
        $session->set('id', $data['id']);

        if ($pass_hash == $data['password']) {
            $model->updateLastCnx(filter_input(INPUT_POST, 'lastCnx'), $data['id']);
            
            header('location: homePageUser.php');
        }
    
    } else {
        $error = 'Accès refusé';
    }
}

$message = '';
$error2 = '';
$inscription_html = filter_input(INPUT_POST, 'inscription');
$pass = filter_input(INPUT_POST, "password");

$pass_hash = Security::hasher($pass);

if (isset($inscription_html)) {
    $user = new Users();
    $user->setName(filter_input(INPUT_POST, 'name'));
    $user->setPrenom(filter_input(INPUT_POST, 'prenom'));
    $user->setEmail(filter_input(INPUT_POST, 'email'));
    $user->setPassword($pass_hash);
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