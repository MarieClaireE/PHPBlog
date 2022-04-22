<?php
require('include/loadFile.php');
use \include\class\Posts;

$post_html = filter_input(INPUT_GET, 'postId', FILTER_VALIDATE_INT);

$service = new PostService($cnx);
$post = $service->readPost($post_html);

?>
<!DOCTYPE html>
<html lang="fr">
    <!-- header -->
    <?php include('include/head.php'); ?>
    <body>
        <!-- nav -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">PHP Blog</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="../homePage-admin.php">Blog</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                Notifications
                            </a>
    
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                Gestion des posts
                            </a>
    
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="addPost.php">Ajout</a></li>
                                <li><a class="dropdown-item" href="postManagement.php">Modifier / Supprimer </a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#!">Mon Compte</a></li>
                        <li class="nav-item"><a class="nav-link" href="../deconnexion.php">Déconnexion</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- page content -->
        <div class="container mt-2">
            <div class="row">
                <!-- horloge -->
                <div class="col-lg-4 mt-2">
                    <div class="card boder-0 mb-2">
                        <a href="../homePage-admin.php" class="btn btn-danger">
                            <i class="fa-solid fa-arrow-left-long"></i>
                            Retour
                        </a>
                    </div>
                    <?php include'../../include/include/horloge.php';?>
                </div>
                <!-- current page -->
                <div class="col-lg-8">
                    <div class="card mb-2 mt-2">
                        <div class="card-header">
                            <div class="h3 text-muted">
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
                                <span class="float-end">
                                    Posté par :
                                    <?php
                                    if ($post->getUsersId() === $id) {
                                        echo $nom . '&nbsp;';
                                        echo $prenom;
                                    }
                                    ?>
                                    <br>
                                    Ajouté le : <?= date('d-m-y', strtotime($post->getAddedOn())); ?><br>
                                    <?php
                                        if (null !== $post->getUpdateOn()) {
                                           echo " Modifié le: " . date('d-m-y', strtotime($post->getUpdateOn()));
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
            </div>
            <div class="col-12 mt-3 mb-3 bg-light ">
                PARTIE COMMENTAIRE

            </div>
        </div>
        <!-- footer -->
        <?php include('../../include/include/footer.php');?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../../dist/js/scripts.js"></script>
    </body>
</html>