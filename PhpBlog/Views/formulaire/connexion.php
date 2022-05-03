<?php
use App\Autoload;
use App\Model\UsersModel;

require_once '../Autoload.php';

Autoload::register();
$model = new UsersModel;

?>
<div class="card-body border-bottom py-2 mt-2 mb-2 text-center">
    <form action="" method="post">
        <input type="email" placeholder="Votre e-mail" name="email" class="form-control">
        <br>
        <input type="password" placeholder="Votre mot de passe" name="password" class="form-control">
        <input type="hidden" value=<?= date('Y-m-d H:i:s', strtotime('-2H')); ?> name="lastCnx">
        <br>

        <input class="btn btn-info btn-submit" type="submit" value="Se connecter" name="connexion">
    </form>
    <?php
        $cnx_html = filter_input(INPUT_POST, 'connexion');

        if (isset($cnx_html)) {
            // si le mail et le mdp sont vides
            if (empty(filter_input(INPUT_POST, 'email')) || empty(filter_input(INPUT_POST, 'password'))) {
                $message = 'Veuillez remplir tous les champs !! ';
            } else {
                $req = $model->cnxUser(filter_input(INPUT_POST, 'email'), filter_input(INPUT_POST, 'password'));
                $count = $req->rowCount();
            }
            // si le couple pseudo password est trouvé
            if ($count > 0) {
                $_SESSION['email'] = filter_input(INPUT_POST, 'email');

                $data = $req->fetch(PDO::FETCH_ASSOC);
                $_SESSION['nom'] = $data['name'];
                $_SESSION['prenom'] = $data['prenom'];
                $_SESSION['password'] = $data['password'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['id'] = $data['id'];

                header('location: users/accueil.php');
            } else {
                $message = 'Accès refusé';
            }
      
            $model->updateLastCnx(filter_input(INPUT_POST, 'lastCnx'), $data['id']);
        }
    ?>
</div>

