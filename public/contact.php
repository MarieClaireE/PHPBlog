<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

define('ROOT', dirname(__DIR__));

require ROOT.'/vendor/autoload.php';

$loader = new FilesystemLoader(ROOT.'/templates');
$twig = new Environment($loader);

$nom = filter_input(INPUT_POST, "nom");
$email = filter_input(INPUT_POST, "email");
$message = filter_input(INPUT_POST, "message");

$msg = "Nom:\t$nom\n";
$msg .= "E-Mail:\t$email\n";
$msg .= "Message:\t$message\n\n";
//Pourait continuer ainsi jusqu'à la fin du formulaire

$recipient = "mcemma.974@gmail.com";
$subject = "Formulaire";

$mailheaders = "From: Mon test de formulaire<> \n";
$mailheaders .= "Reply-To: $email\n\n";

mail($recipient, $subject, $msg, $mailheaders);

if (isset($_POST['envoyer'])) {
    print "<H1 align=center>Merci, $nom </H1>";
    print "<P align=center>";
    print "Votre formulaire à bien été envoyé !</P>";
}

echo $twig->render('internaute/contact.html');

