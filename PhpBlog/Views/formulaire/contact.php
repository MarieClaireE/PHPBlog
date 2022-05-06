<FORM method="POST" action="#">
    <div class="input-group px-2 mb-3">
        <span class="input-group-text" id="nom">
            <i class="fa fa-user"></i>
        </span>
        <input type="text" name="nom" class="form-control" aria-describedby="nom" required>
    </div>
    <div class="input-group px-2 mb-3">
        <span class="input-group-text" id="email">
            <i class="fa fa-at"></i>
        </span>
        <input type="text" name="email" class="form-control" aria-describedby="email" required>
    </div>
    <div class="input-group px-2 mb-3">
        <textarea name="message" cols=100 rows=5 class="form-control" required></textarea>   
    </div>
    <div class="input-group px-2 mb-3">
        <INPUT type="submit" value="Envoyer" name="envoyer" class="btn col-12 bg-yellow">
    </div>
</FORM>

<?php 
//Pour définir chaque input du formulaire, ajouter le signe de dollar devant
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
    echo "<H1 align=center>Merci, $nom </H1>";
    echo "<P align=center>";
    echo "Votre formulaire à bien été envoyé !</P>";
}


?>

