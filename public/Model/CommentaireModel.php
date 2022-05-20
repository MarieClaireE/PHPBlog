<?php

namespace App\Model;

use App\Core\Cnx;
use PDO;

class CommentaireModel extends Cnx
{
    /* create */
    public function create(Commentaire $comment)
    {
        $sql = "INSERT INTO commentaire (usersId, postId, contenu, addedOn, statut) VALUES (:usersId, :postId, :contenu, :addedOn, :statut)";

        $req = Cnx::getInstance()->prepare($sql);

        $req->bindValue(':usersId', $comment->getUsersId(), PDO::PARAM_INT);
        $req->bindValue(':postId', $comment->getPostId(), PDO::PARAM_INT);
        $req->bindValue(':contenu', $comment->getContenu(), PDO::PARAM_STR);
        $req->bindValue(':addedOn', $comment->getAddedOn(), PDO::PARAM_STR);
        $req->bindValue(':statut', $comment->getStatut(), PDO::PARAM_BOOL);

        $req->execute();
    }

    /* read by Id */
    public function readId(int $id)
    {
        $sql = "SELECT * FROM commentaire WHERE id=:id";
        $req = Cnx::getInstance()->prepare($sql);

        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);

        $comment = new Commentaire;
        $comment->setId($data['id']);
        $comment->setContenu($data['contenu']);
        $comment->setUsersId($data['usersId']);
        $comment->setPostId($data['postId']);
        $comment->setAddedOn($data['addedOn']);
        $comment->setStatut($data['statut']);

        return $comment;
    }

    /* read if check */
    public function readOne(int $postId)
    {
        $sql = "SELECT * FROM commentaire WHERE postId=:postId AND statut = 0";
        $req = Cnx::getInstance()->prepare($sql);
        $req->bindValue(':postId', $postId, PDO::PARAM_INT);
        $req->execute();

        while ($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $comment = new Commentaire;
            $comment->setId($data['id']);
            $comment->setContenu($data['contenu']);
            $comment->setUsersId($data['usersId']);
            $comment->setPostId($data['postId']);
            $comment->setAddedOn($data['addedOn']);
            $comment->setStatut($data['statut']);

            $comments[] = $comment;
        }

        if (!empty($comments))
        {
            return $comments;
        }
    }

    /* read all classed */
    public function readAllClassed()
    {
        $page_url = filter_input(INPUT_GET, 'page');

        if (!isset($page_url)){
            $page = 1;
        } else {
            $page = $page_url;
        }

        $perPage = 4;
        $start = ($page-1) * $perPage;

        $sql = "SELECT * FROM commentaire ORDER BY addedOn ASC LIMIT $start, $perPage";
        $req = Cnx::getInstance()->prepare($sql);
        $req->execute();

        while ($data = $req->fetch(PDO::FETCH_ASSOC)){
            $comment = new Commentaire;
            $comment->setId($data['id']);
            $comment->setContenu($data['contenu']);
            $comment->setUsersId($data['usersId']);
            $comment->setPostId($data['postId']);
            $comment->setAddedOn($data['addedOn']);
            $comment->setStatut($data['statut']);

            $comments[] = $comment;
        }

        if (!empty($comments)) {
            return $comments;
        }
    }

     /* read all classed */
     public function readAllClassedByPost(int $postId)
     {
         $page_url = filter_input(INPUT_GET, 'page');
 
         if (!isset($page_url)){
             $page = 1;
         } else {
             $page = $page_url;
         }
 
         $perPage = 4;
         $start = ($page-1) * $perPage;
 
         $sql = "SELECT * FROM commentaire WHERE postId =:postId AND statut=0 ORDER BY addedOn DESC LIMIT $start, $perPage";
         $req = Cnx::getInstance()->prepare($sql);
         $req->bindValue(':postId', $postId, PDO::PARAM_INT);
         $req->execute();
 
         while ($data = $req->fetch(PDO::FETCH_ASSOC)){
             $comment = new Commentaire;
             $comment->setId($data['id']);
             $comment->setContenu($data['contenu']);
             $comment->setUsersId($data['usersId']);
             $comment->setPostId($data['postId']);
             $comment->setAddedOn($data['addedOn']);
             $comment->setStatut($data['statut']);
 
             $comments[] = $comment;
         }
 
         if (!empty($comments)) {
             return $comments;
         }
     }

    /* read all */
    public function readAll()
    {
        $sql = "SELECT * FROM commentaire";
        $req = Cnx::getInstance()->prepare($sql);
        $req->execute();

        while ($data = $req->fetch(PDO::FETCH_ASSOC)){
            $comment = new Commentaire;
            $comment->setId($data['id']);
            $comment->setContenu($data['contenu']);
            $comment->setUsersId($data['usersId']);
            $comment->setPostId($data['postId']);
            $comment->setAddedOn($data['addedOn']);
            $comment->setStatut($data['statut']);

            $comments[] = $comment;
        }

        if (!empty($comments)) {
            return $comments;
        }
    }

    /* update */
    public function update(Commentaire $commentaire)
    {

    }

    /* delete */
    // public function delete(Commentaire $comment, Reponse $reponse)
    // {
    //     $reponseModel = new ReponseModel;
    //     $reponseModel->delete($reponse);
    //     $sql = "DELETE FROM commentaire WHERE postId=:postId AND id=:id";
    //     $req = Cnx::getInstance()->prepare($sql);
    //     $req->bindValue(':id', $comment->getId(), PDO::PARAM_INT);
    //     $req->bindValue(':postId', $comment->getPostId(), PDO::PARAM_INT);
    //     $req->execute();
    // }
    public function delete(Commentaire $comment, Reponse $reponse)
    {
        $reponseModel = new ReponseModel;
        $reponseModel->delete($reponse);
        $sql = "DELETE FROM commentaire WHERE postId=:postId AND id=:id";
        $req = Cnx::getInstance()->prepare($sql);
        $req->bindValue(':id', $comment->getId(), PDO::PARAM_INT);
        $req->bindValue(':postId', $comment->getPostId(), PDO::PARAM_INT);
        $req->execute();
    }
}