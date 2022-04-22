<?php
require('include/loadFile.php');
use \include\class\Posts;

$id_url = filter_input(INPUT_GET, 'postId');
$service = new PostService($cnx);
$post = $service->readPost($id_url);

?>
<!DOCTYPE html>
<html lang="fr">
    <?php include('include/head.php'); ?>
    <body>
        <!-- navBar -->
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
        <!-- current page -->
        <div class="container">
            <div class="row">
                <!-- horloge -->
                <div class="col-lg-4">
                    <div class="card mb-4 border-0 mt-3">
                        <a href="postManagement.php" class="btn btn-danger col-4">
                            <i class="fa-solid fa-arrow-left-long"></i>
                            Retour
                        </a>
                    </div>
                    <div class="card mb-4 border-0">                   
                        <?php include('../../include/include/horloge.php'); ?>                       
                    </div>
                </div>
                <!-- contenu -->
                <div class="col-lg-8">
                    <div class="card mt-2 mb-4 px-2 py-2">
                        <h3 class="text-uppercase text-muted mb-3 ms-2">
                            <?= $post->getTitre(); ?>
                        </h3>
                        <form action="" method="post">
                            <div class="input-group px-2 mt-2">
                                <input type="text" name="titre" value="<?= $post->getTitre(); ?>" class="form-control">
                            </div>
                            <div class="input-group px-2 mt-2">
                                <input type="text" name="image" value="<?= $post->getImage(); ?>" class="form-control">
                            </div>
                            <div class="input-group px-2 mt-2">
                                <textarea name="chapo" id="chapo" cols="30" rows="5" class="form-control"><?= $post->getChapo(); ?></textarea>
                            </div>
                            <div class="input-group px-2 mt-2">
                                <textarea name="contenu" id="contenu" cols="30" rows="5" class="form-control"><?= $post->getContenu(); ?></textarea>
                            </div>
                            <input type="hidden" value="<?= date('Y-m-d'); ?>" name="updatedOn">
                            <p class="font-weigth-bold px-2 mt-2">
                                <?php
                                    if ($post->getType() == 0) {
                                        echo "Web Design";
                                    } else if ($post->getType() == 1) {
                                        echo "HTML";
                                    } else if ($post->getType() == 2) {
                                        echo "JavaScript";
                                    } else if ($post->getType() == 3) {
                                        echo "CSS";
                                    } else if ($post->getType() == 4) {
                                        echo "PHP";
                                    }
                                ?>                               
                            </p>
                            <div class="input-group px-2 mt-2">
                                <select name="type" id="type" class="form-control">
                                   <option value="0">Web design</option>
                                   <option value="1">HTLM</option>
                                   <option value="2">JavaScript</option>
                                   <option value="3">CSS</option>
                                   <option value="4">PHP</option>
                                </select>
                            </div>
                            <input type="hidden" value="<?= $id; ?>">
                            <div class="input-group px-2 mt-2">
                                <input type="submit" placeholder="Modifier" name="update" class="text-center btn btn-info w-100">
                            </div>
                        </form>
                    </div>
                </div>
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

<?php
$update_html = filter_input(INPUT_POST, 'update');

if (isset($update_html)) {
    $post = new Posts;
    
    $post->setId($id_url);
    $post->setTitre(filter_input(INPUT_POST, 'titre'));
    $post->setChapo(filter_input(INPUT_POST, 'chapo'));
    $post->setImage(filter_input(INPUT_POST, 'image'));
    $post->setContenu(filter_input(INPUT_POST, 'contenu'));
    $post->setType(filter_input(INPUT_POST, 'type'));
    $post->setUpdateOn(filter_input(INPUT_POST, 'updatedOn'));

    $service->update($post);
}