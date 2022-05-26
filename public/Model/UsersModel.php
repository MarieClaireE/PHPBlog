<?php

namespace App\Model;

use App\Core\Cnx;
use PDO;
use App\Model\Users;

class UsersModel extends Cnx
{
    public function createUser(Users $user)
    { 
        if (!empty($user->getName()) || !empty($user->getPrenom()) || (!empty($user->getEmail()) || (!empty($user->getPassword())))) {
            $sql = "INSERT INTO users (name, prenom, email, password, statut, firstCnx) values (:nom, :prenom, :email, :password, :statut, :firstCnx)";

            $req= Cnx::getInstance()->prepare($sql);
            
            $req->bindValue(':nom', $user->getName(), PDO::PARAM_STR);
            $req->bindValue(':prenom', $user->getPrenom(), PDO::PARAM_STR);
            $req->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
            $req->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
            $req->bindValue(':firstCnx', $user->getFirstCnx(), PDO::PARAM_STR);
            $req->bindValue(':statut', $user->getStatut(), PDO::PARAM_STR);

            $req->execute();
        }  
    }

    public function readUser($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id ";
        $req = Cnx::getInstance()->prepare($sql);

        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);

        $user = new Users();
        $user->setId($data['id']);
        $user->setName($data['name']);
        $user->setPrenom($data['prenom']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $user->setFirstCnx($data['firstCnx']);
        $user->setStatut($data['statut']);

        return $user;
    }

    public function readAllUsers()
    {
        $sql = "SELECT * FROM users";
        $req = Cnx::getInstance()->prepare($sql);
        $req->execute();
        

        while($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $user = new Users();
            $user->setId($data['id']);
            $user->setName($data['name']);
            $user->setPrenom($data['prenom']);
            $user->setEmail($data['email']);
            $user->setPassword($data['password']);
            $user->setFirstCnx($data['firstCnx']);
            $user->setLastCnx($data['lastCnx']);
            $user->setStatut($data['statut']);

            $users[] = $user;
        }
       
        if (!empty($users)) {
            return $users;
        }

    }

    public function cnxUser($email, $password)
    {   
        $sql = "SELECT * FROM users WHERE email=:email AND password=:mdp";
        $req = Cnx::getInstance()->prepare($sql);
        $req->execute(array('email' =>filter_input(INPUT_POST, 'email'), 'mdp' => filter_input(INPUT_POST, 'password')));

        return $req;
    }

    public function cnxAdmin($email, $pass)
    {
        $sql = "SELECT * FROM users WHERE email=:email AND password=:password AND statut=:statut";
        $req = Cnx::getInstance()->prepare($sql);
        $req->execute(array('email' => filter_input(INPUT_POST, 'email'), 'password' => filter_input(INPUT_POST, 'password'), 'statut'=> 0));

        return $req;
    }

    public function updateUser(Users $user)
    {
        $sql = "UPDATE users SET name=:name, prenom=:firstname, email=:email, password=:mdp WHERE id= :id";

        $req = Cnx::getInstance()->prepare($sql);

        $req->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        $req->bindValue(':name', $user->getName(), PDO::PARAM_STR);
        $req->bindValue(':firstname', $user->getPrenom(), PDO::PARAM_STR);
        $req->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $req->bindValue(':mdp', $user->getPassword(), PDO::PARAM_STR);

        $req->execute(); 
    }

    public function updatelastCnx($lastCnx, $id) {
        $sql = "UPDATE users SET lastCnx = :lastCnx WHERE id=:id";
        $req = Cnx::getInstance()->prepare($sql);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->bindValue(':lastCnx', $lastCnx, PDO::PARAM_STR);

        $req->execute();
    }
}