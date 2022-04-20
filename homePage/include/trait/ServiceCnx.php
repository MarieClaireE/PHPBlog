<?php

trait ServiceCnx
{
    private $cnx;

    public function __construct($cnx)
    {
        $this->setCnx($cnx);
    }

    public function setCnx(PDO $cnx)
    {
        $this->cnx=$cnx;
    }
}