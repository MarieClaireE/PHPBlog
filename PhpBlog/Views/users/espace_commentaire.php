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

<div class="card px-2">
    <div class="card-title h2 text-muted">
        Espace commentaire
    </div>
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
    </div>
    <div class="card-body">
        <form action="" method="post" id="commentForm">
            <textarea name="comment" id="comment" cols="30" rows="10" class="form-control"></textarea>
            <input type="hidden" name="postId" value=<?= $post->getId(); ?>>
            <input type="hidden" name="usersId" value=<?= $id; ?>  class="form-control">
            <input type="hidden" name="addedOn" value=<?= date('Y-m-d'); ?>  class="form-control">
            <input type="hidden" name="statut" value="1">
            <input type="submit" name="publier" value="Publier" class="btn bg-yellow w-100 mb-2 mt-2">
        </form>
        <?php
        $publier_html = filter_input(INPUT_POST, 'publier');
        if (isset($publier_html)) {
            $comment = new Commentaire;
            $comment->setUsersId(filter_input(INPUT_POST, 'usersId'));
            $comment->setPostId((filter_input(INPUT_POST, 'postId')));
            $comment->setStatut(filter_input(INPUT_POST, 'statut'));
            $comment->setContenu(filter_input(INPUT_POST, 'comment'));
            $comment->setAddedOn(filter_input(INPUT_POST, 'addedOn'));

            $model = new CommentaireModel;
            $model->create($comment);
            echo 'Commentaire est envoyé en vérification';
        }
        ?>
    </div>
</div>