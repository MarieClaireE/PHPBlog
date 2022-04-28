<?php
require'include/controller/UsersController.php';

use Cnx\Cnx;
use trait\ServiceCnx;
use Controller\UsersController;
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
        <link rel="icon" type="image/x-icon" href="dist/assets/favicon-internet.png" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="dist/css/styles.css" rel="stylesheet" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://kit.fontawesome.com/96ee82b9ac.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#!">PHP Blog</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Accueil</a></li>
                        <li class="nav-item"><a class="nav-link"  href="#">Blog</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page header with logo and tagline-->
        <header class="py-5 bg-light header-page border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">PHP Blog</h1>
                    <p class="lead mb-0">Développement By Marie!</p>
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Search widget-->
                    <div class="card mb-4 border-0">
                        <?php include'include/include/horloge.php';?>
                    </div>
                    <!-- Connexion widget-->
                    <?php UsersController::connexionUser() ?>
                    <!-- Devenir membre widget-->
                    <?php include'formulaire/inscription.php' ;?>
                </div>
                <!-- Blog entries-->
                <div class="col-lg-8">
                   <div class="card mb-4">
                        <div class="row">
                            <div class="col-4">
                                <img class="card-img" src="src/assets/image/monImage.jpg" alt="..." />
                            </div>
                            <div class="col-8">
                                <div class="card-body">
                                    <h2 class="card-title">Une petite présentation s'impose ... </h2>
                                    <p class="card-text">
                                        ¡Hola!
                                        <br>
                                        <br>
                                        Je m'appelle Marie Claire EMMA. Mais vous pouvez m'appeler Marie. J'ai 21 ans.
                                        <br>
                                        <br>
                                        J'ai obtenu mon baccalauréat scientifique en 2019, je me suis dans un premier temps orienté vers la petite enfance.
                                        <br>
                                        <br>
                                        En 2020, j'ai commencé en autodidacte le développement HTML. J'ai suivi un parcours de remise à niveau dans le développement PHP avec tuto.com.
                                        <br>
                                        <br>
                                        En 2021, je suis entrée dans la Garantie Jeune, ils m'ont permis de faire un stage à Défi-Informatique en tant que développeuse web. Suite à ce stage, ils m'ont proposé un poste en alternance en tant que développeuse web.
                                        <br>
                                        <br>
                                        En septembre 2021, j'ai donc commencé un parcours en alternance dans le developpement PHP/Symfony avec OpenClassrooms, et en tant que développeuse web chez Défi-Informatique.
                                    </p>
                                </div>
                            </div>
                        </div>
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
        <script src="dist/js/scripts.js"></script>
    </body>
</html>
