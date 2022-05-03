<?php
include '../include/session.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <?php include '../include/header.html'; ?>
    <body>
        <?php include '../include/nav-users.html'; ?>
        <header class="py-5 bg-light border-bottom mb-4 header-page-users">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder"> <?= ucfirst($prenom); ?> <?= ucfirst($nom); ?></h1>
                    <p class="lead mb-0">
                        Bienvenue sur TA partie du Blog, ici tu vas pouvoir faire ce que les autres utilisateurs ne peuvent pas : 
                        <span class="badge bg-secondary">Commenter</span>. Donc si tu as des remarques ou des questions sur les posts n'hésite pas à utiliser l'espace commentaire.
                        Et si tu as besoins de plus d'info, n'hésite pas à revenir vers moi dans la partie 
                        <span class="badge bg-secondary">Contact</span>
                    </p>
                </div>
            </div>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mt-3 mb-4 border-0">
                        <?php include '../include/horloge.html'; ?>
                    </div>
                    <div class="card mb-4 border">
                        <?php include '../include/search.html'; ?>
                    </div>
                    <div class="card mb-4 border-0">
                        <?php include '../include/categories.html'; ?>
                    </div>
                </div>
                <div class="col-lg-8">
                    <?php include 'list-posts.php'; ?>
                </div>
            </div>
        </div>
        <?php include '../include/footer.html'; ?>
    </body>
</html>
