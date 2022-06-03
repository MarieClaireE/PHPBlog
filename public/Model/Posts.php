<?php

namespace App\Model;

class Posts
{
    protected $postId;
    protected $titre;
    protected $chapo;
    protected $image;
    protected $contenu;
    protected $addedOn;
    protected $updatedOn;
    protected $usersId;
    protected $type;

    const WEB_DESIGN = 0;
    const HTML = 1;
    const JS = 2;
    const CSS = 3;
    const PHP = 4;

    public function __construct()
    {
        $this->table = 'post';
    }
    
    /* 
    * get value of id
    */
    public function getId()
    {
        return $this->postId;
    }

    /* 
    * set value of if
    * @return self
    */
    public function setId ($postId)
    {
        $this->postId = $postId;
        return $this;
    }

    /* 
    * get value of titre
    */
    public function getTitre()
    {
        return $this->titre;
    }
    /* 
    * set value of titre
    * @return self 
    */
    public function setTitre($titre)
    {
        $this->titre=$titre;
        return $this;
    }

    /* 
    * get value of chapo
    */
    public function getChapo()
    {
        return $this->chapo;
    }
    /* 
    * set value of chapo
    * @return self 
    */
    public function setChapo($chapo)
    {
        $this->chapo=$chapo;
        return $this;
    }

    /* 
    * get value of image
    */
    public function getImage()
    {
        return $this->image;
    }
    /* 
    * set value of image
    * @return self 
    */
    public function setImage($image)
    {
        $this->image=$image;
        return $this;
    }

    /* 
    * get value of contenu
    */
    public function getContenu()
    {
        return $this->contenu;
    }
    /* 
    * set value of contenu
    * @return self 
    */
    public function setContenu($contenu)
    {
        $this->contenu=$contenu;
        return $this;
    }

    /* 
    * get value of addedOn
    */
    public function getAddedOn()
    {
        return $this->addedOn;
    }
    /* 
    * set value of addedOn
    * @return self 
    */
    public function setAddedOn($addedOn)
    {
        $this->addedOn=$addedOn;
        return $this;
    }

    /* 
    * get value of updatedOn
    */
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }
    /* 
    * set value of updatedOn
    * @return self 
    */
    public function setUpdatedOn($updatedOn)
    {
        $this->updatedOn=$updatedOn;
        return $this;
    }

    /* 
    * get value of usersId
    */
    public function getUsersId()
    {
        return $this->usersId;
    }
    /* 
    * set value of usersId
    * @return self 
    */
    public function setUsersId($usersId)
    {
        $this->usersId=$usersId;
        return $this;
    }

    /* 
    * get value of type
    */
    public function getType()
    {
        return $this->type;
    }
    /* 
    * set value of type
    * @return self 
    */
    public function setType($type)
    {
        $this->type=$type;
        return $this;
    }
}