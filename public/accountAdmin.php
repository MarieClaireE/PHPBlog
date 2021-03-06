<?php

use App\Autoload;
use App\Model\Security;
use App\Model\Users;
use App\Model\UsersModel;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

define('ROOT', dirname(__DIR__));
include 'session.php';


require_once ROOT.'/public/Autoload.php';
require ROOT.'/vendor/autoload.php';

Autoload::register();

$loader = new FilesystemLoader(ROOT.'/templates');
$twig = new Environment($loader);


$service = new UsersModel;
$user = $service->readUser($id);

$message = '';
$update_html = filter_input(INPUT_POST, 'update');
$pass = filter_input(INPUT_POST, 'password');
$pass_hash = Security::hasher($pass);
if (isset($update_html)) {
    $user->setId($id);
    $user->setName(filter_input(INPUT_POST, 'nom'));
    $user->setPrenom((filter_input(INPUT_POST, 'prenom')));
    $user->setPassword($pass);
    $user->setEmail(filter_input(INPUT_POST, 'email'));

    $service->updateUser($user);

    header('Location:connexion-admin.php');
}


echo $twig->render('admin/account.html', [
    'id' => htmlspecialchars($id),
    'nom' => htmlspecialchars($nom),
    'prenom' => htmlspecialchars($prenom),
    'email' => htmlspecialchars($email),
    'pass' => ($mdp),
]);