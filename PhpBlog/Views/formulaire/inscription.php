<?php
use App\Autoload;
use App\Model\Users;
use App\Model\UsersModel;

require_once '../Autoload.php';
Autoload::register();

$model = new UsersModel;

?>
<div class="card-body mt-2 text-center">
    <form action="" method="post">
        <input type="text" placeholder="Nom" name="name" class="form-control" required>
        <br>
        <input type="text" placeholder="Prénom" name="prenom" class="form-control" required>
        <br>
        <input type="email" placeholder="email" name="email" class="form-control" required>
        <br>
        <input type="password" placeholder="Mot de passe" name="password" class="form-control" required>
        <br>
        <input type="password" placeholder="Confirmer mot de passe" name="password2" class="form-control" required>
        <input type="hidden" value="1" name="statut">
        <input type="hidden" value=<?= date('Y-m-d'); ?> name="firstCnx">
        <br>
        <input class="btn btn-info" type="submit" value="S'inscrire" name="inscription">
    </form>
    <?php
        $inscription_html = filter_input(INPUT_POST, 'inscription');
        if (isset($inscription_html)) {
            $user = new Users();
            $user->setName(filter_input(INPUT_POST, 'name'));
            $user->setPrenom(filter_input(INPUT_POST, 'prenom'));
            $user->setEmail(filter_input(INPUT_POST, 'email'));
            $user->setPassword(filter_input(INPUT_POST, 'password'));
            $user->setStatut(filter_input(INPUT_POST, 'statut'));
            $user->setFirstCnx(filter_input(INPUT_POST, 'firstCnx'));
            
            if (filter_input(INPUT_POST, 'password') === filter_input(INPUT_POST, 'password2')){
                $model->createUser($user);
            } else {
                echo  'Les mots de passes sont différents';
            }
        }
    ?>
</div>