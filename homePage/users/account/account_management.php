<?php
require'../../include/include/sessionUser.php';
require'../../include/include/cnx.php';
require'../../include/service/UsersService.php';
require'../../include/class/Users.php';

use include\class\Users;

$service = new UsersService($cnx);
$user = $service->readUser($id);

$message = '';
$update_html = filter_input(INPUT_POST, 'update');

if (isset($update_html)) {
    $user = new Users();
    $user->setId($id);
    $user->setNom(filter_input(INPUT_POST, 'nom'));
    $user->setPrenom((filter_input(INPUT_POST, 'prenom')));
    $user->setPassword(filter_input(INPUT_POST, 'password'));
    $user->setEmail(filter_input(INPUT_POST, 'email'));

    $service->updateUser($user);

    $message = "Modification effectuée ! Veuillez vous déconnecter pour effectuer les enregsitrements";
    
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Mon compte - PHP Blog</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="../../../dist/assets/favicon-internet.png" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../../../dist/css/styles.css" rel="stylesheet" />
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
                        <li class="nav-item"><a class="nav-link"  href="../homePage-users.php">Blog</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Notifications</a></li> <!-- mettre un dropdown pour faire un listing des dernières notifications -->
                        <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Mon Compte</a></li>
                        <li class="nav-item"><a class="nav-link" href="../deconnexion.php">Déconnexion</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- header -->
        <header class="py-5 bg-light border-bottom mb-4 header-page-users">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Gestion du compte de : <?= ucfirst($prenom); ?> <?= ucfirst($nom); ?></h1>
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container mt-3">
            <div class="row">
                <!-- Side widget-->
                <div class="col-lg-4">
                    <div class="card mb-4 border-0">
                        <?php include'../../include/include/horloge.php'; ?>
                    </div>

                    <div class="card mb-4 py-2 px-2">
                        <b>Inscrit depuis le :</b><?= date('d-m-y', strtotime($user->getFirstCnx()));?>

                    </div>
                </div>
                <!-- Blog entries-->
                <div class="col-lg-8 mb-2">
                    <div class="card py-2">
                        <form action="" method="post">
                            <div class="input-group px-2 mb-2">
                                <span class="input-group-text" id="nom"> 
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="text" name="nom" class="form-control" value=<?= $nom; ?> aria-describedby="nom">
                            </div>
                            <div class="input-group px-2 mb-2">
                                <span class="input-group-text" id="prenom">
                                    <i class="fa fa-user"></i>                               
                                </span>
                                <input type="text" name="prenom" class="form-control" value=<?= $prenom; ?> aria-describedby="prenom">
                            </div>
                            <div class="input-group px-2 mb-2">
                                <span class="input-group-text" id="email">
                                    @                           
                                </span>
                                <input type="email" name="email" class="form-control" value=<?= $email; ?> aria-describedby="email">
                            </div>
                            <div class="input-group px-2 mb-2">
                                <span class="input-group-text" id="mdp">
                                    <i class="fa-solid fa-key"></i>                         
                                </span>
                                <input type="password" id="password" name="password" class="form-control" value=<?= $mdp; ?> aria-describedby="mdp">
                                <button id="eye" type="button" title="Masquer/démasquer" style="position:absolute;right:50px;border:none;" class="bg-white mt-2"> 
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </div>
                            <div class="input-group px-2 mb-2">
                                <input type="submit" value="Modifier" name="update" class="btn btn-info w-100">
                            </div>
                        </form>
                        <?= $message; ?>
                        <script>
                            document.getElementById("eye").addEventListener("click", function(e) {
                                if (password.getAttribute("type")=="password")
                                {
                                    password.setAttribute("type","text")
                                } else
                                {
                                    password.setAttribute("type", "password")
                                }
                            })
                        </script>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer-->
        <?php include'../../include/include/footer.php';?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../../../dist/js/scripts.js"></script>
    </body>
</html>

<?php

