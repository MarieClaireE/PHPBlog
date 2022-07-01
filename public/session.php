<?php

use App\Model\SessionManager;

require ROOT.'/public/Model/SessionManager.php';

$session = new SessionManager();
$emailSession = $session->get('email');
if (isset($emailSession)) {
    $id = $session->get('id');
    $nom = $session->get('nom');
    $email = $session->get('email');
    $prenom = $session->get('prenom');
    $mdp = $session->get('password');
} else {
    header('location: index.php');
}
