<?php

use App\Autoload;
use App\Model\PostsModel;
use App\Model\UsersModel;

include '../include/session.php';
require_once '../../Autoload.php';
Autoload::register();

$nbPage = 5;
$model = new PostsModel;
$modelUser = new UsersModel;

$post = $model->readPost(filter_input(INPUT_GET, 'postId'));
$users = $modelUser->readAllUsers();

?>
<!DOCTYPE html>
<html lang='fr'>
    <?php include '../include/header.html'; ?>
    <body>
        <?php include '../include/nav-users.html'; ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mt-3 border-0">
                        <a href="accueil.php"> 
                            <i class="fa fa-long-arrow-left"></i>
                             Retour
                         </a>
                    </div>
                    <div class="card mt-3 mb-4 border-0">
                        <?php include '../include/horloge.html'; ?>
                    </div>
                </div>
                <div class="col-lg-8 mt-3 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title h3">
                                <?= $post->getTitre(); ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-text text-muted" style="font-size:10px;">
                                <span class="badge bg-secondary" style="font-size:12px;">
                                     <?php
                                    if ($post->getType() == 0) {
                                        echo '<span class="badge bg-secondary">
                                        Web Design </span>';
                                    } else if ($post->getType() == 1) {
                                        echo '<span class="badge bg-secondary">HTML</span>';
                                    } else if ($post->getType() == 2) {
                                        echo '<span class="badge bg-secondary">JavaScript</span>';
                                    } else if ($post->getType() == 3) {
                                        echo '<span class="badge bg-secondary">CSS</span>';
                                    } else if ($post->getType() == 4) {
                                        echo '<span class="badge bg-secondary">PHP</span>';
                                    }
                                    ?>
                                </span>
                                <br>
                                    Posté par :
                                    <?php
                                        foreach ($users as $user) {
                                            if ($post->getUsersId() === $user->getId()) {
                                                echo $user->getName() . '&nbsp;';
                                                echo $user->getPrenom();
                                            }
                                        }
                                    ?> 
                                <span class="float-end">
                                    Ajouté le : <?= date('d-m-y', strtotime($post->getAddedOn())); ?><br>
                                    <?php
                                        if (null !== $post->getUpdatedOn()) {
                                           echo " Modifié le: " . date('d-m-y', strtotime($post->getUpdatedOn()));
                                        }
                                    ?>
                                </span>
                            </div>
                            <div class="card-img text-center">
                                <img src="<?= $post->getImage(); ?>" alt="" width="350px" >
                            </div>
                            <div class="card-text mt-3">
                                <div class="h4 text-muted">
                                    <?= $post->getChapo(); ?>
                                </div>
                                <div class="p">
                                    <?= $post->getContenu(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-4">
                    <?php include 'espace_commentaire.php'; ?>
                </div>
            </div>
        </div>
        <?php include '../include/footer.html'; ?>
    </body>
</html>