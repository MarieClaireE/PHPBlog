<?php
namespace include\entity;

class Posts 
{
    private $id;
    private $titre;
    private $chapo;
    private $image;
    private $contenu;
    private $addedOn;
    private $updatedOn;
    private $usersId;
    private $type;

    const WEB_DESIGN = 0;
    const HTML = 1;
    const JS = 2;
    const CSS = 3;
    const PHP = 4;

    public function getId () {
        return $this->id;
    }
    public function setId ($id) {
        $this->id = $id;
        return $this;
    }

    public function getTitre () {
        return $this->titre;
    }
    public function setTitre ($titre) {
        $this->titre = $titre;
        return $this;
    }

    public function getChapo () {
        return $this->chapo;
    }
    public function setChapo ($chapo) {
        $this->chapo = $chapo;
        return $this;
    }

    public function getImage () {
        return $this->image;
    }
    public function setImage ($image) {
        $this->image = $image;
        return $this;
    }

    public function getContenu () {
        return $this->contenu;
    }
    public function setContenu ($contenu) {
        $this->contenu = $contenu;
        return $this;
    }

    public function getAddedOn () {
        return $this->addedOn;
    }
    public function setAddedOn ($addedOn) {
        $this->addedOn = $addedOn;
        return $this;
    }

    public function getUpdateOn () {
        return $this->updatedOn;
    }
    public function setUpdateOn ($updatedOn) {
        $this->updatedOn = $updatedOn;
        return $this;
    }

    public function getUsersId () {
        return $this->usersId;
    }
    public function setUsersId ($usersId) {
        $this->usersId = $usersId;
        return $this;
    }

    public function getType () {
        return $this->type;
    }
    public function setType ($type) {
        $this->type = $type;
        return $this;
    }
}