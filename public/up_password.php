<?php

use App\Autoload;
use App\Core\Cnx;
use App\Model\Security;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

define('ROOT', dirname(__DIR__));

require_once ROOT.'/public/Autoload.php';
require_once ROOT.'/vendor/autoload.php';

Autoload::register();

$loader = new FilesystemLoader(ROOT.'/templates');
$twig = new Environment($loader);

// variable utilisé pour afficher une notification d'erreur ou de succès
$message = '';

// si aucun token n'est spécifé en paramètre de l'url
$token = filter_input(INPUT_GET, 'token');
if (empty($token)) {
    echo 'Aucun token n\'a été spécifié';
    exit;
}

// on récupère les informations par rapport au token dans la base de données
$sql = Cnx::getInstance()->prepare("SELECT password_recovery_asked_date FROM users WHERE password_recovery_token = ?");
$sql->bindValue(1, $token);
$sql->execute();
$row = $sql->fetch(PDO::FETCH_ASSOC);
if(empty($row)) // si aucune info associée au token n'est trouvé
{
    echo 'Token expiré !';
    exit;
}

// si le formulaire a été soumis
$btn_changePass = filter_input(INPUT_POST, 'btn_user_ChangePassword');
$password = filter_input(INPUT_POST, 'user-ChangePassword');
$passwordConfirm = filter_input(INPUT_POST, 'user-ChangePasswordConfirm');

if (isset($btn_changePass)) {
    // si le formulaire est correctmen remplit
    if (!empty($password) && !empty($passwordConfirm)) {
        // si les deux mots de passes sont les mêmes
        if ($password === $passwordConfirm) {
            // on hash le password
            $pass_hash = Security::hasher($password);
            // on modifie les informations dans la base de données
            $req = 'UPDATE users SET password=?, password_recovery_token= "" WHERE password_recovery_token = ?';
            $query = Cnx::getInstance()->prepare($req);
            // echo $req.'*********'.$pass_hash.'*********'.$token;
            $query->bindValue(1, $pass_hash);
            $query->bindValue(2, $token);
            $query->execute();
            $message="Le mot de passe a été changé";
            // si les deux mots de passe ne sont pas identiques 
        } else {
            $message="Les deux mots de passes ne sont pas identiques";
        }
    } else {
        $message = "Veuillez remplir tous les champs du formulaire SVP!";
    }
}


echo $twig->render('formulaire/up_password.html', [
    'message' => $message
]);