<?php

namespace App\Model;

class Commentaire 
{
    protected $id;
    protected $usersId;
    protected $postId;
    protected $contenu;
    protected $addedOn;
    protected $statut;

    const CHECK = 0;
    const NOT_CHECK = 1;


    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of usersId
     */
    public function getUsersId()
    {
        return $this->usersId;
    }

    /**
     * Set the value of usersId
     */
    public function setUsersId($usersId): self
    {
        $this->usersId = $usersId;

        return $this;
    }

    /**
     * Get the value of postId
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set the value of postId
     */
    public function setPostId($postId): self
    {
        $this->postId = $postId;

        return $this;
    }

    /**
     * Get the value of contenu
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set the value of contenu
     */
    public function setContenu($contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get the value of addedOn
     */
    public function getAddedOn()
    {
        return $this->addedOn;
    }

    /**
     * Set the value of addedOn
     */
    public function setAddedOn($addedOn): self
    {
        $this->addedOn = $addedOn;

        return $this;
    }

    /**
     * Get the value of statut
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set the value of statut
     */
    public function setStatut($statut): self
    {
        $this->statut = $statut;

        return $this;
    }
}