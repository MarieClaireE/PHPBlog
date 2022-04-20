<?php
require('../../include/include/sessionAdmin.php');
require('../../include/include/cnx.php');
include('../../include/class/Posts.php');
include('../../include/service/PostService.php');
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Blog Home - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="../../dist/assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../../dist/css/styles.css" rel="stylesheet" />
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
                                <li><a class="dropdown-item" href="#">Ajout</a></li>
                                <li><a class="dropdown-item" href="postManagement.php">Modifier / Supprimer </a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#!">Mon Compte</a></li>
                        <li class="nav-item"><a class="nav-link" href="../deconnexion.php">Déconnexion</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page header with logo and tagline-->
        <header class="py-5 bg-light border-bottom mb-4 header-page-users">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Ajouter un Post</h1>
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                 <!-- Side widgets-->
                 <div class="col-lg-4">
                    <!-- horloge widget-->
                    <?php include('../../include/include/horloge.php') ;?>
                </div>
                <!-- Blog entries-->
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <form action="" method="post">
                            <div class="input-group mt-2 px-2">
                                <span class="input-group-text font-weight-bold py-2" id="added-1">
                                    H1
                                </span>
                                <input type="text" name="titre" placeholder="Titre" aria-describedby="added-1" class="form-control" required>
                            </div>
                            <div class="input-group px-2 mt-2">
                                <textarea name="chapo" id="chapo" cols="30" rows="5" placeholder="Chapô" class="form-control" required></textarea>
                            </div>
                            <div class="input-group mt-2 px-2">
                                <span class="input-group-text" id="added-2">
                                    <i class="fa-solid fa-image"></i>
                                </span>
                                <input type="text" name="image" placeholder="Image" aria-describedby="added-2" class="form-control">
                            </div>
                            <div class="input-group px-2 mt-2">
                                <textarea name="contenu" id="contenu" cols="30" rows="10" placeholder="Contenu" class="form-control" required></textarea>
                            </div>
                            <div class="input-group px-2 mt-2">
                                <select name="type" id="type" class="form-control">
                                   <option value="0">Web design</option>
                                   <option value="1">HTLM</option>
                                   <option value="2">JavaScript</option>
                                   <option value="3">CSS</option>
                                   <option value="4">PHP</option>
                                </select>
                            </div>
                            <input type="hidden" value="<?= date('Y-m-d'); ?>" name="addedOn">
                            <input type="hidden" value="<?= $id; ?>" name="usersId">
                            <div class="input-group mb-2 mt-2 ms-5 col-10">
                                <input type="submit" class="btn btn-info" name="ajouter" value="Ajouter">
                            </div>
                        </form>
                    </div>
                </div>
               
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright &copy; PHP Blog</p>
                <p class="m-0 text-center text-white">version 0.1</p>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../../dist/js/scripts.js"></script>
    </body>
</html>

<?php
if (isset($_POST['ajouter'])) {
    $post = new Posts();

    $post->setTitre($_POST['titre']);
    $post->setChapo($_POST['chapo']);

    if (empty($_POST['image'])) {
        $_POST['image'] = 'https://pbs.twimg.com/media/D-lInYQXsAEnXKt.jpg';
    }
    $post->setImage($_POST['image']);

    $post->setContenu($_POST['contenu']);
    $post->setUsersId($_POST['usersId']);
    $post->setAddedOn($_POST['addedOn']);
    $post->setType($_POST['type']);

    $service = new PostService($cnx);
    $service->createPost($post);
}
