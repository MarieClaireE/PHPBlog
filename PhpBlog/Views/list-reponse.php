<?php
use App\Autoload;
use App\Model\CommentaireModel;
use App\Model\ReponseModel;
use App\Model\UsersModel;

require_once '../Autoload.php';
Autoload::register();

$model = new CommentaireModel;
$comment = $model->readId(filter_input(INPUT_GET, 'commentaireId'));
$userModel = new UsersModel;
$users = $userModel->readAllUsers();
$postId = $comment->getPostId(); 

?>
<!DOCTYPE html>
<html>
    <?php include 'include/header.html'; ?>
    <body>
        <?php include 'include/nav-internaute.html'; ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-3 mt-3 border-0">
                        <a href="post.php?postId=<?= $comment->getPostId();?>&page=1"><i class="fa fa-long-arrow-left"></i> Retour</a>
                    </div>
                    <div class="card mb-3 mt-3 border-0">
                        <?php include 'include/horloge.html'; ?>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4 mt-3">
                        <div class="card-header px-2 py-2">
                            <?php
                                foreach($users as $user)
                                {
                                    if ($user->getId() === $comment->getUsersId())
                                    {
                                    ?> 
                                        <i class="fa fa-user fa-2x"></i>
                                        <?= $user->getName(); ?> <?= $user->getPrenom(); ?>
                                    <?php
                                    }
                                }
                            ?>
                            <span class="float-end text-muted">
                                <?= date('d-m-Y', strtotime($comment->getAddedOn())); ?>
                            </span>
                        </div>
                        <div class="card-body">
                            <?= $comment->getContenu(); ?>
                        </div>
                        <div class="card-footer">
                             <?php include 'reponse.php'; ?>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <?php include 'include/footer.html'; ?>
    </body>
</html>