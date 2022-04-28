<?php
namespace Controller;

use Cnx\Cnx;
use include\entity\Users;
use ServiceCnx;
use service\UsersService;
use PDO;

class UsersController {
    
    use ServiceCnx;

    public static function connexionUser() {
        if (empty(filter_input(INPUT_POST, 'email')) || empty(filter_input(INPUT_POST, 'password'))) {
            echo 'Veuillez remplir tous les champs !! ';
        } else {
            $sql = "SELECT * FROM users WHERE email=:email AND password=:mdp";
            $req = UsersController::$cnx->prepare($sql);
            $req->execute(array('email' =>filter_input(INPUT_POST, 'email'), 'mdp' => filter_input(INPUT_POST, 'password')));
    
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

                header('location: users/homePage-users.php');
            } else {
                $message = 'Accès refusé';
            }
        }

        require'../../formulaire/connexion.php';
    }

   
    
}