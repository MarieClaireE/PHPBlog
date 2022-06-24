<?php
require'include/loadFile.php';   
use \include\class\Posts; 
?>

<!DOCTYPE html>
<html lang="fr">
    <?php include'include/head.php';?>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">PHP Blog</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="../homePage-admin.php">Blog</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                Notifications
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle active" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
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
                    <?php include'../../include/include/horloge.php' ;?>
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
                            <input type="hidden" value=<?= date('Y-m-d'); ?> name="addedOn">
                            <input type="hidden" value=<?= $id; ?> name="usersId">
                            <div class="input-group px-2 mb-2 mt-2">
                                <input type="submit" class="btn btn-info w-100" name="ajouter" value="Ajouter">
                            </div>
                        </form>
                    </div>
                </div>
               
            </div>
        </div>
        <!-- Footer-->
            <?php include'../../include/include/footer.php';?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../../dist/js/scripts.js"></script>
    </body>
</html>

<?php
$add_html = filter_input(INPUT_POST, 'ajouter');
$image_html = filter_input(INPUT_POST, 'image');

if (isset($add_html)) {
    $post = new Posts();

    $post->setTitre(filter_input(INPUT_POST, 'titre'));
    $post->setChapo(filter_input(INPUT_POST, 'chapo'));

    if (empty($image_html)) {
        $image_html = 'https://pbs.twimg.com/media/D-lInYQXsAEnXKt.jpg';
    }
    $post->setImage($image_html);

    $post->setContenu(filter_input(INPUT_POST, 'contenu'));
    $post->setUsersId(filter_input(INPUT_POST, 'usersId'));
    $post->setAddedOn(filter_input(INPUT_POST, 'addedOn'));
    $post->setType(filter_input(INPUT_POST, 'type'));

    $service = new PostService($cnx);
    $service->createPost($post);
}
