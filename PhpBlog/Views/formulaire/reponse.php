<?php

use App\Model\Reponse;
use App\Model\ReponseModel;

?>
<form action="" method="post">
    <textarea name="contenu" id="contenu" cols="125" rows="10" class="control-form mb-4"></textarea>
    <input type="hidden" name="usersId" value=<?= $id; ?>>
    <input type="hidden" name="commentaireId" value=<?= filter_input(INPUT_GET, 'commentaireId'); ?>>
    <input type="hidden" name="addedOn" value=<?= date('Y-m-d'); ?>  class="form-control">
    <input type="hidden" name="statut" value=0  class="form-control">
    <input type="submit" name="repondre" value="Répondre" class="col-12 mb-2 bg-yellow btn ">
</form>
<?php
$repondre_html = filter_input(INPUT_POST, 'repondre');
if (isset($repondre_html)) {
    $reponse= new Reponse;
    $reponse->setContenu(filter_input(INPUT_POST, 'contenu'));
    $reponse->setCommentaireId(filter_input(INPUT_POST, 'commentaireId'));
    $reponse->setUsersId(filter_input(INPUT_POST, 'usersId'));
    $reponse->setAddedOn(filter_input(INPUT_POST, 'addedOn'));
    $reponse->setStatut(filter_input(INPUT_POST, 'statut'));


    $model = new ReponseModel;
    $model->create($reponse);
    print 'Réponse envoyée en vérification';
}
?>

