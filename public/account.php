<?php
use App\Autoload;
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


$service = new UsersModel;
$user = $service->readUser($id);

$message = '';
$update_html = filter_input(INPUT_POST, 'update');

if (isset($update_html)) {
    $user->setId($id);
    $user->setName(filter_input(INPUT_POST, 'nom'));
    $user->setPrenom((filter_input(INPUT_POST, 'prenom')));
    $user->setPassword(filter_input(INPUT_POST, 'password'));
    $user->setEmail(filter_input(INPUT_POST, 'email'));

    $service->updateUser($user);

    header('Location:connexion-admin.php');
}
echo $twig->render('users/account.html', [
    'nom' => $nom,
    'id' => $id,
    'prenom' => $prenom,
    'pass' => $mdp,
    'email' => $email,
]);