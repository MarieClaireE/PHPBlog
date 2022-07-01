<?php

namespace App\Model;

class Notification 
{
    protected $notId;
    protected $sujet;
    protected $texte;
    protected $statut;


    const ENVOYER = 0;
    const HTML = 1;


    public function __construct()
    {
        $this->table = 'notification';
    }
}