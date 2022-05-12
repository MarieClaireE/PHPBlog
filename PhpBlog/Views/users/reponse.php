<?php
use app\Autoload;
use App\Core\Cnx;
use App\Model\ReponseModel;

require_once '../../Autoload.php';
Autoload::register();

$model = new ReponseModel;
$reponses = $model->readAllClassed();

$count = Cnx::getInstance()->prepare("SELECT count(*) as pid FROM reponse");
$count->setFetchMode(PDO::FETCH_ASSOC);
$count->execute();
$tcount = $count->fetchAll();


$perPage = 4;
$nbPage = ceil($tcount[0]["pid"] / $perPage);

if (null !== $reponses ) {
?>

<div class="card my-3 px-2 py-2">
    <?php 
    foreach ($reponses as $reponse)
    {
        if ($comment->getId() == $reponse->getCommentaireId()) {
            var_dump($comment->getId(), $reponse->getCommentaireId());
            if ($reponse->getStatut() === 1) {
                ?>
                <div class="card py-2 my-2">
                    <div class="card-header text-muted py-1 px-2">
                        <?php
                        foreach ($users as $user) {
                            if ($user->getId() === $reponse->getUsersId()) {
                                ?>
                                <i class="fa fa-user fa-2x"></i>
                                <?= $user->getName(); ?> <?= $user->getPrenom() ;?>
                                <?php
                            }
                        }
                        ?>
                        <span class="float-end">
                            <i class="fa fa-calendar"></i>
                            <?= date('d-m-Y', strtotime($reponse->getAddedOn())); ?>
                        </span>
                    </div>
                    <div class="card-body">
                        <?= $reponse->getContenu();?>
                    </div>
                </div>
                <?php
            }
        }
    }    
    ?>  
</div>
<?php
    for ($i=1; $i <= $nbPage; $i++) {
        $commentaireId = $comment->getId();
        print "<a class='btn page-btn border mb-2 mt-2 text-center' href='?commentaireId=$commentaireId&page=$i'> $i </a> &nbsp";
        }  
} else
{
    print '<p class="text-warning">
    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
    Aucune réponse pour ce commentaire
    </p>';
}
?>