<?php

include(__DIR__.' /../include/cnx.php');
include(__DIR__. '/../trait/ServiceCnx.php');


class UsersService
{
    use ServiceCnx;

    public function createUser(Users $user)
    {
        // if (isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['password'])) {
        //     $pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        //     $sql = "INSERT INTO users (name, prenom, email, password, statut, firstCnx) values (:nom, :prenom, :email, :password, :statut, :firstCnx)";

        //     $req= $this->cnx->prepare($sql);
            
        //     $req->bindValue(':nom', $user->getNom(), PDO::PARAM_STR);
        //     $req->bindValue(':prenom', $user->getPrenom(), PDO::PARAM_STR);
        //     $req->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        //     // $req->bindValue(':password', $pass_hash, PDO::PARAM_STR);
        //     $req->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        //     $req->bindValue(':firstCnx', $user->getFirstCnx(), PDO::PARAM_STR);
        //     $req->bindValue(':statut', $user->getStatut(), PDO::PARAM_STR);

        //     $verif = $req->execute();
        //     if ($verif) {
        //         echo "Vous êtes inscrit. Vous pouvez maintenant vous connecter !";
        //     } else {
        //         echo "Une erreur est survenue ! Veuillez recommencer SVP!";
        //     }
        // }  
        
        if (empty($user->getNom()) || empty($user->getPrenom()) || (empty($user->getEmail()) || (empty($user->getPassword())))) {
            echo 'Pour s\'enregistrer il faut remplir tous les champs';
        } else {
            $sql = "INSERT INTO users (name, prenom, email, password, statut, firstCnx) values (:nom, :prenom, :email, :password, :statut, :firstCnx)";

            $req= $this->cnx->prepare($sql);
            
            $req->bindValue(':nom', $user->getNom(), PDO::PARAM_STR);
            $req->bindValue(':prenom', $user->getPrenom(), PDO::PARAM_STR);
            $req->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
            $req->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
            $req->bindValue(':firstCnx', $user->getFirstCnx(), PDO::PARAM_STR);
            $req->bindValue(':statut', $user->getStatut(), PDO::PARAM_STR);

            $verif = $req->execute();
            if ($verif) {
                echo "Vous êtes inscrit. Vous pouvez maintenant vous connecter !";
            } else {
                echo "Une erreur est survenue ! Veuillez recommencer SVP!";
            }
        }  
        
    }

    public function UserCnx() {
        $message1 = 'Veuillez remplir tous les champs !! ';
        $message2 = 'Accès refusé';

        // si le mail et le mdp sont vides
        if (empty($_POST['email']) || empty($_POST['password'])) {
            echo $message1;
        } else {
            $sql = "SELECT * FROM users WHERE email=:email AND password=:mdp";
            $req = $this->cnx->prepare($sql);
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
    
            header('location: homePage-users.php?id='.$data['id']);
        } else {
            echo $message2;
        }
        
    }

    public function readUser($id)
    {
        $sql = "SELECT * FROM user WHERE id = :id ";
        $req = $this->cnx->prepare($sql);

        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);

        $user = new Users();
        $user->setId($data['id']);
        $user->setNom($data['nom']);
        $user->setPrenom($data['prenom']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $user->setFirstCnx($data['firstCnx']);
        $user->setStatut($data['statut']);

        return $user;
    }

    public function readAllUsers()
    {

    }
    public function updateUser()
    {

    }
    public function updatelastCnx($lastCnx, $id) {
        $sql = "UPDATE users SET lastCnx = :lastCnx WHERE id=:id";
        $req = $this->cnx->prepare($sql);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->bindValue(':lastCnx', $lastCnx, PDO::PARAM_STR);

        $req->execute();
    }
    public function deleteUser()
    {

    }
}