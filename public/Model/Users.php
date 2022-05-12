<?php

namespace App\Model;

class Users
{
    protected $id;
    protected $name;
    protected $prenom;
    protected $email;
    protected $password;
    protected $firstCnx;
    protected $lastCnx;
    protected $statut;

    const ADMIN = 0;
    const USER = 1;

    public function __construct()
    {
        $this->table = 'users';
    }

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
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of prenom
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     */
    public function setPrenom($prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of firstCnx
     */
    public function getFirstCnx()
    {
        return $this->firstCnx;
    }

    /**
     * Set the value of firstCnx
     */
    public function setFirstCnx($firstCnx): self
    {
        $this->firstCnx = $firstCnx;

        return $this;
    }

    /**
     * Get the value of lastCnx
     */
    public function getLastCnx()
    {
        return $this->lastCnx;
    }

    /**
     * Set the value of lastCnx
     */
    public function setLastCnx($lastCnx): self
    {
        $this->lastCnx = $lastCnx;

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