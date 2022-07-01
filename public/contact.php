<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

define('ROOT', dirname(__DIR__));

require ROOT.'/vendor/autoload.php';

$loader = new FilesystemLoader(ROOT.'/templates');
$twig = new Environment($loader);

$message = "";
$nom = filter_input(INPUT_POST, "nom");
$email = filter_input(INPUT_POST, "email");
$sujet = filter_input(INPUT_POST, "sujet");
$contenu = filter_input(INPUT_POST, "message");
$envoyer = filter_input(INPUT_POST, 'envoyer');
/* Page: contact.php */
//mettez ici votre adresse mail
$VotreAdresseMail="mcemma@mon-phpblog.fr";
// si le bouton "Envoyer" est cliqué
if(isset($envoyer)) {
    //on vérifie que le champ mail est correctement rempli
    if(empty($email)) {
        echo "Le champ mail est vide";
    } else {
        //on vérifie que l'adresse est correcte
        if(!preg_match("#^[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?@[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?\.[a-z]{2,}$#i",$email)){
            echo "L'adresse mail entrée est incorrecte";
        }else{
            //on vérifie que le champ sujet est correctement rempli
            if(empty($sujet)) {
                $message = "Le champ sujet est vide";
            }else{
                //on vérifie que le champ message n'est pas vide
                if(empty($contenu)) {
                    $message = "Le champ message est vide";
                }else{
                    //tout est correctement renseigné, on envoi le mail
                    //on renseigne les entêtes de la fonction mail de PHP
                    $Entetes = "MIME-Version: 1.0\r\n";
                    $Entetes .= "Content-type: text/html; charset=UTF-8\r\n";
                    $Entetes .= "From: Nom de votre site <$email>\r\n";//de préférence une adresse avec le même domaine de là où, vous utilisez ce code, cela permet un envoie quasi certain jusqu'au destinataire
                    $Entetes .= "Reply-To: Nom de votre site <$email>\r\n";
                    //on prépare les champs:
                    $Sujet='=?UTF-8?B?'.base64_encode($sujet).'?=';//Cet encodage (base64_encode) est fait pour permettre aux informations binaires d'être manipulées par les systèmes qui ne gèrent pas correctement les 8 bits (=?UTF-8?B? est une norme afin de transmettre correctement les caractères de la chaine)
                    $contenu=htmlentities($contenu,ENT_QUOTES,"UTF-8");//htmlentities() converti tous les accents en entités HTML, ENT_QUOTES Convertit en + les guillemets doubles et les guillemets simples, en entités HTML
                    //en fin, on envoi le mail
                    if(mail($VotreAdresseMail,$Sujet,nl2br($contenu),$Entetes)){//la fonction nl2br permet de conserver les sauts de ligne et la fonction base64_encode de conserver les accents dans le titre
                        $message =  "Le mail à été envoyé avec succès!";
                    } else {
                        $message =  "Une erreur est survenue, le mail n'a pas été envoyé";
                    }
                }
            }
        }
    }
}

echo $twig->render('internaute/contact.html',[
    'message' => $message
]);

