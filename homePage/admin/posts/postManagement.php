<?php
require'include/loadFile.php';

$service = new PostService($cnx);
$posts = $service->readAllPostClassed();

$count = $cnx->prepare("SELECT count(*) as pid FROM post");
$count->setFetchMode(PDO::FETCH_ASSOC);
$count->execute();
$tcount = $count->fetchAll();

$perPage = 4;
$nbPage = ceil($tcount[0]["pid"] / $perPage);
?>

<!DOCTYPE html>
<html lang="fr">
   <?php include'include/head.php'; ?>
    <body>
        <!-- Responsive navbar-->
        <?php include'include/recherche.php' ;?>
        <!-- Page content-->
        <div class="container mt-5">
            <div class="row">
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <?php include'../../include/include/horloge.php'; ?>
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header">Search</div>
                        <div class="card-body">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                                <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                            </div>
                        </div>
                    </div>
                    <!-- Categories widget-->
                    <?php include'../../include/include/categories.php';?>
                </div>
                <!-- Blog entries-->
                <div class="col-lg-8">
                   <table class="table">
                        <thead>
                            <th>Id</th>
                            <th>Titre</th>
                            <th>Date</th>
                            <th>Posté par</th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php 
                            if (null !== $posts) {
                                foreach ($posts as $post) {
                                ?>
                                    <tr>
                                        <td>
                                            <span class="badge bg-secondary">ID<?= $post->getId(); ?></span>
                                        </td>
                                        <td>
                                            <?= $post->getTitre();?>
                                        </td>
                                        <td>
                                            <span class="text-muted" style="font-size:small;">
                                            Add :
                                            </span>
                                            <?= date('d-m-y', strtotime($post->getAddedOn())); ?>
                                            <br>
                                            <?php
                                                if (null !== $post->getUpdateOn()) {
                                                    print '<span class="text-muted" style="font-size:small;">
                                                    Up :
                                                    </span>' . date('d-m-y', strtotime($post->getUpdateOn()));
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($post->getUsersId() === $id) {
                                                print $nom. '&nbsp;';
                                                print $prenom;
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="post-update.php?postId=<?= $post->getId(); ?>" class="btn btn-success">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="" method="post">
                                                <input type="submit" name="delete" value="Supprimer" class="btn btn-danger">
                                            </form>
                                        </td>
                                    </tr>
                                <?php  
                                }
                            }
                            ?>
                        </tbody>
                   </table>  
                   <!-- Pagination-->
                    <nav aria-label="Pagination" class="row"> 
                        <hr class="my-0" />
                        <div class="col-3 mx-auto">
                            <?php
                            for ($i=1; $i <= $nbPage; $i++) {
                                print "<a class='btn page-btn border mb-2 mt-2' href='?page=$i'> $i </a> &nbsp";
                            }    
                            ?>
                        </div>
                    </nav>                
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
if (null !== $posts) {
    $delete_html = filter_input(INPUT_POST, 'delete');

    if (isset($delete_html)) 
    {
        foreach ($posts as $post) {
            $postId = $post->getId();
            $service->deletePost($postId);
        }  
    }
}
