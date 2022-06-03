<?php

namespace App\Model;

use App\Core\Cnx;
use PDO;

class PostsModel extends Cnx
{
    public function create(Posts $post)
    {
        $sql = "INSERT INTO post (titre, chapo, image, contenu, addedOn, usersId, type) VALUES (:titre, :chapo, :image, :contenu, :addedOn, :usersId, :type)";

        $req = Cnx::getInstance()->prepare($sql);

        $req->bindValue(':titre', $post->getTitre(), PDO::PARAM_STR);
        $req->bindValue(':chapo', $post->getChapo(), PDO::PARAM_STR);
        $req->bindValue(':image', $post->getImage(), PDO::PARAM_STR);
        $req->bindValue(':contenu', $post->getContenu(),PDO::PARAM_STR);
        $req->bindValue('addedOn', $post->getAddedOn(), PDO::PARAM_STR);
        $req->bindValue(':usersId', $post->getUsersId(), PDO::PARAM_INT);
        $req->bindValue(':type', $post->getType(), PDO::PARAM_INT);

        $req->execute();
    }
   
    public function readPost(int $id) {

        $sql = 'SELECT * FROM post WHERE id = :id';
        $req = Cnx::getInstance()->prepare($sql);

        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);

        $post = new Posts();
        $post->setId($data['id']);
        $post->setTitre($data['titre']);
        $post->setChapo($data['chapo']);
        $post->setContenu($data['contenu']);
        $post->setImage($data['image']);
        $post->setAddedOn($data['addedOn']);
        $post->setUpdatedOn($data['updatedOn']);
        $post->setUsersId($data['usersId']);
        $post->setType($data['type']);

        return $post;
    }

    public function readAllPostClassed() {
        $page_url = filter_input(INPUT_GET, 'page');

        if (!isset($page_url)) {
            $page = 1;
            return;
        }
        $page = $page_url;
        
        $perPage = 4;
        $start = ($page-1) * $perPage;
        $sql = "SELECT * FROM post ORDER BY addedOn DESC LIMIT $start, $perPage";
        $req = Cnx::getInstance()->prepare($sql);
        $req->execute();

        while($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $post = new Posts;
            $post->setId($data['id']);
            $post->setTitre($data['titre']);
            $post->setChapo($data['chapo']);
            $post->setImage($data['image']);
            $post->setContenu($data['contenu']);
            $post->setAddedOn($data['addedOn']);
            $post->setUpdatedOn($data['updatedOn']);
            $post->setUsersId($data['usersId']);
            $post->setType($data['type']);

            $posts[] = $post;
        }
       
        if (!empty($posts)) {
            return $posts;
        }
        
    }

    public function readAllPost() {
        $sql = "SELECT * FROM post";
        $req = Cnx::getInstance()->prepare($sql);
        $req->execute();
        

        while($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $post = new Posts();
            $post->setId($data['id']);
            $post->setTitre($data['titre']);
            $post->setChapo($data['chapo']);
            $post->setImage($data['image']);
            $post->setContenu($data['contenu']);
            $post->setAddedOn($data['addedOn']);
            $post->setUpdatedOn($data['updatedOn']);
            $post->setUsersId($data['usersId']);
            $post->setType($data['type']);

            $posts[] = $post;
        }
       
        if (!empty($posts)) {
            return $posts;
        }
        
    }

    public function update(Posts $post) {
        $sql = "UPDATE post SET titre=:titre, chapo=:chapo, image=:image, contenu=:contenu, type=:type, updatedOn=:updatedOn where id=:id";
        $req = Cnx::getInstance()->prepare($sql);

        $req->bindValue(':id', $post->getId(), PDO::PARAM_INT);
        $req->bindValue(':titre', $post->getTitre(), PDO::PARAM_STR);
        $req->bindValue(':chapo', $post->getChapo(), PDO::PARAM_STR);
        $req->bindValue(':image', $post->getImage(), PDO::PARAM_STR);
        $req->bindValue(':contenu', $post->getContenu(), PDO::PARAM_STR);
        $req->bindValue(':type', $post->getType(), PDO::PARAM_INT);
        $req->bindValue(':updatedOn', $post->getUpdatedOn(), PDO::PARAM_STR);

        $req->execute();
    }

    public function deletePost(int $postId) {
        $sql = "DELETE FROM post WHERE id=:id";
        $req = Cnx::getInstance()->prepare($sql);
        $req->bindValue(':id', $postId, PDO::PARAM_INT);
        $req->execute();
    }

    public function searchBy(int $type)
    {
        $page_url = filter_input(INPUT_GET, 'page');

        if (!isset($page_url)) {
            $page = 1;
            return;
        } 
         $page = $page_url;
        
        $perPage = 4;
        $start = ($page-1) * $perPage;

        $sql = "SELECT * FROM post WHERE type=:type ORDER BY addedOn DESC LIMIT $start, $perPage";
        $req = Cnx::getInstance()->prepare($sql);
        $req->bindValue('type', $type, PDO::PARAM_INT);
        $req->execute();
        

        while($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $post = new Posts();
            $post->setId($data['id']);
            $post->setTitre($data['titre']);
            $post->setChapo($data['chapo']);
            $post->setImage($data['image']);
            $post->setContenu($data['contenu']);
            $post->setAddedOn($data['addedOn']);
            $post->setUpdatedOn($data['updatedOn']);
            $post->setUsersId($data['usersId']);
            $post->setType($data['type']);

            $posts[] = $post;
        }
        
        if (!empty($posts)) {
            return $posts;
        }  
    }
}