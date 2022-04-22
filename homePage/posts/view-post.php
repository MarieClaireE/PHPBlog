<?php
require'../include/include/cnx.php';
include'../include/class/Posts.php';
include'../include/service/PostService.php';

$id_url = filter_input(INPUT_GET, 'postId');

$service = new PostService($cnx);
$post = $service->readPost($id_url);
// $serviceUsers = new UsersService($cnx);
// $users = $serviceUsers->readAllUsers();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?= $post->getTitre(); ?></title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="../dist/assets/favicon-internet.png" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../dist/css/styles.css" rel="stylesheet" />
         <!-- Font Awesome icons (free version)-->
        <script src="https://kit.fontawesome.com/96ee82b9ac.js" crossorigin="anonymous"></script>
    </head>
    <body>
         <!-- Responsive navbar-->
         <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">PHP Blog</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="../index.php">Accueil</a></li>
                        <!-- <li class="nav-item"><a class="nav-link" href="#!">À propos de moi</a></li> -->
                        <li class="nav-item"><a class="nav-link" href="#!">Me contacter</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Blog</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- current page -->
        <div class="container mt-3">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card boder-0 mb-2">
                        <a href="blog.php" class="btn btn-danger">
                            <i class="fa-solid fa-arrow-left-long"></i>
                            Retour
                        </a>
                    </div>
                    <!-- horloge -->
                    <?php include'../include/include/horloge.php'; ?>
                </div>
                <div class="col-lg-8">
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
                                <!-- Posté par :
                                    <?php
                                    // foreach ($users as $user) {
                                    //     if ($post->getUsersId() === $user->getId()) {
                                    //         echo $user->getNom() . '&nbsp;';
                                    //         echo $user->getPrenom();
                                    //     }
                                    // }
                                    ?> -->
                                <span class="float-end">
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
            <div class="col-12 bg-light mt-3 mb-3">
                Espace Commentaire
            </div>
        </div>
        <!-- footer -->
        <?php include'../include/include/footer.php';?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../dist/js/scripts.js"></script>
    </body>
</html>