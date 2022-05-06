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
    public function readId(int $id) 
    {

    }
    /* read all classed */
    public function readAllClassed()
    {
        $count = Cnx::getInstance()->prepare("SELECT count(*) as pid FROM reponse");
        $count->setFetchMode(PDO::FETCH_ASSOC);
        $count->execute();
        $tcount = $count->fetchAll();

        $page_url = filter_input(INPUT_GET, 'page');

        if (!isset($page_url)) {
            $page = 1;
        } else {
            $page = $page_url;
        }
        $perPage = 4;
        $nbPage = ceil($tcount[0]["pid"] / $perPage);
        $start = ($page-1) * $perPage;
        
        $sql = "SELECT * FROM reponse ORDER BY addedOn DESC LIMIT $start, $perPage";
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

    }

    /* update */
    public function update(Reponse $reponse)
    {

    }

    /* delete */
    public function delete(int $id)
    {

    }
}