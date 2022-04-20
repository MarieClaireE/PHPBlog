<?php
include('../include/class/Posts.php');
include('../include/service/PostService.php');

$service = new PostService($cnx);
$posts = $service->readAllPostClassed();

$count = $cnx->prepare("SELECT count(*) as pid FROM post");
$count->setFetchMode(PDO::FETCH_ASSOC);
$count->execute();
$tcount = $count->fetchAll();

$perPage = 4;
$nbPage = ceil($tcount[0]["pid"] / $perPage);
?>

<!-- Nested row for non-featured blog posts-->
<div class="row">
    <!-- Blog post-->
    <?php 
    foreach ($posts as $post) {
        ?>
        <div class="col-lg-6">
            <div class="card mb-4">
                <a href="#!"><img class="card-img-top" src="<?= $post->getImage(); ?>" alt="..." /></a>
                <div class="card-body">
                    <div class="small text-muted">
                        Publié le <?= date('d-m-y', strtotime($post->getAddedOn())); ?>
                        <br>
                        <?php
                        if ($post->getUpdateOn() !== null )  {
                        ?>
                            Mis à jour le <?= date('d-m-y', strtotime($post->getUpdateOn())); ?>
                        <?php 
                        }
                        ?>
                    </div>
                    <h4 class="card-title"><?= $post->getTitre(); ?></h4>
                    <h6 class="text-muted"><?= $post->getChapo(); ?></h6>
                    <p class="card-text">
                        <span class="badge bg-secondary">
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
                    </p>
                    <a href="" class="btn bg-yellow w-100"> Lire + →</a>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>
<!-- Pagination-->
<nav aria-label="Pagination" class="row"> 
    <hr class="my-0" />
    <?php
    for ($i=1; $i <= $nbPage; $i++) {
        echo "<a class='btn col-1 page-btn border mb-2 mt-2' href='?page=$i'> $i </a> &nbsp";
    }    
    ?>
</nav>