<?php

use App\Core\Cnx;
use App\Model\Commentaire;
use App\Model\CommentaireModel;
use App\Model\UsersModel;

$model = new CommentaireModel;
$comments = $model->readOne(filter_input(INPUT_GET, 'postId'));

$modelUser = new UsersModel;
$users = $modelUser->readAllUsers();

$count = Cnx::getInstance()->prepare("SELECT count(*) as cid FROM commentaire");
$count->setFetchMode(PDO::FETCH_ASSOC);
$count->execute();
$tcount = $count->fetchAll();
$perPage = 4;
$nbPage = ceil($tcount[0]["cid"] / $perPage);

?>

<div class="card-body">
    <?php
    if (null !== $comments)
    {
        foreach ($comments as $comment) {
        ?>
            <div class="card px-2 mb-4">
                <div class="card-title border-bottom px-2 py-1">
                    <?php
                    foreach ($users as $user) {
                        if ($comment->getUsersId() === $user->getId()) {
                            ?>
                            <i class="fa fa-user fa-2x"></i>
                            &nbsp; 
                            <?= $user->getName(); ?> <?= $user->getPrenom(); ?>
                            <span class="float-end text-muted"> <i class="fa fa-calendar"></i>
                                <?= date('d-m-Y', strtotime($comment->getAddedOn())) ;?></span>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        <?= $comment->getContenu(); ?>
                    </p>
                </div>
                <div class="card-footer">
                    <a href="list-reponse.php?commentaireId=<?=$comment->getId(); ?>">Voir les réponses</a>
                </div>
            </div>
        <?php
        }
    }
    ?>
    <nav aria-label="Pagination" class="row"> 
        <hr class="my-0" />
        <div class="col-3 mx-auto">
            <?php

            for ($i=1; $i <= $nbPage; $i++) {
                $postId = $post->getId();
                echo "<a class='btn page-btn border mb-2 mt-2' href='?postId=$postId&page=$i'> $i </a> &nbsp";
            }    
            ?>
        </div>
    </nav> 
   
    
