<?php

use App\Autoload;
use App\Core\Cnx;
use App\Model\UsersModel;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

define('ROOT', dirname(__DIR__));

require_once ROOT.'/public/Autoload.php';
require_once ROOT.'/vendor/autoload.php';

Autoload::register();

$loader = new FilesystemLoader(ROOT.'/templates');
$twig = new Environment($loader);

// variable utiliser pour afficher un message de succès ou d'erreur
$comm = '';
$btn = filter_input(INPUT_POST, 'btn_user_reset');
$email = filter_input(INPUT_POST, 'reset-Email');
// si le formulaire a été soumis
if (isset($btn)) {
    // si le formulaire est correctement remplit
    if(!empty($email)) {
        // on fait une requête pour savoir si l'adresse est associé à un compte
        $sql = Cnx::getInstance()->prepare('SELECT COUNT(*) AS nb FROM users WHERE email= ?');
        $sql->bindValue(1, filter_input(INPUT_POST, 'reset-Email'));
        $sql->execute();

        $ligne = $sql->fetch(PDO::FETCH_ASSOC);

        //Tester si l'adresse email est associé à un compte
        if (!empty($ligne) && $ligne['nb'] > 0) {
            // on génère un token
            $string = implode('', array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9')));
            $token = substr(str_shuffle($string), 0, 20);

            // on insère la date et le token dans la DB
            $sql = Cnx::getInstance()->prepare('UPDATE users SET password_recovery_asked_date = NOW(), password_recovery_token = ? WHERE email = ?');
            $sql->bindValue(1, $token);
            $sql->bindValue(2, $email);
            $sql->execute();

            // on prépare l'envoie du courriel
            $link = 'https://mon-phpblog.fr/up_password.php?token='.$token;
            $to = $email;
            $subject = 'Réinitialisation de votre mot de passe';
            $message = '<h1>Réinitialisation de votre mot de passe</h1><p>Pour réinitialiser votre mot de passe, veuillez suivre ce lien: <a href="'.$link.'">Modifier le mot de passe</a></p>';

            // on défini les entêtes requis
          	$Entetes = "MIME-Version: 1.0\r\n";
           	$Entetes .= "Content-type: text/html; charset=UTF-8\r\n";
            $Entetes .= "From: Mon PHPBlog < mcemma@mon-phpblog.fr >\r\n";
          	$Entetes .= 'Reply-To: Mon PHPBlog < mcemma@mon-phpblog.fr >';//de préférence une adresse avec le même domaine de là où, vous utilisez ce code, cela permet un envoie quasi certain jusqu'au destinataire


            // on envoie le courriel 

            $Sujet = $subject;
            $Message=$message;
            mail($to, $Sujet, nl2br($Message), $Entetes);
            $comm = 'Un courriel a été acheminé. Veuillez regarder votre boîte mail et suivre les instructions à l\'intérieur du courriel (pensez à verifier vos spams).';
        } else {
            // si elle n'est pas associée à un compte
            $comm ='Cette adresse email n\’existe pas dans nos bases';
        }
    } else {
        // si le formulaire n'est pas correctement rempli
        $comm = 'Veuillez entrer votre adresse email !';
    }
}


echo $twig->render('formulaire/pass_forgot.html', [
    'comm' => $comm
]);