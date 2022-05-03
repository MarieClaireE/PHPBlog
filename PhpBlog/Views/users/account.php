<?php

include '../include/session.php';

?>
<!DOCTYPE html>
<html lang='fr'>
    <?php include '../include/header.html'; ?>
    <body>
        <?php include '../include/nav-users.html'; ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4 mt-3 border-0">
                        <?php include '../include/horloge.html'; ?>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mt-3 mb-4">
                        <?php include 'user.php'; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../include/footer.html'; ?>
    </body>
</html>