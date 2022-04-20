<?php
require('../include/include/sessionUser.php');
require('../include/include/cnx.php');

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Accueil - PHP Blog</title>
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
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Blog</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Notifications</a></li> <!-- mettre un dropdown pour faire un listing des dernières notifications -->
                        <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Mon Compte</a></li>
                        <li class="nav-item"><a class="nav-link" href="deconnexion.php">Déconnexion</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page header with logo and tagline-->
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
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Side widget-->
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body fond-horloge" id="horloge" style="font-size:20px;">
                        </div>
                        <script type="text/javascript">
                            function afficherDate() 
                                {
                                    let cejour = new Date();
                                    let options = {weekday: "long", year: "numeric", month: "long", day: "2-digit"};
                                    let date = cejour.toLocaleDateString("fr-FR", options);
                                    let heure = ("0" + cejour.getHours()).slice(-2) + ":" + ("0" + cejour.getMinutes()).slice(-2) + ":" + ("0" + cejour.getSeconds()).slice(-2);
                                    let dateheure = date + "<br> " + heure;
                                    dateheure = dateheure.replace(/(^\w{1})|(\s+\w{1})/g, lettre => lettre.toUpperCase());
                                    document.getElementById('horloge').innerHTML = dateheure;
                                }
                            setInterval(afficherDate, 1000);
                        </script>
                    </div>
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
                    <div class="card mb-4">
                        <div class="card-header">Categories</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="#!">Web Design</a></li>
                                        <li><a href="#!">HTML</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="#!">JavaScript</a></li>
                                        <li><a href="#!">CSS</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Blog entries-->
                <div class="col-lg-8">
                    <?php include('../posts/list_posts.php');?>
                </div>
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright &copy; PHP Blog </p>
                <p class="m-0 text-center text-white">version 0.1</p>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../dist/js/scripts.js"></script>
    </body>
</html>
