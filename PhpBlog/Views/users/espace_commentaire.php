<div class="card px-2">
    <div class="card-title h2 text-muted">
        Espace commentaire
    </div>
    <div class="card-body">
        <div class="card px-2 mb-4">
            <div class="card-title border-bottom">
                <i class="fa fa-user"></i>
                &nbsp; Nom de la personne qui a commenter
                + date de la publication
            </div>
            <div class="card-body">
                <p class="card-text">

                </p>
            </div>
            <div class="card-footer">
                partie reponse
            </div>
        </div>
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
        <form action="" method="post">
            <textarea name="reponse" id="reponse" cols="30" rows="10" class="form-control"></textarea>
            <input type="hidden" name="usersId" value=<?= $id; ?>  class="form-control">
            <input type="hidden" name="addedOn" value=<?= date('Y-m-d'); ?>  class="form-control">
            <input type="submit" name="publier" value="Publier" class="btn bg-yellow w-100 mb-2 mt-2">
        </form>
    </div>
</div>