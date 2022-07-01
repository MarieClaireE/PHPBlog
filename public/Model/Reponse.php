<?php

namespace App\Model;

class Reponse 
{
    protected $reponseId;
    protected $contenu;
    protected $addedOn;
    protected $usersId;
    protected $commentaireId;
    protected $statut;

    const PUBLIE = 1;
    const EN_ATTENTE = 0;


    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->reponseId;
    }

    /**
     * Set the value of id
     */
    public function setId($reponseId): self
    {
        $this->reponseId = $reponseId;

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
     * Get the value of commentaireId
     */
    public function getCommentaireId()
    {
        return $this->commentaireId;
    }

    /**
     * Set the value of commentaireId
     */
    public function setCommentaireId($commentaireId): self
    {
        $this->commentaireId = $commentaireId;

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