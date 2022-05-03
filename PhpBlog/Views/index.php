<?php
session_start();
?>
<!DOCTYPE html>

<html lang="fr">

<?php include 'include/header.html'; ?>

<body>
    <!-- Responsive navbar-->
    <?php include 'include/nav-internaute.html' ; ?>
    <!-- Page header with logo and tagline-->
    <header class="py-5 bg-light border-bottom mb-4 header-page">
        <div class="container ">
            <div class="text-center my-5 ">
                <h1 class="fw-bolder">Bienvenue sur PHP Blog!</h1>
                <p class="lead mb-0">Le développement PHP by Marie</p>
            </div>
        </div>
    </header>
    <!-- Page content-->
    <div class="container">
        <div class="row">
            <!-- Side widgets-->
            <div class="col-lg-4">
                <?php include 'include/horloge.html'; ?>
                <!-- Connexion-->
                <div class="card mb-4">
                    <div class="card-header">Se connecter</div>
                    <?php include 'formulaire/connexion.php' ;?>
                </div>

                <!-- devenir membre -->
                <div class="card mb-4">
                    <div class="card-header">Devenir membre</div>
                    <?php include 'formulaire/inscription.php'; ?>
                </div>
            </div>
            <!-- Blog entries-->
            <div class="col-lg-8">
                <!-- About Me-->
                <div class="card mb-4">
                    <div class="row">
                        <div class="col-4">
                            <img class="card-img" src="dist/src/assets/image/monImage.jpg" alt="..." />
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
            <p class="m-0 text-center text-white">Copyright &copy; PHP blog</p>
            <p class="m-0 text-center text-white">version 0.1</p>
            <p class="m-0 text-center">
                <a class="admin-connexion" href="admin/connexion.php" >Admin: connexion</a>
            </p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="dist/js/scripts.js"></script>
</body>

</html>