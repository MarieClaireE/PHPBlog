<?php 
session_start();
require_once('include/include/cnx.php');
include('include/service/UsersService.php');
include('include/class/Users.php');

$message = '';
// if (isset($_POST['connexion'])) {
//     if (!empty($_POST['email']) || !empty($_POST['password']))
//     {
//         $email = $_POST['email'];
//         $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
//         $verify = password_verify($_POST['password'], $password_hash);

//         $req = $cnx->prepare("SELECT * FROM USERS WHERE email = :email  AND password= :password ");
//         $req->execute(array(
//             'email' => $email,
//             'password' => $password_hash
//         ));

//         $connecter = $req->fetch();
//         var_dump($connecter);
//         if (!$connecter) {
//             echo 'Le mot de passe ou l\'adresse e-mail est erroné... Veuillez recommencer svp!';
//         } else {
//             echo 'C est bon';
//         }
//     }
// }

if (isset($_POST['connexion'])) {
    // si le mail et le mdp sont vides
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $message = 'Veuillez remplir tous les champs !! ';
    } else {
        $sql = "SELECT * FROM users WHERE email=:email AND password=:mdp";
        $req = $cnx->prepare($sql);
        $req->execute(array('email' => $_POST['email'], 'mdp' => $_POST['password']));

        $count = $req->rowCount();
    }
    // si le couple pseudo password est trouvé
    if ($count > 0) {
        $_SESSION['email'] = $_POST['email'];

        $data = $req->fetch(PDO::FETCH_ASSOC);
        $_SESSION['nom'] = $data['name'];
        $_SESSION['prenom'] = $data['prenom'];
        $_SESSION['password'] = $data['password'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['id'] = $data['id'];

        header('location: users/homePage-users.php');
    } else {
        $message = 'Accès refusé';
    }
}

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
            <a class="navbar-brand" href="#">PHP Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Accueil</a></li>
                    <!-- <li class="nav-item"><a class="nav-link" href="#!">À propos de moi</a></li> -->
                    <li class="nav-item"><a class="nav-link" href="#!">Me contacter</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                </ul>
            </div>
        </div>
    </nav>
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
                <?php include('include/include/horloge.php'); ?>
                <!-- Connexion-->
                <div class="card mb-4">
                    <div class="card-header">Se connecter</div>
                    <div class="card-body border-bottom py-2 mt-2 mb-2 text-center">
                        <form action="" method="post">
                            <input type="email" placeholder="Votre e-mail" name="email" class="form-control">
                            <br>
                            <input type="password" placeholder="Votre mot de passe" name="password" class="form-control">
                            <br>
                            <input class="btn btn-info btn-submit" type="submit" value="Se connecter" name="connexion">
                        </form>
                    </div>
                </div>

                <!-- devenir membre -->
                <div class="card mb-4">
                    <div class="card-header">Devenir membre</div>
                    <div class="card-body mt-2 text-center">
                        <form action="" method="post">
                            <input type="text" placeholder="Nom" name="nom" class="form-control" required>
                            <br>
                            <input type="text" placeholder="Prénom" name="prenom" class="form-control" required>
                            <br>
                            <input type="email" placeholder="email" name="email" class="form-control" required>
                            <br>
                            <input type="password" placeholder="Mot de passe" name="password" class="form-control" required>
                            <br>
                            <input type="password" placeholder="Confirmer mot de passe" name="password2" class="form-control" required>
                            <input type="hidden" value="1" name="statut">
                            <input type="hidden" value="<?= date('Y-m-d'); ?>" name="firstCnx">
                            <br>
                            <input class="btn btn-info" type="submit" value="S'inscrire" name="inscription">
                        </form>
                        <?= $message; ?>
                    </div>
                </div>
            </div>
            <!-- Blog entries-->
            <div class="col-lg-8">
                <!-- About Me-->
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

<?php
if (isset($_POST['inscription'])) {
    $user = new Users();
    $user->setNom($_POST['nom']);
    $user->setPrenom($_POST['prenom']);
    $user->setEmail($_POST['email']);
    $user->setPassword($_POST['password']);
    $user->setStatut($_POST['statut']);
    $user->setFirstCnx($_POST['firstCnx']);
    
    if ($_POST['password'] === $_POST['password2']){
        $service = new UsersService($cnx);
        $service->createUser($user);
    } else {
        $message =  'Les mots de passes sont différents';
    }
}