<?php
namespace include\entity;

class Users {

    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $password;
    private $firstCnx;
    private $lastCnx;
    private $statut;

    const ADMIN = 0;
    const USER = 1;

    public function getId() 
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getNom()
    {
        return $this->nom;
    }
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password) 
    {
        $this->password = $password;
        return $this;
    }

    public function getFirstCnx()
    {
        return $this->firstCnx;
    }
    public function setFirstCnx($firstCnx)
    {
        $this->firstCnx = $firstCnx;
        return $this;
    }

    public function getLastCnx()
    {
        return $this->lastCnx;
    }
    public function setLastCnx($lastCnx)
    {
        $this->lastCnx = $lastCnx;
        return $this;
    }

    public function getStatut()
    {
        return $this->statut;
    }
    public function setStatut($statut)
    {
        $this->statut = $statut;
        return $this;
    }
}