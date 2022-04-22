<?php
session_start();
require'../include/include/cnx.php';
require'../include/class/Users.php';
require'../include/service/UsersService.php';

$message = '';

$cnx_html = filter_input(INPUT_POST, 'connexion');

if (isset($cnx_html)) {
    $sql = "SELECT * FROM users WHERE email=:email AND password=:password AND statut=:statut";
    $req = $cnx->prepare($sql);
    $req->execute(array('email' => filter_input(INPUT_POST, 'email'), 'password' => filter_input(INPUT_POST, 'password'), 'statut'=> 0));

    $count = $req->rowCount();
    
    // si le couple pseudo password est trouvé
    if ($count > 0) {
        $_SESSION['email'] = filter_input(INPUT_POST, 'email');

        $data = $req->fetch(PDO::FETCH_ASSOC);
        $_SESSION['nom'] = $data['name'];
        $_SESSION['prenom'] = $data['prenom'];
        $_SESSION['password'] = $data['password'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['id'] = $data['id'];

        header('location: homePage-admin.php');
    } else {
        $message = 'Accès refusé';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Connexion</title>
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
                <a class="navbar-brand" href="../index.php">Retour à l'accueil</a>
            </div>
        </nav>
        <!-- Page header with logo and tagline-->
        <header class="py-5 bg-light border-bottom">
               
            <div class="col-10 card mx-auto mt-5 mb-5">
                <div class="card-header">
                    <i class="fa-solid fa-user"></i>
                    Connexion en tant qu'administrateur
                </div>
                <div class="card-body">
                    <p class="card-text mb-5 mt-5">
                        <div class="row">
                            <div class="col-5 mx-auto">
                                <form action="" method="post">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">@</span>
                                        <input type="email" name="email" placeholder="Votre E-mail" class="form-control" aria-describedby="basic-addon1" required>
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon2">
                                            <i class="fa-solid fa-key"></i>
                                        </span>
                                        <input type="password" name="password" placeholder="Votre mot de passe" class="form-control" required >
                                    </div>
                                    <br>
                                    <input type="hidden" value="<?= date('Y-m-d H:i:s', strtotime('-2H')); ?>" name="lastCnx">
                                    <br>
                                    <input type="submit" class="btn btn-info" value="Se connecter" name="connexion">
                                    <a href="" class="float-end">Mot de passe oublié ? </a>
                                </form>
                                <span>
                                    <?= $message; ?>
                                </span>
                            </div>
                        </div>
                    </p>
                </div>
                <div class="card-footer">
                    <a href=""> S'inscrire en tant qu'administrateur </a>
                </div>
            </div>
                
        </header>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; PHP Blog</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../dist/js/scripts.js"></script>
    </body>
</html>

<?php

if (isset($cnx_html)) {
    $service = new UsersService($cnx);
    $service->updateLastCnx(filter_input(INPUT_POST, 'lastCnx'), $data['id']);
}

