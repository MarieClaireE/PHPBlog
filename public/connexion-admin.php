<?php
// session_start();

use App\Autoload;
use App\Model\Security;
use App\Model\SessionManager;
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

$error = '';
$error1 = '';
$cnx_html = filter_input(INPUT_POST, 'connexion');
$pass = filter_input(INPUT_POST, "password");
$pass_hash = Security::hasher($pass);

if (isset($cnx_html)) {
    if (empty(filter_input(INPUT_POST, 'email')) || empty($pass)) {
        $error1 = 'Veuillez remplir tous les champs !! ';
    } else {
        $req = $model->cnxAdmin();
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

            $service = new UsersModel;
            $service->updateLastCnx(filter_input(INPUT_POST, 'lastCnx'), $data['id']);
    
            header('location: homePage-admin.php');
        }
    } else {
        $error = 'Accès refusé';
    }
}

echo $twig->render('admin/connexion.html', [
    'error' => $error,
    'error1' => $error1
]);