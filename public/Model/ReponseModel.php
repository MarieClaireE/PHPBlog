<?php

namespace App\Model;

use App\Core\Cnx;
use PDO;

class ReponseModel extends Cnx
{
    /* create */
    public function create(Reponse $reponse)
    {
        $sql = "INSERT INTO reponse (contenu, usersId, commentaireId, addedOn, statut) VALUES (:contenu, :usersId, :commentaireId, :addedOn, :statut)";

        $req = Cnx::getInstance()->prepare($sql);

        $req->bindValue(':contenu', $reponse->getContenu(), PDO::PARAM_STR);
        $req->bindValue(':usersId', $reponse->getUsersId(), PDO::PARAM_INT);
        $req->bindValue('commentaireId', $reponse->getCommentaireId(), PDO::PARAM_INT);
        $req->bindValue(':addedOn', $reponse->getAddedOn(), PDO::PARAM_STR);
        $req->bindValue(':statut', $reponse->getStatut(), PDO::PARAM_BOOL);

         $req->execute();
    }

    /* read by id */
    public function readId(int $commentaireId) 
    {
        $sql = 'SELECT * FROM reponse WHERE commentaireId = :commentaireId';
        $req = Cnx::getInstance()->prepare($sql);

        $req->bindValue(':commentaireId', $commentaireId, PDO::PARAM_INT);
        $req->execute();

        while($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $reponse = new Reponse;
            $reponse->setId($data['id']);
            $reponse->setContenu($data['contenu']);
            $reponse->setAddedOn($data['addedOn']);
            $reponse->setUsersId($data['usersId']);
            $reponse->setCommentaireId($data['commentaireId']);
            $reponse->setStatut($data['statut']);

            $reponses[] = $reponse;
        }
       
        if (!empty($reponses)) {
            return $reponses;
        }
    }
    /* read all classed */
    public function readAllClassed(int $commentaireId)
    {
        $page_url = filter_input(INPUT_GET, 'page');

        if (!isset($page_url)) {
            $page = 1;
            return;
        } 
        $page = $page_url;

        $perPage = 4;
        $start = ($page-1) * $perPage;
        
        $sql = "SELECT * FROM reponse WHERE commentaireId=:commentaireId ORDER BY addedOn ASC LIMIT $start, $perPage";
        $req = Cnx::getInstance()->prepare($sql);
        $req->bindValue(':commentaireId', $commentaireId, PDO::PARAM_INT);
        $req->execute();

        while($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $reponse = new Reponse;
            $reponse->setId($data['id']);
            $reponse->setContenu($data['contenu']);
            $reponse->setAddedOn($data['addedOn']);
            $reponse->setUsersId($data['usersId']);
            $reponse->setCommentaireId($data['commentaireId']);
            $reponse->setStatut($data['statut']);

            $reponses[] = $reponse;
        }
       
        if (!empty($reponses)) {
            return $reponses;
        }
    }

    public function readClassed()
    {
        $page_url = filter_input(INPUT_GET, 'page');

        if (!isset($page_url)) {
            $page = 1;
            return;
        }
        $page = $page_url;
        
        $perPage = 4;
        $start = ($page-1) * $perPage;
        
        $sql = "SELECT * FROM reponse ORDER BY addedOn ASC LIMIT $start, $perPage";
        $req = Cnx::getInstance()->prepare($sql);
        $req->execute();

        while($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $reponse = new Reponse;
            $reponse->setId($data['id']);
            $reponse->setContenu($data['contenu']);
            $reponse->setAddedOn($data['addedOn']);
            $reponse->setUsersId($data['usersId']);
            $reponse->setCommentaireId($data['commentaireId']);
            $reponse->setStatut($data['statut']);

            $reponses[] = $reponse;
        }
       
        if (!empty($reponses)) {
            return $reponses;
        }
    }

    /* read all */
    public function readAll()
    {
        $sql = "SELECT * FROM reponse";
        $req = Cnx::getInstance()->prepare($sql);
        $req->execute();

        while($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $reponse = new Reponse;
            $reponse->setId($data['id']);
            $reponse->setContenu($data['contenu']);
            $reponse->setAddedOn($data['addedOn']);
            $reponse->setUsersId($data['usersId']);
            $reponse->setCommentaireId($data['commentaireId']);
            $reponse->setStatut($data['statut']);

            $reponses[] = $reponse;
        }
       
        if (!empty($reponses)) {
            return $reponses;
        }
    }

    /* update */
    public function update(int $reponseId)
    {
        $sql = "UPDATE reponse SET statut = REPLACE(statut, 0, 1) where id=:id";

        $req = Cnx::getInstance()->prepare($sql);
        $req->bindValue(':id', $reponseId, PDO::PARAM_INT);
        $req->execute();
    }

    /* delete */
    public function delete(Reponse $reponse)
    {
        $sql = "DELETE FROM reponse WHERE commentaireId=:commentaireId AND id=:id";
        $req = Cnx::getInstance()->prepare($sql);
        $req->bindValue(':id', $reponse->getId(), PDO::PARAM_INT);
        $req->bindValue(':commentaireId', $reponse->getCommentaireId(), PDO::PARAM_INT);
        $req->execute();
    }

    /* delete reponse uniquement  */
    public function deleteReponse(int $reponseId)
    {
        $sql = "DELETE FROM reponse WHERE id=:id";
        $req = Cnx::getInstance()->prepare($sql);
        $req->bindValue(':id', $reponseId, PDO::PARAM_INT);
        $req->execute();
    }
}