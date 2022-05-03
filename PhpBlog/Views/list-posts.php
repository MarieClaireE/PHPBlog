<?php
?>
<!DOCTYPE html>
<html lang='fr'>
    <?php include 'include/header.html'; ?>
    <body>
        <?php include 'include/nav-internaute.html'; ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mt-3 mb-4 border-0">
                        <?php include 'include/horloge.html'; ?>
                    </div>
                    <div class="card mb-4 border">
                        <?php include 'include/search.html'; ?>
                    </div>
                    <div class="card mb-4 border-0">
                        <?php include 'include/categories.html'; ?>
                    </div>
                </div>
                <div class="col-lg-8">
                    <?php include 'blog.php' ;?>
                </div>
            </div>
        </div>
        <?php include 'include/footer.html'; ?>
    </body>
</html>

