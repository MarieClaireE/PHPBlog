<?php
use App\Autoload;
use App\Model\Users;
use App\Model\UsersModel;

require_once '../../Autoload.php';

Autoload::register();

$model = new UsersModel;
$user = $model->readUser($id);

?>
<div class="card-header">
    <i class="fa fa-user"></i>
    <?= $prenom; ?> <?= $nom; ?>
</div>
<div class="card-body">
    <p class="card-text">
        Connecté depuis le : <?= date('d-m-Y', strtotime($user->getFirstCnx())); ?>
        <form action="" method="post">
            <input type="text" name="nom" value=<?= $nom ;?> class="form-control mb-2">
            <input type="text" name="prenom" value=<?= $prenom ;?> class="form-control mb-2">
            <input type="text" name="email" value=<?= $email ;?> class="form-control mb-2">
            <button id="eye" type="button" title="Masquer/démasquer" style="position:absolute;right:50px;border:none;" class="bg-white mt-2"> 
                <i class="fa-solid fa-eye"></i>
            </button>
            <input type="password" id="password" name="password" class="form-control mb-2" value=<?= $mdp; ?> aria-describedby="mdp">
            <input type="submit" name="modifier" value="Modifier" class="btn bg-yellow col-12 px-2 mb-2">
        </form>
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
        <?php
        $update_html = filter_input(INPUT_POST, 'modifier');
        if (isset($update_html))
        {
            $user = new Users;
            $user->setId($id);
            $user->setName(filter_input(INPUT_POST, 'nom'));
            $user->setPrenom((filter_input(INPUT_POST, 'prenom')));
            $user->setPassword(filter_input(INPUT_POST, 'password'));
            $user->setEmail(filter_input(INPUT_POST, 'email'));

            $model->updateUser($user);
            
            print 'Modification effectuée! <br>
            <span class="text-small text-muted">
            Si vous ne voyez pas les modifications veuillez vous reconnecter !
            </span> ';
        }
        ?>
    </p>
</div>