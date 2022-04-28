<?php

use Cnx\Cnx;
use trait\ServiceCnx;
use include\entity\Posts;

class PostService {
    
    use ServiceCnx;

    public function createPost(Posts $post) {
        $sql = "INSERT INTO post (titre, chapo, image, contenu, addedOn, usersId, type) VALUES (:titre, :chapo, :image, :contenu, :addedOn, :usersId, :type)";

        $req = $this->cnx->prepare($sql);

        $req->bindValue(':titre', $post->getTitre(), PDO::PARAM_STR);
        $req->bindValue(':chapo', $post->getChapo(), PDO::PARAM_STR);
        $req->bindValue(':image', $post->getImage(), PDO::PARAM_STR);
        $req->bindValue(':contenu', $post->getContenu(),PDO::PARAM_STR);
        $req->bindValue('addedOn', $post->getAddedOn(), PDO::PARAM_STR);
        $req->bindValue(':usersId', $post->getUsersId(), PDO::PARAM_INT);
        $req->bindValue(':type', $post->getType(), PDO::PARAM_INT);

        $verif = $req->execute();

        if ($verif) {
            echo "Post enregistré !";
        } else {
            echo "Une erreur est survenue, veuillez recommencer !";
        }
    }

    public function readPost($id) {

        $sql = 'SELECT * FROM post WHERE id = :id';
        $req = $this->cnx->prepare($sql);

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
        $post->setUpdateOn($data['updatedOn']);
        $post->setUsersId($data['usersId']);
        $post->setType($data['type']);

        return $post;

    }

    public function readAllPostClassed() {
        $count = $this->cnx->prepare("SELECT count(*) as pid FROM post");
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
        
        $sql = "SELECT * FROM post ORDER BY id LIMIT $start, $perPage";
        $req = $this->cnx->prepare($sql);
        $req->execute();

        while($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $post = new Posts;
            $post->setId($data['id']);
            $post->setTitre($data['titre']);
            $post->setChapo($data['chapo']);
            $post->setImage($data['image']);
            $post->setContenu($data['contenu']);
            $post->setAddedOn($data['addedOn']);
            $post->setUpdateOn($data['updatedOn']);
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
        $req = $this->cnx->prepare($sql);
        $req->execute();
        

        while($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $post = new Posts();
            $post->setId($data['id']);
            $post->setTitre($data['titre']);
            $post->setChapo($data['chapo']);
            $post->setImage($data['image']);
            $post->setContenu($data['contenu']);
            $post->setAddedOn($data['addedOn']);
            $post->setUpdateOn($data['updatedOn']);
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
        $req = $this->cnx->prepare($sql);

        $req->bindValue(':id', $post->getId(), PDO::PARAM_INT);
        $req->bindValue(':titre', $post->getTitre(), PDO::PARAM_STR);
        $req->bindValue(':chapo', $post->getChapo(), PDO::PARAM_STR);
        $req->bindValue(':image', $post->getImage(), PDO::PARAM_STR);
        $req->bindValue(':contenu', $post->getContenu(), PDO::PARAM_STR);
        $req->bindValue(':type', $post->getType(), PDO::PARAM_INT);
        $req->bindValue(':updatedOn', $post->getUpdateOn(), PDO::PARAM_STR);

        $verif = $req->execute();

        if ($verif) {
            echo 'Post modifié!';
        } else {
            echo 'Une erreur est survenue, veuillez recommencer!';
        }
        
    }

    public function deletePost($id) {
        $sql = "DELETE FROM post WHERE id=:id";
        $req = $this->cnx->prepare($sql);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $verif = $req->execute();

        if ($verif) {
            echo 'Suppression réussie !!!';
        } else {
            echo 'Une erreur est survenue, veuillez recommencer !! ';
        }
    }
}